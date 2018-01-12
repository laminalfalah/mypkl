# Application Booking Tour and Umroh #

**Application Booking Tour and Umroh** is a project in collage.

## Installation ##

* type `git clone https://github.com/laminal26-pct/mypkl.git projectname` to clone the repository 
* type `cd projectname`
* type `composer install`
* type `composer update`
* copy *.env.example* to *.env*
* type `php artisan key:generate`to generate secure key in *.env* file
* if you use MySQL in *.env* file :
   * set DB_CONNECTION
   * set DB_DATABASE
   * set DB_USERNAME
   * set DB_PASSWORD

* if you use MAIL in .env file :
   * set MAIL_DRIVER
   * set MAIL_HOST
   * set PORT
   * set MAIL_USERNAME
   * set MAIL_PASSWORD
   * set MAIL_ENCRYPTION

* create a seeder file, example :

    ## don't forget
    ```php
    use App\Models\User;
    use App\Models\Role;
    use App\Models\Slideshow;

    $adminRole = new Role();
    $adminRole->name = "admin"; 
    $adminRole->display_name = "Administrator"; 
    $adminRole->description = "Only Administrator"; 
    $adminRole->save();

    $operatorRole = new Role(); 
    $operatorRole->name = "operator"; 
    $operatorRole->display_name = "Operator"; 
    $operatorRole->description = "Operator For Services Booking"; 
    $operatorRole->save();

    $admin = new User(); 
    $admin->name = 'Administrator'; 
    $admin->email = # type email for admin; 
    $admin->password = bcrypt('admin123'); 
    $admin->status = "Activated"; 
    $admin->save();
    $admin->attachRole($adminRole);

    $operator = new User();
    $operator->name = 'Operator';
    $operator->email = # type email for operator; 
    $operator->password = bcrypt('operator'); 
    $operator->status = "Activated"; 
    $operator->save();
    $operator->attachRole($operatorRole);

    $slide = [ 
      [ 
        'slug' => 'tiket', 
        'images' => '/photos/slideshow/CONTOH-SLIDESHOW.png', 
        'post_status' => 'Publish'
      ], 
      [ 
        'slug' => 'hotel',
        'images' => '/photos/slideshow/slideshow.jpg',
        'post_status' => 'Publish'
      ], 
      [ 
        'slug' => 'tour', 
        'images' => '/photos/slideshow/slideshow1.png', 
        'post_status' => 'Publish'
      ], 
      [ 
        'slug' => 'umroh', 
        'images' => '/photos/slideshow/slideshow3.jpg', 
        'post_status' => 'Publish'
      ], 
      [ 
        'slug' => 'tour',
        'images' => '/photos/slideshow/slideshow4.jpg',
        'post_status' => 'Publish'
      ], 
      [ 
        'slug' => 'umroh',
        'images' => '/photos/slideshow/slideshow.jpg',
        'post_status' => 'Publish'
      ], 
    ];

    foreach ($slide as $k => $v) { 
      Slideshows::create($v); 
    }
    ```
* type `php artisan migrate --seed` to create and populate tables
* edit *.env* for emails configuration

### Tests ###

When you want to launch the tests refresh and populate the database :

`php artisan migrate:fresh --seed`

The application only runs when using internet.
