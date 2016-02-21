<?php

namespace WarMachineBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient('https://public-crest.eveonline.com/');

        $crawler = $client->request('GET', '/');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
}
