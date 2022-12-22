<?php

namespace App\Domain\Shared\ValueObject;

class Email implements ValueObjectInterface
{
    private ?string $email;

    public function __construct(?string $email)
    {
        $this->email = $email;
    }

    public function getValue(): ?string
    {
        return $this->email;
    }

    public function __toString()
    {
        return $this->email;
    }
}
