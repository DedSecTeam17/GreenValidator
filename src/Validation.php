<?php

declare(strict_types=1);

namespace GreenValidator;

/**
 * Validation result object
 * 
 * Represents the result of a validation operation, containing
 * whether the validation passed and any error messages
 */
class Validation
{
    private bool $isValid = false;
    private string $message = '';

    public function getIsValid(): bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): void
    {
        $this->isValid = $isValid;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * Check if validation is valid (alias for getIsValid)
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * Check if validation failed
     */
    public function failed(): bool
    {
        return !$this->isValid;
    }
}
