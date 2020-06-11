/* jshint node:true */
module.exports = function( grunt ){
	'use strict';

	const sass = require( 'node-sass' );

	grunt.initConfig({
		pkg: grunt.file.readJSON( 'package.json' ),

		// Setting folder templates.
		dirs: {
			js: 'public/js',
			css: 'public/css',
			sass: 'public/sass',
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
		},
		sass: {
			options: {
				implementation: sass,
				"sourcemap=none": '',
				style: 'expanded'
			},
			dist: {
				files: {
					'<%= dirs.css %>/widgets.css': '<%= dirs.sass %>/widgets.scss'
				}
			}
		}

	});

	// Load NPM tasks to be used here.
	grunt.loadNpmTasks( 'grunt-sass' );
	grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );

	// Register tasks.
	grunt.registerTask( 'default', [] );

	grunt.registerTask( 'build', [
		'sass',
		'cssmin',
		'uglify'
	]);
};
