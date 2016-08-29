<?php

namespace WarMachineBundle\CREST;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use WarMachineBundle\Entity;

class WarMachineCommandSync extends Command{
	
	protected $warmachine;
	
	protected $em;

	protected $hrefRegex = '([^/]+)';

	protected $dateFormat = 'Y-m-d\TH:i:s';

	public function __construct($warmachine, $em){
		$this->warmachine = $warmachine;

		$this->em = $em;

		parent::__construct();
	}

	public function configure()
	{
		$this->setName('warmachine:sync');
		$this->setDescription('Pulls war data from EVE Servers to synchronize with local database');
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		$crestWar = $this->warmachine->getWar(496378);

		//$crestWar = $this->warmachine->getWar(1);

		$war = $this->buildWar($crestWar);

		$this->em->persist($war);

		$this->em->flush();

		$output->write('Success!');

	}

	public function buildWar($summary)
	{
		$war = $this->em->getRepository('WarMachineBundle:War')->find($summary->id);
		if($war === NULL){
			$war = new Entity\War();
			$war->setId($summary->id);

			$war->setFinished(\DateTime::createFromFormat($this->dateFormat, $summary->timeFinished));
			$war->setStarted(\DateTime::createFromFormat($this->dateFormat, $summary->timeStarted));
			$war->setDeclared(\DateTime::createFromFormat($this->dateFormat, $summary->timeDeclared));
			$war->setAllyCount($summary->allyCount);
			$war->setOpenForAllies($summary->openForAllies);
			$war->setMutual($summary->mutual);
			$war->setAggressor($this->buildWarActor($summary->aggressor));
			$war->setDefender($this->buildWarActor($summary->defender));
			$war->setKillMails($this->buildKillMails($summary->killmails, $war));
		}
		return $war;
	}

	public function buildWarActor($crestWarActor)
	{
		$warActor = new Entity\WarActor();
		$warActor->setIsk($crestWarActor->iskKilled);
		$warActor->setShips($crestWarActor->shipsKilled);
		$warActor->setActor($this->buildActor($crestWarActor));
		$this->em->persist($warActor);
		return $warActor;
	}

	public function buildActor($crestActor)
	{
		$type = ucfirst($this->getTypeHref($crestActor->href));
		if($type === 'Character'){
			$type = 'Actor';
		}

		$repo = $this->em->getRepository('WarMachineBundle:'. $type);

		$actor = $repo->find($crestActor->id);
		//echo "TYPE: $type : $crestActor->href " . ($actor != NULL ? $actor->getType() : '') . "\n";
		if($actor === NULL){
			switch($type){
				case 'Actor':
					echo "Creating actor $type " . $crestActor->name . " \n";
					$actor = new Entity\Actor();
					break;
				case 'Corporation':
					echo "Creating corp $type " . $crestActor->name . " \n";
					$actor = new Entity\Corporation();
					break;
				case 'Alliance':
					$actor = new Entity\Alliance();
					break;
			}	
			$actor->setId($crestActor->id);
			$actor->setHref($crestActor->href);
			$actor->setIcon($crestActor->icon->href);
			$actor->setName($crestActor->name);
			$this->em->persist($actor);
			//$actor->setType($this->getTypeHref($crestActor->href));
		}
		return $actor;
	}

	public function buildKillMails($killMailHref, $war)
	{
		$kills = $this->warmachine->request($killMailHref);
		$killMails = array();
		foreach($kills->items as $mail){
			$killMails[] = $this->buildKillMail($mail, $war);
		}
		return $killMails;
	}

	public function buildKillMail($mail, $war)
	{
		$kill = $this->em->getRepository('WarMachineBundle:KillMail')->find($mail->id);

		if($kill === NULL){
			$kill = new Entity\KillMail();
			$crestKill = $this->warmachine->request($mail->href);
			$killers = array();
			foreach($crestKill->attackers as $attacker){
				$killers[] = $this->buildKiller($attacker, $kill);
			}
			$kill->setTime(\DateTime::createFromFormat('Y.m.d H:i:s', $crestKill->killTime));
			$kill->setSolarSystem($this->buildSolarSystem($crestKill->solarSystem));
			$kill->setVictim($this->buildVictim($crestKill->victim, $kill));
			$kill->setId($crestKill->killID);
			$kill->setWar($war);
			$this->em->persist($kill);
		}
		return $kill;
	}
	public function buildKiller($crestKiller, $kill)
	{
		$killer = new Entity\Killer();
		if(isset($crestKiller->alliance)){
			$killer->setAlliance($this->buildActor($crestKiller->alliance));
		}
		$killer->setCorporation($this->buildActor($crestKiller->corporation));
		$killer->setCharacter($this->buildActor($crestKiller->character));
		$killer->setWeapon($this->buildItem($crestKiller->weaponType));
		$killer->setShip($this->buildItem($crestKiller->shipType));
		$killer->setDamage($crestKiller->damageDone);
		$killer->setFinalBlow($crestKiller->finalBlow);
		$killer->setKillMail($kill);
		$this->em->persist($killer);
		return $killer;
	}

	public function buildItem($crestItem)
	{
		$item = $this->em->getRepository('WarMachineBundle:Item')->find($crestItem->id);

		if($item === NULL){
			$item = new Entity\Item();
			$item->setHref($crestItem->href);
			$item->setIcon($crestItem->icon->href);
			$item->setId($crestItem->id);
			$item->setName($crestItem->name);
			$this->em->persist($item);
		}

		return $item;
	}

	public function buildVictim($crestVictim, $kill)
	{

		$victim = new Entity\Victim();
		if(isset($crestVictim->alliance)){
			$killer->setAlliance($this->buildActor($crestKiller->alliance));
		}
		$corp = $this->buildActor($crestVictim->corporation);
		$victim->setCorporation($corp);
		$victim->setCharacter($this->buildActor($crestVictim->character));
		$victim->setShip($this->buildItem($crestVictim->shipType));
		$victim->setDamage($crestVictim->damageTaken);
		$losses = array();
		foreach($crestVictim->items as $crestLoss){
			$losses[] = $this->buildLoss($crestLoss, $victim);
		}
		$victim->setKillMail($kill);
		$victim->setLosses($losses);
		$this->em->persist($victim);

		return $victim;
	}

	public function buildLoss($crestLoss, $victim)
	{
		$loss = new Entity\Loss();
		if(isset($crestLoss->quantityDropped)){
			$loss->setQuantity($crestLoss->quantityDropped);
			$loss->setDestroyed(false);
		} else {
			$loss->setQuantity($crestLoss->quantityDestroyed);
			$loss->setDestroyed(true);
		}
		$loss->setVictim($victim);
		$loss->setItem($this->buildItem($crestLoss->itemType));
		$this->em->persist($loss);
		return $loss;
	}

	public function buildSolarSystem($crestSolar)
	{

		$solar = $this->em->getRepository('WarMachineBundle:SolarSystem')->find($crestSolar->id);

		if($solar === NULL){
			$solar = new Entity\SolarSystem();
			$solar->setHref($crestSolar->href);
			$solar->setName($crestSolar->name);
			$solar->setId($crestSolar->id);
			$this->em->persist($solar);
		}

		return $solar;
	
	}

	public function getTypeHref($href)
	{
		preg_match_all($this->hrefRegex, $href, $matches);

		return substr($matches[0][2], 0, -1);

	}
	public function getIdHref($href)
	{
		preg_match_all($this->hrefRegex, $href, $matches);

		return $matches[0][3];
	}

}