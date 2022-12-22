<?php

namespace App\Domain\User\Entity;

use App\Domain\Shared\Entity\DomainEntityInterface;
use App\Domain\Shared\ValueObject\Email;
use App\Domain\Shared\ValueObject\Uuid;

class User implements DomainEntityInterface
{
    private ?Uuid $uuid;
    private ?Email $email;

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }

    public function setUuid(?Uuid $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getEmail(): ?Email
    {
        return $this->email;
    }

    public function setEmail(?Email $email): void
    {
        $this->email = $email;
    }
}
