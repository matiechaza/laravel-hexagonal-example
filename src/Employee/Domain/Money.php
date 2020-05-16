<?php

declare(strict_types=1);

namespace Src\Employee\Domain;


final class Money
{
    private float $value;
    private string $currency;

    public function __construct(float $value, string $currency = 'ARS')
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function value(): float
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function currency(): string
    {
        return $this->currency;
    }
}
