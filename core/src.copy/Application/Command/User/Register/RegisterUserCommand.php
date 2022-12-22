<?php

namespace App\Application\Command\User\Register;

use App\Application\Command\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUserCommand implements CommandInterface
{
    #[Assert\Uuid(versions: [3])]
    private string $uuid;

    #[Assert\Email]
    private string $email;

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
