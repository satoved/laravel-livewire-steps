<?php

namespace Satoved\LivewireSteps\Livewire\Forms;

use Livewire\Form;
use Satoved\LivewireSteps\Livewire\WizardComponent;

abstract class StepForm extends Form
{
    abstract public function label(): string;

    abstract public function render();

    public function id(): string
    {
        return class_basename(get_class($this));
    }

    public function getComponent(): WizardComponent
    {
        return parent::getComponent();
    }

    public function isCurrent(): bool
    {
        return $this->index() === $this->currentWizardIndex();
    }

    public function isPrevious(): bool
    {
        return $this->index() < $this->currentWizardIndex();
    }

    public function isFuture(): bool
    {
        return $this->index() > $this->currentWizardIndex();
    }

    protected function index(): int
    {
        return $this->getComponent()->stepIndexById($this->id());
    }

    protected function currentWizardIndex(): int
    {
        return $this->getComponent()->currentStepIndex;
    }
}
