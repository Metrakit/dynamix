# Dynamix

Dynamix is private CMS for developer. The concept is to make a solid core with User/Role, Multilingual and Page/Block system.
And private package for anything we can have to need for customers. For exemple, a Mosaic/Gallery/Image module, a Slider/Slide/Image module, a Blog/Category/Article/Tag module...

## Installation (local)
1. Homestead installation (VM Vagrant)
  * Add the homestead box to our local environment : vagrant box add laravel/homestead
  * Clone the homestead repository to the "dev" folder : git clone https://github.com/laravel/homestead.git Homestead
  * Configure the Homestead.yaml in the homestead folder
  * Change the environment name for "homestead" here : bootstrap/start.php :
     $env = $app->detectEnvironment(array(
    
    	  'local' => array('homestead'),
    
     ));
2. Composer Instgallation : composer install




## TODO List
    
    Facade::Pager
       Ready to use with simple Page / Block
       Add form (or Slider, Resource) as Block with Polymorphic relation...
       
    Facade::Former
       Concept : use view file width each form input, select and textera possibilities
       See migration files for more info
       
       OR
       
       use package !
       
    Grunt Config with new :
       LiveReload, 
       Separated task (optimisation) for front and back end,
       Clear
       Compass
    
    Module:Slider
    Module:Tracker
    
    Modify RoleBasedAuthority
       http://packalyst.com/packages/package/mnshankar/role-based-authority
       use Resource and Action IN DATABASE not in text... (see Permission Table)
       

## Native functionality

    Multilingual (119 languages)
    
    Page / Block
       Facade:Pager
       
    Form (comming soon)
       Facade:Former
       
    User Management

## Module 

    Mosaic
       @ imported to an older project
       
    Slider / Slide / Image
    
    Gallery / Image
       @ imported to an older project
       
    Blog / Category / Article / Tag
       Migration & Seed OK
       
## Credit
Inspirate by :
https://github.com/andrewelkins/Laravel-4-Bootstrap-Starter-Site
    
