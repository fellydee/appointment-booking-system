[![Build Status](https://travis-ci.org/rmit-s3542623-aiden-garipoli/appointment-booking-system.svg?branch=master)](https://travis-ci.org/rmit-s3542623-aiden-garipoli/appointment-booking-system)
# Appointment Booking System

## Intro

We are using Laravel (PHP Framework). The framework comes with built in middleware for common user authentication functionality which we will be utilising with out own controllers and views. 

## Installing
### Requirements

+ [PHP 7.1.1](http://php.net/downloads.php)
+ [Composer](https://getcomposer.org/)
+ [MySQL](https://www.mysql.com/)

Use ```composer install``` to install dependencies

The ```.env``` will need to be configured with your SQL servers details.

Generate a key ```php artisan key:generate``` should be run

To populate the database with tables ```php artisan migrate:refresh``` should be run

To run the application use ```php artisan serve``` and visit ```localhost:8000``` in your browser

## Testing
### Requirements
+ [phpunit](https://phpunit.de/)

### Run tests
To run feature tests use ```phpunit```

To run browser tests use ```php artisan dusk```


## Contributors
Name | Student ID 
--- | --- 
Aiden Garipoli | s3542623
Tyler Watkins | s3542686
Daniel Milner | s3542977
