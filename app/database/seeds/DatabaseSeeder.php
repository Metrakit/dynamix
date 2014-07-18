<?php

class DatabaseSeeder extends Seeder {

    public function run()
    {
        Eloquent::unguard();

        //Resources (independant)
        $this->call('ActionsTableSeeder');
        $this->call('ResourcesTableSeeder');
        $this->call('I18nTypesTableSeeder');

        $this->call('ThemesTableSeeder');


        //Users
        $this->call('UsersTableSeeder');
        $this->call('RolesTableSeeder');

        $this->call('RoleUserTableSeeder');
        $this->call('PermissionsTableSeeder');


        //Blogs
        $this->call('BlogsTableSeeder');
        $this->call('ArticlesTableSeeder');
        $this->call('TagsTableSeeder');
        $this->call('ArticleCategoriesTableSeeder');

        $this->call('ArticleBlogTableSeeder');
        $this->call('ArticleCategoryTableSeeder');
        $this->call('ArticleTagTableSeeder');
        
        
        //Pages

        //Views & Datas

        //Forms

        //Sliders
        
        //Galleries
        
        //Mosaics
        
        //Images

        //Users










        //i18n
        $this->call('LocaleTableSeeder');


        
        $this->call('ArticleBlogTableSeeder');
        $this->call('ArticleCategoryTableSeeder');
        $this->call('ArticleTagTableSeeder');

        //Page
        $this->call('PagesTableSeeder');
        $this->call('ViewsTableSeeder');
        $this->call('DatasTableSeeder');
        $this->call('DataViewTableSeeder');
        $this->call('MapsTableSeeder');

        //Menu
        $this->call('MenusTableSeeder');

        //Options
        $this->call('OptionsTableSeeder');

    }

}