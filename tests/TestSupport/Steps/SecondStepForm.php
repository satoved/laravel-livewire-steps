<?php

namespace Satoved\LivewireSteps\Tests\TestSupport\Steps;

use Satoved\LivewireSteps\Livewire\Forms\StepForm;

class SecondStepForm extends StepForm
{
    public function render()
    {
        return '__SECOND_STEP_BODY__';
    }
}