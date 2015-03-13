exports.config =
    # See http://brunch.io/#documentation for docs. 
    paths:
        public: './'

    files:
        javascripts:
            joinTo:
                # Public vendor[rank:1] & theme[rank:3] 
                # bootstrap     v
                # imageloaded   v
                'public/dist/javascripts/vendor.js': /^(bower_components[\/\\]bootstrap-sass-official|bower_components[\/\\]imagesloaded)/
                # master        v
                'public/dist/javascripts/theme.js': /^(public[\\/]src)/

                # Admin vendor[rank:1] & theme[rank:3] 
                # bootstrap     v
                # imageloaded   v
                # metisMenu     v
                # fancyBox      v 
                # raphaelJS     v 
                # morris.js     X
                # tinyMCE       v 
                # sb-admin-2    X
                'admin/dist/javascripts/vendor.js': /^(bower_components[\/\\]bootstrap-sass-official|bower_components[\/\\]imagesloaded|bower_components[\/\\]metisMenu|bower_components[\/\\]fancybox|bower_components[\/\\]raphael|bower_components[\/\\]tinymce)/
                # master
                'admin/dist/javascripts/theme.js': /^(admin[\\/]src)/

        stylesheets:
            joinTo:
                # Public vendor[rank:1] & theme[rank:3] 
                # bootstrap     v
                'public/dist/steelsheets/vendor.css': /^(bower_components[\/\\]bootstrap-sass-official)/
                # master        v
                'public/dist/steelsheets/theme.css': /^(public[\\/]src)/

                # Admin vendor[rank:1] & theme[rank:3] 
                # bootstrap     v
                # font-awesome  v
                # fancy-box     v
                # morris        X
                # metisMenu     v
                'admin/dist/steelsheets/vendor.css': /^(bower_components[\/\\]bootstrap-sass-official|bower_components[\/\\]fontawesome|bower_components[\/\\]fancybox|bower_components[\/\\]metisMenu)/
                # master        v
                'admin/dist/steelsheets/theme.css': /^(admin[\\/]src)/	

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

    #assetsmanager:
    #    copyTo:
    #        'assets/js' : ['./app/public/assets/js'],
    #        'assets/css': ['./app/public/assets/css']
        
    
   