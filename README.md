# Giełda Gier

[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ivankayzer/gielda-gier/Laravel?label=tests&style=flat-square)
![Quality Score](https://img.shields.io/scrutinizer/quality/g/ivankayzer/gielda-gier?style=flat-square)
[![StyleCI](https://styleci.io/repos/164491579/shield)](https://styleci.io/repos/164491579)

## Demo

https://gielda-gier.ivankayzer.com/

### Login details

```
email: demo@ivankayzer.com
password: secret
```

## Setup and configuration

``` php
cp .env.example .env
php artisan key:generate
composer install
npm install
npm run dev
```

Now fill in your database credentials in .env and after that run migrations

``` php
php artisan migrate
```

In case you need test data run seed command

``` php
php artisan db:seed
```

## Testing

``` bash
$ composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
