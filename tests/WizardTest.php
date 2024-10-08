<?php

use Livewire\Livewire;
use Satoved\LivewireSteps\Exceptions\NoNextStep;
use Satoved\LivewireSteps\Livewire\WizardComponent;
use Satoved\LivewireSteps\Tests\TestSupport\MyWizardComponent;
use Satoved\LivewireSteps\Tests\TestSupport\Steps\FirstStepForm;
use Satoved\LivewireSteps\Tests\TestSupport\Steps\SecondStepForm;
use Satoved\LivewireSteps\Tests\TestSupport\Steps\SkipStepForm;
use Satoved\LivewireSteps\Tests\TestSupport\Steps\SomeIntricateNameStepForm;

$it = it('can render a wizard component', function () {
    Livewire::test(MyWizardComponent::class)->assertSuccessful();
});

it('renders the first step by default', function () {
    Livewire::test(MyWizardComponent::class)->assertSee('__FIRST_STEP_BODY__');
});

it('can show a specific step on load', function () {
    Livewire::test(MyWizardComponent::class, ['currentStepIndex' => 1])
        ->assertSuccessful()
        ->assertSee('__SECOND_STEP_BODY__');
});

it('can go to the next and previous steps', function () {
    Livewire::test(MyWizardComponent::class)
        ->assertSee('__FIRST_STEP_BODY__')
        ->call('nextStep')
        ->assertSee('__SECOND_STEP_BODY__')
        ->call('previousStep')
        ->assertSee('__FIRST_STEP_BODY__');
});

it('can skip steps', function () {
    $class = new class extends WizardComponent
    {
        public FirstStepForm $firstStepForm;

        public SkipStepForm $skipTestForm;

        public SecondStepForm $secondStepForm;

        public function render()
        {
            return '<div>{{ $this->renderStep() }}</div>';
        }
    };

    Livewire::test($class)
        ->assertSee('__FIRST_STEP_BODY__')
        ->call('nextStep')
        ->assertSee('__SECOND_STEP_BODY__')
        ->call('previousStep')
        ->assertSee('__FIRST_STEP_BODY__');
});

it('can skip steps via closure', function () {
    $class = new class extends WizardComponent
    {
        public FirstStepForm $firstStepForm;

        public SomeIntricateNameStepForm $toSkipStepForm;

        public SecondStepForm $secondStepForm;

        public function booted()
        {
            $this->toSkipStepForm->skipIf(function () {
                return true;
            });
        }

        public function render()
        {
            return '<div>{{ $this->renderStep() }}</div>';
        }
    };

    Livewire::test($class)
        ->assertSee('__FIRST_STEP_BODY__')
        ->call('nextStep')
        ->assertSee('__SECOND_STEP_BODY__')
        ->call('previousStep')
        ->assertSee('__FIRST_STEP_BODY__');
});

it('throws an exception when going to the next step on the last step', function () {
    Livewire::test(MyWizardComponent::class, ['currentStepIndex' => 1])
        ->call('nextStep');
})->throws(NoNextStep::class);

it('it just does not go to previous step from the first step', function () {
    Livewire::test(MyWizardComponent::class)
        ->call('previousStep')
        ->assertSuccessful();
});

it('can go to a specific step', function () {
    Livewire::test(MyWizardComponent::class)
        ->assertSee('__FIRST_STEP_BODY__')
        ->call('toStep', SecondStepForm::id())
        ->assertSee('__SECOND_STEP_BODY__');
});

it('can go to a specific step backwards', function () {
    Livewire::test(MyWizardComponent::class)
        ->call('nextStep')
        ->assertSet('currentStepIndex', 1)
        ->call('toStep', FirstStepForm::id())
        ->assertSet('currentStepIndex', 0)
        ->assertSee('__FIRST_STEP_BODY__');
});

it('adds unique wire:key to steps', function () {
    Livewire::test(MyWizardComponent::class)
        ->assertSeeHtml(' wire:key="wizard-step-FirstStepForm"')
        ->call('toStep', SecondStepForm::id())
        ->assertSeeHtml(' wire:key="wizard-step-SecondStepForm"');
});

it('has default labels for steps', function () {
    $class = new class extends WizardComponent
    {
        public SomeIntricateNameStepForm $someIntricateNameStepForm;

        public function render()
        {
            return '<div></div>';
        }
    };

    Livewire::test($class)
        ->assertSet('someIntricateNameStepForm', function ($step) {
            expect($step->label())->toBe('Some Intricate Name');

            return true;
        });
});

it('can render navigation with labels and step statuses', function () {
    Livewire::test(MyWizardComponent::class)
        ->assertSet('firstStepForm', function ($firstStepForm) {
            expect($firstStepForm->isCurrent())->toBeTrue()
                ->and($firstStepForm->isFirst())->toBeTrue()
                ->and($firstStepForm->isLast())->toBeFalse()
                ->and($firstStepForm->isPast())->toBeFalse()
                ->and($firstStepForm->isFuture())->toBeFalse();

            return true;
        })
        ->assertSet('secondStepForm', function ($firstStepForm) {
            expect($firstStepForm->isCurrent())->toBeFalse()
                ->and($firstStepForm->isFirst())->toBeFalse()
                ->and($firstStepForm->isLast())->toBeTrue()
                ->and($firstStepForm->isPast())->toBeFalse()
                ->and($firstStepForm->isFuture())->toBeTrue();

            return true;
        })
        ->set('currentStepIndex', 1)
        ->assertSet('firstStepForm', function ($firstStepForm) {
            expect($firstStepForm->isCurrent())->toBeFalse()
                ->and($firstStepForm->isPast())->toBeTrue()
                ->and($firstStepForm->isFuture())->toBeFalse();

            return true;
        })
        ->assertSet('secondStepForm', function ($firstStepForm) {
            expect($firstStepForm->isCurrent())->toBeTrue()
                ->and($firstStepForm->isPast())->toBeFalse()
                ->and($firstStepForm->isFuture())->toBeFalse();

            return true;
        });
});
