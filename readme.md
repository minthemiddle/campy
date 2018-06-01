## Campy

Campy is the system to manage all Code+Design camps. For now this means participant management.


### Get started

- You need `PHP 7.1+`, a recent `MySQL` or `MariaDB` and `Node` to use this project locally
- Clone this repository: `git clone git@github.com:CodeDesignInitiative/campy.git`
- `cd campy`
- `composer install`
- `npm install`
- `cp .env.example .env`
- Create a SQL database `campy` (e.g. with SequelPro or MySQLAdmin)
- Add your database login to `.env`
- Change `APP_URL` to your local URL
- (In the root folder) `php artisan key:generate`
- `php artisan migrate --seed`
- `npm run watch`

## Contributing

We love contributions. You can find the guidelines [here](https://github.com/CodeDesignInitiative/cdweb1801/blob/master/CONTRIBUTING.md).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Martin via [martin@code.design](mailto:martin@code.design). All security vulnerabilities will be promptly addressed.

## License

Campy is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
