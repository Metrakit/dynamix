<?php

class DatabaseSeeder extends Seeder {

    public function run()
    {
        Eloquent::unguard();

        //Resources (idependant)
        $this->call('ActionsTableSeeder');
        $this->call('ResourcesTableSeeder');
        $this->call('I18nTypesTableSeeder');
        $this->call('ThemesTableSeeder');



        //Blogs

        //Pages

        //Views & Datas

        //Forms

        //Sliders
        
        //Galleries
        
        //Mosaics
        
        //Images

        //Users








        //User
        $this->call('RolesTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('RoleUserTableSeeder');
        $this->call('PermissionsTableSeeder');

        //i18n
        $this->call('LocaleTableSeeder');

        //BLOG System
        $this->call('BlogsTableSeeder');
        $this->call('ArticlesTableSeeder');
        $this->call('TagsTableSeeder');
        $this->call('ArticleCategoriesTableSeeder');
        
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