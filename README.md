## Setup

Run `composer install` to install packages.

Run `php artisan migrate --seed` command.

Two user create by seeder and you can logging in these two account with credentials:

email: `iman_sp@yahoo.com`
password: `12345678`

email: `test@domain.tld`
password: `12345678`

Run `php artisan l5-swagger:generate` to generate swagger documentation.

If you working on localhost, please fill `L5_SWAGGER_CONST_HOST` in env with `http://localhost:8000/api`.
