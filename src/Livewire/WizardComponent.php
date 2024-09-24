<?php

namespace Satoved\LivewireSteps\Livewire;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Livewire\Component;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionProperty;
use Satoved\LivewireSteps\Exceptions\NoNextStep;
use Satoved\LivewireSteps\Livewire\Forms\StepForm;

abstract class WizardComponent extends Component
{
    public int $currentStepIndex = 0;

    /**
     * @return array<StepForm>
     */
    public function steps(): array
    {
        return array_map(
            fn ($propertyName) => $this->$propertyName,
            $this->stepPropertyNames()
        );
    }

    public function toStep(string $stepId): void
    {
        $this->currentStepIndex = $this->stepIndexById($stepId);
    }

    protected function currentStep(): StepForm
    {
        return $this->steps()[$this->currentStepIndex];
    }

    /**
     * @throws NoNextStep
     */
    public function nextStep(): void
    {
        if ($this->currentStepIndex === $this->totalSteps() - 1) {
            throw NoNextStep::make(self::class, get_class($this->currentStep()));
        }

        $this->currentStepIndex++;
    }

    public function previousStep(): void
    {
        $this->currentStepIndex = max(0, $this->currentStepIndex - 1);
    }

    protected function isFirstStep(): bool
    {
        return $this->currentStep()->isFirst();
    }

    protected function isLastStep(): bool
    {
        return $this->currentStep()->isLast();
    }

    public function totalSteps(): int
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

    public function renderStep()
    {
        return new HtmlString(
            Blade::render(<<<'BLADE'
                <div wire:key="wizard-step-{{ $this->currentStep()->id() }}">
                    {!! $this->currentStep()->render() !!}
                </div>
BLADE
            )
        );
    }

    protected function stepPropertyNames(): array
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        $filteredProperties = [];

        foreach ($properties as $property) {
            // Get the typehint of the property
            $type = $property->getType();

            // Ensure the type is a named type (ignore union types, etc.)
            if ($type instanceof ReflectionNamedType) {
                $typeName = $type->getName();

                // Check if the typehint class exists and is a subclass of StepForm
                if (class_exists($typeName) && is_subclass_of($typeName, StepForm::class)) {
                    $filteredProperties[] = $property->getName();
                }
            }
        }

        return $filteredProperties;
    }
}
