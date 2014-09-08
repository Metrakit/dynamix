module.exports = function(grunt) {
	// Code grunt
	grunt.initConfig({

		// Configuration du projet et des tâches
		pkg: grunt.file.readJSON('package.json'),

		// Paths
		path: '../',
		srcPath: 'src/',
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
		    }
		},


		// Je ne sais pas à quoi ça sert
		/*csslint: {
			// Config de la tâche csslint
			options:{
				'adjoining-classes' : false,
				'empty-rules'       : false, 
				// Générateur automatique d'un rapport XML
				formatters: [{
					id: 'csslint-xml',
					dest: 'report/csslint.xml' 
				}]
			},
			src: ['<%= srcPath %>css/*.css']
		},	*/	


		// Concaténation des feuilles de styles
		cssmin:{
			combine: {
				files: {
					// Feuilles de style principale
					'<%= srcPath %>css/main.min.css':
					[
						//'<%= srcPath %>css/vendor.css',
						'<%= srcPath %>css/core.css'
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
			main: {
				// Fichiers à concaténer
				src: [
					 '<%= srcPath %>js/vendor/bootstrap.min.js',
					 '<%= srcPath %>js/vendor/jquery.imageloaded.min.js',
					 '<%= srcPath %>js/vendor/jquery.cbpFWSlider.min.js',
			         '<%= srcPath %>js/master.js'
			    ],
				// Fichier de destination
				dest:'<%= srcPath %>js/main.min.js'
			},
			back: {
				// Fichiers à concaténer
				src: [
					 '<%= srcPath %>js/vendor/jquery.fancybox.js',
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


		// Watchs
		watch: {
			
			js: 
			{
				files: [
					'<%= srcPath %>js/vendor/bootstrap.min.js',
					'<%= srcPath %>js/vendor/jquery.imageloaded.min.js',
					'<%= srcPath %>js/vendor/jquery.cbpFWSlider.min.js',
					'<%= srcPath %>js/master.js'
				],
				tasks:['concat:main', 'uglify:main', 'clean:js', 'hash:js'],
				options: {
	              livereload: true
	          	}	
          	},

 			vendorJs: 
			{
				files: [
					'<%= srcPath %>js/vendor/bootstrap.min.js',
					'<%= srcPath %>js/vendor/jquery.imageloaded.min.js',
					'<%= srcPath %>js/vendor/jquery.cbpFWSlider.min.js',
					'<%= srcPath %>js/master.js'
				],
				tasks:['concat:back', 'uglify:back', 'clean:js', 'hash:js'],
				options: {
	              livereload: true
	          	}	
          	},         	

			scss: 
			{
				files: [
					'<%= srcPath %>sass/**/*.scss',
			    ],
				tasks:['compass', 'cssmin', 'clean:css', 'hash:css'],
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
	grunt.loadNpmTasks('grunt-contrib-watch');


	// Tâche par défaut
	grunt.registerTask('default',
						['compass'],
						['cssmin'],
						['concat'],
						['uglify'],
						['imagemin'],
						['watch']);

	// Tâche personnalisée pour le développement
	grunt.registerTask('dev',
						['compass'],
						['cssmin'],
						['concat'],
						['uglify'],
						['imagemin'],
						['watch']);

	// Tâche personnalisée pour la mise en prod
	 grunt.registerTask('prod', 
	 					 ['imagemin']);

}