<?php

namespace Satoved\LivewireSteps\Livewire;

use Livewire\Attributes\Locked;
use Livewire\Component;
use Satoved\LivewireSteps\Livewire\Forms\StepForm;

abstract class WizardComponent extends Component
{
    #[Locked]
    public int $currentStepIndex;

    public function mount()
    {
        $this->currentStepIndex = 0;
    }

    abstract public function steps(): array;

    public function submit()
    {
        $this->currentStep()->validate();
        $this->nextStep();
    }

    public function show(string $stepId): void
    {
        $this->currentStepIndex = $this->stepIndexById($stepId);
    }

    protected function currentStep(): StepForm
    {
        return $this->steps()[$this->currentStepIndex];
    }

    public function nextStep(): void
    {
        $this->currentStepIndex = min($this->totalSteps() - 1, $this->currentStepIndex + 1);
    }

    public function previousStep(): void
    {
        $this->currentStepIndex = max(0, $this->currentStepIndex - 1);
    }

    protected function isFirstStep(): bool
    {
        return $this->currentStepIndex === 0;
    }

    protected function totalSteps(): int
    {
        return count($this->steps());
    }

    public function stepIndexById(string $stepId): int
    {
        return array_search(
            true,
            array_map(
                fn (StepForm $step) => $step->id() === $stepId,
                $this->steps()
            )
        );
    }
}
