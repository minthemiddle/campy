## Campy

Campy is the system to manage all Code+Design camps. For now this means participant management.


### Get started

- You need `PHP 7.1+`, a recent `MySQL` or `MariaDB` and `Node` to use this project locally
- Create a Fork
- Clone your Fork for lokal development
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

### Testing

- This project wants to be documentation and test driven
- Main tests are functional tests using [Laravel Dusk](#)
- These tests test the main functionalities of the app using a headless browser
- Right now there is no automated CI pipeline (running the tests on a virtual server and only trigger deployment when all tests pass) (See [Issue #59](https://github.com/CodeDesignInitiative/campy/issues/59))
- After creating a feature, you need to run `php artisan dusk` and make sure that all tests pass
- You should add own functional tests for your Pull Request (see `CampRegistrationTest.php` for a complete example)
- This is not a hard criteria right now, but will be in the future
- All PR will be [manually tested locally](https://help.github.com/articles/checking-out-pull-requests-locally/) and only PR which do not break tests will be merged


## Contributing

We love contributions. You can find the guidelines [here](https://github.com/CodeDesignInitiative/cdweb1801/blob/master/CONTRIBUTING.md).

Note: All pull requests will be tested locally. Only PR with passing tests will be merged.

## Security Vulnerabilities

If you discover a security vulnerability within Campy, please send an e-mail to us via [hallo@cdcamp.de](mailto:hallo@cdcamp.de) – [PGP key](public.key). All security vulnerabilities will be promptly addressed.

## License

Campy is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
