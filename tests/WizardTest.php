<?php

use Livewire\Livewire;
use Satoved\LivewireSteps\Tests\TestSupport\MyWizardComponent;
use Satoved\LivewireSteps\Tests\TestSupport\Steps\SecondStepForm;

beforeEach(function () {
    $this->wizard = Livewire::test(MyWizardComponent::class);
});

$it = it('can render a wizard component', function () {
    $this->wizard->assertSuccessful();
});

it('renders the first step by default', function () {
    $this->wizard->assertSee('__FIRST_STEP_BODY__');
});

it('can show a specific step on load', function () {
    Livewire::test(MyWizardComponent::class, ['currentStepIndex' => 1])
        ->assertSuccessful()
        ->assertSee('__SECOND_STEP_BODY__');
});

it('can render the next and previous step', function () {
    $this->wizard
        ->assertSee('__FIRST_STEP_BODY__')
        ->call('nextStep')
        ->assertSee('__SECOND_STEP_BODY__')
        ->call('previousStep')
        ->assertSee('__FIRST_STEP_BODY__');
});

it('can go to a specific step', function () {
    $this->wizard
        ->assertSee('__FIRST_STEP_BODY__')
        ->call('show', SecondStepForm::id())
        ->assertSee('__SECOND_STEP_BODY__');
});

it('can render steps with their states', function () {
    $this->wizard
        ->assertSee('__FIRST_STEP_BODY__')
        ->call('show', SecondStepForm::id())
        ->assertSee('__SECOND_STEP_BODY__');
});