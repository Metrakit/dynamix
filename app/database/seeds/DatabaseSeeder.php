<?php

class DatabaseSeeder extends Seeder {

    public function run()
    {
        Eloquent::unguard();

        //Resources
        $this->call('LocalesTableSeeder');
        $this->call('ActionsTableSeeder');
        $this->call('ResourcesTableSeeder');
        $this->call('I18nTypesTableSeeder');
        //$this->call('FileTypesTableSeeder');
        //$this->call('FilesTableSeeder');
        $this->call('ResponsiveWidthsTableSeeder');
        $this->call('ResponsiveTriggersTableSeeder');
        $this->call('SocialsTableSeeder');


        //Users
        $this->call('AuthsTableSeeder');
        $this->call('RolesTableSeeder');

        $this->call('AuthRoleTableSeeder');
        $this->call('PermissionsTableSeeder');


        //Blogs
        //$this->call('BlogsTableSeeder');
        //$this->call('ArticlesTableSeeder');
        //$this->call('TagsTableSeeder');
        //$this->call('ArticleCategoriesTableSeeder');

        //$this->call('ArticleBlogTableSeeder');
        //$this->call('ArticleCategoryTableSeeder');
        $this->call('TaggablesTableSeeder');
        

        //Pages
        $this->call('PagesTableSeeder');
        $this->call('BlocksTableSeeder');
        $this->call('BlockContentsTableSeeder');
        $this->call('BlockResponsiveTableSeeder');

        //OnePage
        $this->call('OnePagesTableSeeder');


        //Forms
        //$this->call('PagesTableSeeder');
        $this->call('ViewsTableSeeder');
        //$this->call('DatasTableSeeder');
        //$this->call('DataViewTableSeeder');
        //$this->call('MapsTableSeeder');
        
        // ONLY FOR DEVELOPMENT
        $this->call('FullFormSeeder');
        $this->call('CommentsTableSeeder');


        //Sliders
        //$this->call('SlidersTableSeeder');
        //$this->call('SlidesTableSeeder');

        //Menu
        $this->call('NavigationsTableSeeder');//Need Page module OK

        //Task
        $this->call('TasksTableSeeder');


        //Autonomous
        //$this->call('ThemesTableSeeder');
        $this->call('OptionsTableSeeder');

    }

}