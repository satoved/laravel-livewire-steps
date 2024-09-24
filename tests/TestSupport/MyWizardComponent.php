<?php

namespace Satoved\LivewireSteps\Tests\TestSupport;

use Satoved\LivewireSteps\Livewire\WizardComponent;
use Satoved\LivewireSteps\Tests\TestSupport\Steps\FirstStepForm;
use Satoved\LivewireSteps\Tests\TestSupport\Steps\SecondStepForm;

class MyWizardComponent extends WizardComponent
{
    public FirstStepForm $firstStepForm;
    public SecondStepForm $secondStepForm;

    public function render()
    {
        return '<div>{{ $this->renderStep() }}</div>';
    }
}