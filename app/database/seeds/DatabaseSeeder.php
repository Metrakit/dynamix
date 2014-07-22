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
        $this->call('ImagesTableSeeder');
        $this->call('ResponsiveWidthsTableSeeder');
        $this->call('ResponsiveTriggersTableSeeder');


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
        $this->call('PagesTableSeeder');
        $this->call('BlocksTableSeeder');
        $this->call('BlockResponsiveTableSeeder');


        //Forms
        //$this->call('PagesTableSeeder');
        //$this->call('ViewsTableSeeder');
        //$this->call('DatasTableSeeder');
        //$this->call('DataViewTableSeeder');
        //$this->call('MapsTableSeeder');


        //Sliders
        $this->call('SlidersTableSeeder');
        $this->call('SlidesTableSeeder');
        

        //Galleries
        $this->call('GalleriesTableSeeder');
        $this->call('GalleryImageTableSeeder');
        

        //Mosaics
        $this->call('MosaicsTableSeeder');
        $this->call('GalleryMosaicTableSeeder');


        //Menu
        $this->call('MenusTableSeeder');//Need Page module OK


        //Autonomous
        //$this->call('ThemesTableSeeder');
        $this->call('OptionsTableSeeder');

    }

}