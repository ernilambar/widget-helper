/* jshint node:true */
module.exports = function( grunt ){
	'use strict';

	grunt.initConfig({
		pkg: grunt.file.readJSON( 'package.json' ),

		// Setting folder templates.
		dirs: {
			js: 'public/js',
			css: 'public/css',
			images: 'public/images'
		},

		// Other options.
		options: {
			text_domain: '<%= pkg.name %>'
		},

		// CSS minification.
		cssmin: {
			target: {
				files: [{
					expand: true,
					cwd: '<%= dirs.css %>',
					src: ['*.css', '!*.min.css'],
					dest: '<%= dirs.css %>',
					ext: '.min.css'
				}]
			}
		},

		// Uglify JS.
		uglify: {
			target: {
				options: {
					mangle: false
				},
				files: [{
					expand: true,
					cwd: '<%= dirs.js %>',
					src: ['*.js', '!*.min.js'],
					dest: '<%= dirs.js %>',
					ext: '.min.js'
				}]
			}
		}
	});

	// Load NPM tasks to be used here.
	grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );

	// Register tasks.
	grunt.registerTask( 'default', [] );

	grunt.registerTask( 'build', [
		'cssmin',
		'uglify'
	]);

	grunt.registerTask( 'textdomain', [
		'addtextdomain'
	]);
};
