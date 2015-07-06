<?php

class DatabaseSeeder extends Seeder {

    public function run()
    {
        Eloquent::unguard();

        // Static Resources
        $this->call('LocalesTableSeeder');
        $this->call('ActionsTableSeeder');
        $this->call('ResourcesTableSeeder');

        // Dependencies
        $this->call('I18nDatabaseSeeder');

        // Medias
        $this->call('ImagesTableSeeder');

        // Auth
        $this->call('AuthsTableSeeder');
        
        // Role & Permission
        $this->call('RolesTableSeeder');
        $this->call('PermissionsTableSeeder');
        $this->call('AuthRoleTableSeeder');

        // Tag
        $this->call('TaggablesTableSeeder');
        
        // OnePage (go to pager)
        $this->call('OnePagesTableSeeder');

        // Forms
        $this->call('ViewsTableSeeder');

        // Navigation
        $this->call('NavigationsTableSeeder');//Need Page module OK

        // Theme
        $this->call('ThemesTableSeeder');

        // Option
        $this->call('OptionsTableSeeder');

        // ========================
        //Packages
        $this->call('PagerDatabaseSeeder');
    }

}