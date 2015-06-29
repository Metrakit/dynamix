# Dynamix

- [Presentation](#presentation)
- [Requisite](#requisites)
- [Configuration](#configuration)
- [Installation](#installations)

## <a name="presentation"></a> Presentation
Dynamix is open-source CMS for Laravel developer's. The concept is to make a solid core with User/Role, Multilingual and Page/Block system.


## <a name="requisites"></a> Requisites

- [Fontend](#requisite-fontend)
- [Backend](#requisite-backend)

### <a name="requisite-fontend"></a> Requisite for frontend
  * Compass (http://compass-style.org/)
  * Grunt (http://gruntjs.com/getting-started)
  * Bower (http://bower.io/)
  * Oracle VM virtualBox (https://www.virtualbox.org/wiki/Downloads)
  * Vagrant (https://www.vagrantup.com/)

### <a name="requisite-backend"></a> Requisite for backend
  * Laravel Homestead (http://laravel.com/docs/5.1/homestead)
  * Putty (http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html)


## <a name="configuration"></a> Configuration
Into dynamix root, there is a `_.env.php`. Configure them, and duplicate to `.env.php` and `.env.local.php`


## <a name="installations"></a> Installations (env:local, start only)

- [Fontend](#installation-fontend)
- [Backend](#installation-backend)
     
### <a name="installation-backend"></a> Requisite for backend

1. Install composer vendors with `composer install`.

2. Migrate core with `php artisan migrate && php artisan migrate --package="dynamix/pager"`

3. Seed data with `php artisan db:seed && php artisan db:seed --class=PagerDatabaseSeeder`

4. Test seeder for Former `php artisan db:seed --class=FullFormSeeder`


### <a name="installation-fontend"></a> Requisite for fontend

1. Grunt

In the assets folder (dynamix\theme\default\assets) run `npm install && bower install && grunt`

**jQuery choice**

You will must choose between four option, please choose the second (`2`).
![](doc/bower-choice.png)

## Team

| ![David Lepaux avatar](http://www.gravatar.com/avatar/06bb57add8f45127272699923ee05edc.png?s=60) | ![Jordane Jouffroy avatar](http://www.gravatar.com/avatar/b60c83acfb5649cea0435ba8d6845659.png?s=60)
|---|---|
| [David Lepaux](https://github.com/dlepaux) | [Jordane Jouffroy](https://github.com/Metrakit)

## License

MIT © DynamixCMS team
       
## Credit
Inspirate by :
https://github.com/andrewelkins/Laravel-4-Bootstrap-Starter-Site
    
