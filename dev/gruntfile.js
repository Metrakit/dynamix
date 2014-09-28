module.exports = function(grunt) {
	// Code grunt
	grunt.initConfig({

		// Configuration du projet et des tâches
		pkg: grunt.file.readJSON('package.json'),

		// Paths
		path: '../',
		srcPath: 'src/',
		vendorPath: 'src/vendor/',
		distPath: '../public/',



		/**
		 *
		 *  CSS Tasks
		 *
		 */

		// Compilation
		compass: {
		    dist: {
		      options: {
		        config: '<%= srcPath %>config.rb',
		        sassDir: '<%= srcPath %>sass',
        		cssDir: '<%= srcPath %>css',
		      }
		    },
			bootstrap: {
		      options: {
		        sassDir: '<%= vendorPath %>bootstrap-sass/lib',
        		cssDir: '<%= srcPath %>css',
		      }
		    },	
			fontawesome: {
		      options: {
		        sassDir: '<%= vendorPath %>font-awesome/scss',
        		cssDir: '<%= srcPath %>css',
		      }
		    }
		},


		// Concaténation des feuilles de styles
		cssmin:{
			combine: {
				files: {
					// Feuilles de style principale
					'<%= srcPath %>css/main.min.css':
					[
						'<%= srcPath %>css/bootstrap.css',
						'<%= srcPath %>css/fontawesome.css',
						'<%= vendorPath %>fancybox/source/jquery.fancybox.css',
						'<%= srcPath %>css/core.css',
						'<%= vendorPath %>morrisjs/morris.css',
						'<%= vendorPath %>sb-admin-v2/css/sb-admin.css',
						'<%= vendorPath %>metisMenu/dist/metisMenu.min.css'
					],

					// Feuilles de style du back office (complete la main)
					'<%= srcPath %>css/main.back.min.css':
					[
          				'<%= srcPath %>css/core-admin.css'
					]
				}
			},
			// Config de la tâche cssmin
			options: {

			}
		},



		/**
		 *
		 *  JS Tasks
		 *
		 */

		// Concatene les fchiers js
		concat: {
			options: {
			  separator: ';\n',
			},
			main: {
				// Fichiers à concaténer
				src: [
					 '<%= vendorPath %>bootstrap-sass/dist/js/bootstrap.min.js',
					 '<%= vendorPath %>imagesloaded/imagesloaded.pkgd.min.js',
			         '<%= srcPath %>js/master.js'
			    ],
				// Fichier de destination
				dest:'<%= srcPath %>js/main.min.js'
			},
			back: {
				// Fichiers à concaténer
				src: [
					 '<%= vendorPath %>metisMenu/dist/metisMenu.min.js',
					 '<%= vendorPath %>fancybox/source/jquery.fancybox.js',
					 '<%= vendorPath %>sb-admin-v2/js/sb-admin.js',
					 '<%= vendorPath %>raphael/raphael.min.js',
					 '<%= vendorPath %>morrisjs/morris.js',
			    ],
				// Fichier de destination
				dest:'<%= srcPath %>js/main.back.min.js'
			}
		},

		// Minification
		uglify: {
			options: {
				// la date et le nom des fichiers minifiés sont insérés en commentaire en début de fichier
				banner:'/* <%= grunt.template.today("dd-mm-yyyy, HH:MM") %> */\n'
			},

			main: {
				files:{
					// Fichier de destination
					'<%= srcPath %>js/main.min.js':
					// Fichier minifié
					['<%= concat.main.dest %>']
				}
			},

			back: {
				files: {
					// Fichier de destination
					'<%= srcPath %>js/main.back.min.js':
					// Fichier minifié
					['<%= concat.back.dest %>']
				}
			}
		},



		/**
		 *
		 *  Other Tasks
		 *
		 */

		// Hashage des fichiers minimifié
		hash: {
	        options: {
	            mapping: '<%= path %>app/config/assets/assets.json', //mapping file so your server can serve the right files
	            srcBasePath: '<%= srcPath %>', // the base Path you want to remove from the `key` string in the mapping file
	            destBasePath: '<%= distPath %>', // the base Path you want to remove from the `value` string in the mapping file
	            flatten: false // Set to true if you don't want to keep folder structure in the `key` value in the mapping file
	        },
	        js: {
	            src: ['<%= srcPath %>js/main.min.js','<%= srcPath %>js/main.back.min.js'],
	            dest: '<%= distPath %>js'
	        },
	        css: {
	            src: ['<%= srcPath %>css/main.min.css','<%= srcPath %>css/main.back.min.css'],
	            dest: '<%= distPath %>css'
	        }
	    },


	    // Nettoyage des dossiers publics
		clean: {
		  js: ["<%= distPath %>js/*.js"],
		  css: ["<%= distPath %>css/*.css"],
		  options: {
		      force: true
		  }
		},


		// Compression des images
		imagemin:{
			dynamic:{
				files: [{
					// Mode de ciblage dynamqiue
					expand:true,
					// Dossier contenant les sources
					cwd:'<%= srcPath %>img/sources',
					// Fichiers à prendre en compte
					src:['*.{png,jpg,gif}'],
					// Dossier de destination
					dest:'<%= distPath %>img'
				}]
			}
		},		


		copy: {
		  jsMap: {
		    files: [
		      // jQuery
		      {expand: false, src: ['<%= vendorPath %>jquery/dist/jquery.min.js'], dest: '<%= distPath %>js/vendor/jquery.min.js', filter: 'isFile'},
		      {expand: false, src: ['<%= vendorPath %>jquery/dist/jquery.min.map'], dest: '<%= distPath %>js/vendor/jquery.min.map', filter: 'isFile'},

		      // HeadJS
		      {expand: false, src: ['<%= vendorPath %>headjs/dist/1.0.0/head.min.js'], dest: '<%= distPath %>js/vendor/head.min.js', filter: 'isFile'},
		      {expand: false, src: ['<%= vendorPath %>headjs/dist/1.0.0/head.min.js.map'], dest: '<%= distPath %>js/vendor/head.min.js.map', filter: 'isFile'},

		      // ResponseJS
		      {expand: false, src: ['<%= vendorPath %>responsejs/response.min.js'], dest: '<%= distPath %>js/vendor/response.min.js', filter: 'isFile'},

		      // Media-match
		      {expand: false, src: ['<%= vendorPath %>media-match/media.match.min.js'], dest: '<%= distPath %>js/vendor/media.match.min.js', filter: 'isFile'},

		    ]
		  }
		},



		// Watchs
		watch: {
			
			mainJS: 
			{
				files: [
						'<%= vendorPath %>bootstrap-sass/dist/js/bootstrap.min.js',
						'<%= vendorPath %>imagesloaded/imagesloaded.pkgd.min.js',
						'<%= srcPath %>js/master.js'
				],
				tasks:['concat:main', /*'uglify:main',*/ 'clean:js', 'hash:js'],
				options: {
	              livereload: true
	          	}	
          	},

 			backJS: 
			{
				files: [
						'<%= vendorPath %>metisMenu/dist/metisMenu.min.js',
						'<%= vendorPath %>fancybox/source/jquery.fancybox.js',
						'<%= vendorPath %>sb-admin-v2/js/sb-admin.js',
						'<%= vendorPath %>raphael/raphael.min.js',
						'<%= vendorPath %>morrisjs/morris.js'
				],
				tasks:['concat:back', /*'uglify:back',*/ 'clean:js', 'hash:js'],
				options: {
	              livereload: true
	          	}	
          	},  

          	vendorJS: 
			{
				files: [
						'<%= vendorPath %>jquery/dist/**/*',
						'<%= vendorPath %>headjs/dist/**/*',
						'<%= vendorPath %>responsejs/**/*',
						'<%= vendorPath %>media-match/**/*'
				],
				tasks:['copy:jsMap'],
				options: {
	              livereload: true
	          	}	
          	},  

        	css: 
			{
				files: [
					'<%= vendorPath %>fancybox/source/jquery.fancybox.css',
					'<%= vendorPath %>morrisjs/morris.css',
					'<%= vendorPath %>sb-admin-v2/css/sb-admin.css',
					'<%= vendorPath %>metisMenu/dist/metisMenu.min.css'
			    ],
				tasks:['cssmin', 'clean:css', 'hash:css'],
				options: {
	              livereload: true
	          	}	
          	},    	       	

			scss: 
			{
				files: [
					'<%= srcPath %>sass/**/*.scss'
			    ],
				tasks:['compass:dist', 'cssmin', 'clean:css', 'hash:css'],
				options: {
	              livereload: true
	          	}	
          	},     	

			bootstrap: 
			{
				files: [
					'<%= vendorPath %>bootstrap-sass/lib/**/*.scss'
			    ],
				tasks:['compass:bootstrap', 'cssmin', 'clean:css', 'hash:css'],
				options: {
	              livereload: true
	          	}	
          	},   

			fontawesome: 
			{
				files: [
					'<%= vendorPath %>font-awesome/scss/*.scss'
			    ],
				tasks:['compass:fontawesome', 'cssmin', 'clean:css', 'hash:css'],
				options: {
	              livereload: true
	          	}	
          	},   

			blade: 
			{
				files: ['<%= path %>app/**/*.blade.php'],
				options: {
	              livereload: true
	          	}	
          	}

		}		


	});



	// Chargement des plugins
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-hash');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-watch');


	// Tâche par défaut
	grunt.registerTask('default',
						['compass'],
						['cssmin'],
						['concat'],
						['uglify'],
						['imagemin'],
						['copy'],
						['watch']);

	// Tâche personnalisée pour le développement
	grunt.registerTask('dev',
						['compass'],
						['cssmin'],
						['concat'],
						['uglify'],
						['imagemin'],
						['copy'],
						['watch']);

	// Tâche personnalisée pour la mise en prod
	 grunt.registerTask('prod', 
	 					 ['imagemin']);

}