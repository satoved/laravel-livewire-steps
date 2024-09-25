<?php

namespace Satoved\LivewireSteps\Livewire\Forms;

use Livewire\Form;
use Satoved\LivewireSteps\Livewire\WizardComponent;

abstract class StepForm extends Form
{
    abstract public function render();

    public static function id(): string
    {
        return class_basename(static::class);
    }

    public function label(): string
    {
        return str(class_basename(static::class))
            ->remove('Step')
            ->remove('Form')
            ->headline();
    }

    public function getComponent(): WizardComponent
    {
        return parent::getComponent();
    }

    public function isCurrent(): bool
    {
        return $this->index() === $this->currentWizardIndex();
    }

    public function isPast(): bool
    {
        return $this->index() < $this->currentWizardIndex();
    }

    public function isFuture(): bool
    {
        return $this->index() > $this->currentWizardIndex();
    }

    public function isFirst(): bool
    {
        return $this->index() === 0;
    }

    public function isLast(): bool
    {
        return $this->index() === ($this->getComponent()->totalSteps() - 1);
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
