<?php

namespace Satoved\LivewireSteps\Exceptions;

use Exception;

final class NoNextStep extends Exception
{
    public static function make(
        string $wizardComponentClassName,
        string $currentStepId,
    ): self {
        return new NoNextStep("The `{$currentStepId}` step of wizard `{$wizardComponentClassName}` requested to go to the next step, but there is no next step.");
    }
}
