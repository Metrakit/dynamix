<?php

class DatabaseSeeder extends Seeder {

    public function run()
    {
        Eloquent::unguard();

        //Resources (independant)
        $this->call('ActionsTableSeeder');
        $this->call('ResourcesTableSeeder');
        $this->call('I18nTypesTableSeeder');
        $this->call('LocalesTableSeeder');
        $this->call('ImagesTableSeeder');

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
       /* $this->call('PagesTableSeeder');
        $this->call('ViewsTableSeeder');
        $this->call('DatasTableSeeder');
        $this->call('DataViewTableSeeder');
        $this->call('MapsTableSeeder');*/

        //Forms
       /* $this->call('PagesTableSeeder');
        $this->call('ViewsTableSeeder');
        $this->call('DatasTableSeeder');
        $this->call('DataViewTableSeeder');
        $this->call('MapsTableSeeder');*/


        //Sliders
        $this->call('SlidesTableSeeder');
        $this->call('SlidersTableSeeder');
        
        //Galleries
        $this->call('GalleriesTableSeeder');
        $this->call('GalleryImageTableSeeder');
        
        //Mosaics
        $this->call('MosaicsTableSeeder');
        $this->call('GalleryMosaicTableSeeder');





        //Menu
        $this->call('MenusTableSeeder');

        //Options
        $this->call('OptionsTableSeeder');

    }

}