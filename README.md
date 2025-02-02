## Shop with Laravel
A shop app with Laravel 11.

### Getting Started
- Clone this repository to your local machine.
- Install the required PHP packages:
```sh
composer install
```
- Copy `.env.example` to `.env`.
- Generate new key
```sh
php artisan key:generate
```
- Create a database and configure the database connection in the `.env` file.
- Run the following command to migrate the database:
```sh
php artisan migrate
```
- Run the seeder:
```sh
php artisan db:seed
```
- Run the following command to start the Laravel development server:
```sh
php artisan serve
```

### Credential
```sh
Username: owner
Password: 123
```
Note: You can change the credential in `database/seeders/UserSeeder.php`
