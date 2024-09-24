<?php

namespace Satoved\LivewireSteps\Exceptions;

use Exception;

final class NoNextStep extends Exception
{
    public static function make(
        string $wizardComponentClassName,
        string $currentStepClassName,
    ): self {
        return new NoNextStep("The `{$currentStepClassName}` step of wizard `{$wizardComponentClassName}` requested to go to the next step, but there is no next step.");
    }
}
