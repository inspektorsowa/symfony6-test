<?php

namespace App\Domain\Shared\ValueObject;

use Symfony\Component\Uid\UuidV3;

class Uuid implements ValueObjectInterface
{
    private ?UuidV3 $uuid;

    public function __construct(?string $uuid = null)
    {
        $this->uuid = new UuidV3($uuid);
    }

    public function getValue(): ?UuidV3
    {
        return $this->uuid;
    }

    public function __toString()
    {
        return (string)$this->uuid;
    }
}
