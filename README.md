## Application Booking Tour and Umroh ##

**Application Booking Tour and Umroh** is a project in collage.

### Installation ###

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
* type `php artisan migrate --seed` to create and populate tables
* edit *.env* for emails configuration

### Tests ###

When you want to launch the tests refresh and populate the database :

`php artisan migrate:fresh --seed`
