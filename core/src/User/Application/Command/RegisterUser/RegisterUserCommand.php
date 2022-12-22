<?php

namespace App\User\Application\Command\RegisterUser;

use App\Common\Messenger\SyncCommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUserCommand implements SyncCommandInterface
{
    #[Assert\Email(message: 'error.validation.email')]
    #[Assert\NotBlank(message: 'error.validation.not_blank')]
    public string $email = '';

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
