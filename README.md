# Lightweight Livewire component that allow you to easily build a wizard, or multi-step forms.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/satoved/laravel-livewire-steps.svg?style=flat-square)](https://packagist.org/packages/satoved/laravel-livewire-steps)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/satoved/laravel-livewire-steps/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/satoved/laravel-livewire-steps/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/satoved/laravel-livewire-steps/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/satoved/laravel-livewire-steps/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/satoved/laravel-livewire-steps.svg?style=flat-square)](https://packagist.org/packages/satoved/laravel-livewire-steps)
---
Lightweight Livewire component that allow you to easily build a wizard (multi-step form).

This package utilizes [Livewire 3 forms objects](https://livewire.laravel.com/docs/forms#extracting-a-form-object) as steps and needs only one Livewire component as a Wizard.

![screenshot](https://github.com/satoved/laravel-livewire-steps/blob/main/docs/images/demo-screenshot.png?raw=true)

Here's what a wizard could look like.

In [this repo on GitHub](https://github.com/satoved/laravel-livewire-steps-demo), you'll find a demo Laravel application that uses the laravel-livewire-steps package to create a simple email subscription flow.

## Installation

You can install the package via composer:

```bash
composer require satoved/laravel-livewire-steps
```

## Usage
Create a Livewire component that extends WizardComponent. List all steps in the correct order as public properties.
```php
use Satoved\LivewireSteps\Livewire\WizardComponent;

class EmailSubscriptionWizard extends WizardComponent
{
    public NameStep $nameStep;
    public EmailStep $emailStep;

    public function render()
    {
        return <<<'BLADE'
            <form wire:submit="nextStep">
                {{ $this->renderStep() }}
                <button>Next</button>
            </form>
BLADE;
    }
}
```

Each step is a Livewire [form object](https://livewire.laravel.com/docs/forms#extracting-a-form-object) that must extend StepForm.
```php
use Satoved\LivewireSteps\Livewire\Forms\StepForm;

class EmailStep extends StepForm
{
    #[Validate(['required', 'email'])]
    public $email;

    public function render()
    {
        return '<input type="email" wire:model="emailStep.email">';
    }
}
```

## Testing

```bash
composer test
```

## Alternatives
This package was heavily inspired by [spatie/laravel-livewire-wizard](https://github.com/spatie/laravel-livewire-wizard). It's a great package, but each step has to be a Livewire component, and you get two requests for a parent component and the step component each time. Which is in overkill for my use cases.

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
