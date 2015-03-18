module.exports = function (grunt) {
    // Require
    require('load-grunt-tasks')(grunt);

    // Code grunt
    grunt.initConfig({

        // Configuration du projet et des tâches
        pkg: grunt.file.readJSON('package.json'),

        //Excécution des gruntfile soeur
        grunt: {
            buildsome: {
                gruntfile: '../../theme/default/assets/Gruntfile.js'
            }
        }    
    });

    // Chargement des plugins
    grunt.loadNpmTasks('grunt-grunt');

    // Tâches par défauts
    grunt.registerTask('default', ['grunt']);
}