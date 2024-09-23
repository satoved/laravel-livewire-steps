<?php

namespace Satoved\LivewireSteps\Tests\TestSupport\Steps;

use Satoved\LivewireSteps\Livewire\Forms\StepForm;

class FirstStepForm extends StepForm
{
    public function render()
    {
        return '__FIRST_STEP_BODY__';
    }
}