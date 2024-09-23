<?php

namespace Satoved\LivewireSteps\Tests\TestSupport\Steps;

use Satoved\LivewireSteps\Livewire\Forms\StepForm;

class ThirdStepForm extends StepForm
{
    public function render()
    {
        return '__THIRD_STEP_BODY__';
    }
}