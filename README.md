# Laravel wrapper for the Domains.co.za API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fintech-systems/domainscoza-api.svg?style=flat-square)](https://packagist.org/packages/fintech-systems/domainscoza-api)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/fintech-systems/domainscoza-api/run-tests?label=tests)](https://github.com/fintech-systems/domainscoza-api/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/fintech-systems/domainscoza-api/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/fintech-systems/domainscoza-api/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/fintech-systems/domainscoza-api.svg?style=flat-square)](https://packagist.org/packages/fintech-systems/domainscoza-api)

Domains.co.za has an eloquent API. This is a wrapper to make it testable using Laravel's HTTP client and mocking.

Domains.co.za API reference: https://docs.domains.co.za

# Authentication

https://docs.domains.co.za/#authentication-2
DOMAINSCOZA_USERNAME
DOMAINSCOZA_PASSWORD

## Auth URLs

Live URL : https://api.domains.co.za/api
Development URL : https://lapi-dev.domains.co.za/api 
Note: Contact support to get a dev environment setup
API Version : 5.0.19

## Login

POST https://api.domains.co.za/api/login

`You will receive a bearer token to be used in the Authorization header for all subsequent requests.`

# Sample API calls

## List
https://docs.domains.co.za/#list

## Installation

You can install the package via composer:

```bash
composer require fintech-systems/domainscoza-api
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="domainscoza-config"
```

This is the contents of the published config file:

```php
return [
    'username' => env('DOMAINSCOZA_USERNAME'),
    'password' => env('DOMAINSCOZA_PASSWORD'),
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="domainscoza-api-views"
```

## Usage

```php
$domainsCoza = new FintechSystems\DomainsCoza();
echo $domainsCoza->echoPhrase('Hello, FintechSystems!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Eugene van der Merwe](https://github.com/eugenevdm)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
