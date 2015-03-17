module.exports = function (grunt) {
    // Code grunt
    grunt.initConfig({

        // Configuration du projet et des tâches
        pkg: grunt.file.readJSON('package.json'),

        //Excécution des gruntfile soeur
        grunt: {
            buildsome: {
                gruntfile: '../../theme/*/assets/Gruntfile.js'
            }
        }    
    });

    // Chargement des plugins
    grunt.loadNpmTasks('load-grunt-tasks');

    // Tâches par défauts
    grunt.registerTask('default', ['grunt']);

    // Tâches personnalisées pour le développement
    grunt.registerTask('dev', ['grunt']);

	// Tâches personnalisées pour le développement
    grunt.registerTask('deploy', ['grunt']);

    // Tâches personnalisées pour la mise en prod
    grunt.registerTask('prod', ['grunt']);
}