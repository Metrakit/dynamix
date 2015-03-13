exports.config =
    # See http://brunch.io/#documentation for docs. 
    paths:
        public: './'

    files:
        javascripts:
            joinTo:
                # here we want all files for front, so :
                # bootstrap
                # imageloaded
                # TODO module js
                # master
                'js/front.js': /^(app[\\/]front|bower_components[\/\\]bootstrap-sass-official|bower_components[\/\\]imagesloaded)/

                # here we want all files for back-office, so :
                # metisMenu
                # fancyBox
                # raphaelJS
                # morris.js
                # tinyMCE
                # sb-admin-2
                # TODO module js
                # master
                'js/back.js': /^(app[\\/]back|bower_components[\/\\]metisMenu|bower_components[\/\\]fancybox|bower_components[\/\\]raphael|bower_components[\/\\]tinymce|bower_components[\/\\]tinymce)/

        stylesheets:
            joinTo:
                # Public vendor
                # bootstrap v
                'public/dist/steelsheets/vendor.css': /^(bower_components[\/\\]bootstrap-sass-official)/

                # Public theme
                'public/dist/steelsheets/theme.css': /^(public[\\/]src[\\/]steelsheets)/

                # Admin vendor
                # bootstrap v
                # font-awesome v
                # fancy-box v
                # morris >
                # metisMenu v
                'admin/dist/steelsheets/vendor.css': /^(bower_components[\/\\]bootstrap-sass-official|bower_components[\/\\]fontawesome|bower_components[\/\\]fancybox|bower_components[\/\\]metisMenu)/

                # Admin theme
                'admin/dist/steelsheets/theme.css': /^(admin[\\/]src[\\/]steelsheets)/	

    modules:
        wrapper: false
        definition: false

    conventions:
        # we don't want javascripts in asset folders to be copied like the one in 
        # the bootstrap assets folder
        assets: /assets[\\/](?!javascripts)/

    plugins:
        cleancss:
          keepSpecialComments: 0
          removeEmpty: true
        sass:
            debug: 'comments' # or set to 'debug' for the FireSass-style output

    assetsmanager:
        copyTo:
            'assets/js' : ['./app/public/assets/js'],
            'assets/css': ['./app/public/assets/css']
        
    
   