<?php

namespace Satoved\LivewireSteps\Tests\TestSupport\Steps;

use Satoved\LivewireSteps\Livewire\Forms\StepForm;

class SkipStepForm extends StepForm
{
    public function shouldBeSkipped(): bool
    {
        return true;
    }

    public function render()
    {
        return '__SKIP_STEP_BODY__';
    }
}
