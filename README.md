# Jobs API using Lumen 7.0

Repository of use for developing and studying web systems using Lumen Framework.

# How to run this project

You can basically clone the project or download it so it can be used and run the following command.

```
composer install
```
After that.

```
copy .env.example for .env and configuration database(MySQL, Postgres or Sqlite)
```
Run.
```
"php artisan migrate" and "php artisan jwt:secret"
```
To create the system database, with the .env file pre-configured with the database already installed

## Application features

- CRUD (Categories, Jobs);
- Authentication and Authorization (Users) 
- Rest Concepts
- Authentication using JWT
- Company Create Job
- User Applied Job
- Response for Applied Job
- Filter Jobs (Company, Title, Location)
- Create Resource for Models
- Update Database using Migration
- Type Users (Personal(1), Company(2))


## Technologies used in the project

 - [Lumen](https://lumen.laravel.com/)
 - [PHP 7](https://www.php.net/)
 - [Composer](https://getcomposer.org/)
