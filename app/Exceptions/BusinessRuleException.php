<?php

namespace App\Exceptions;

/**
 * Thrown when an operation would break an accounting rule
 * (e.g. paying a company more than you owe it, overdrawing an account).
 * Livewire components catch it and show the message as a toast / field error.
 */
class BusinessRuleException extends \DomainException
{
    public function __construct(string $message, public readonly ?string $field = null)
    {
        parent::__construct($message);
    }
}
