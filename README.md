# Lightweight Livewire component that allow you to easily build a wizard, or multi-step forms.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/satoved/laravel-livewire-steps.svg?style=flat-square)](https://packagist.org/packages/satoved/laravel-livewire-steps)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/satoved/laravel-livewire-steps/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/satoved/laravel-livewire-steps/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/satoved/laravel-livewire-steps/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/satoved/laravel-livewire-steps/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/satoved/laravel-livewire-steps.svg?style=flat-square)](https://packagist.org/packages/satoved/laravel-livewire-steps)
---
Lightweight Livewire component that allow you to easily build a wizard, or multi-step forms.

Here's what a wizard component class could look like.

## Installation

You can install the package via composer:

```bash
composer require satoved/laravel-livewire-steps
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-livewire-steps-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-livewire-steps-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-livewire-steps-views"
```

## Usage

```php
$livewireSteps = new Satoved\LivewireSteps();
echo $livewireSteps->echoPhrase('Hello, Satoved!');
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

- [Oleg Shovkun](https://github.com/satoved)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
