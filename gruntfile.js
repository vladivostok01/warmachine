module.exports = function(grunt) {

	grunt.initConfig({
			less: {
				development:{
					files:{
						"web/css/app.css": "app/Resources/less/app.less"
					}
				}
			}

	});

	grunt.loadNpmTasks('grunt-contrib-less');

	grunt.registerTask('default', ['less'])
};