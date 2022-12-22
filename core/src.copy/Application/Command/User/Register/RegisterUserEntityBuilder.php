<?php

namespace App\Application\Command\User\Register;

use App\Domain\Shared\ValueObject\Email;
use App\Domain\Shared\ValueObject\Uuid;
use App\Domain\User\Entity\User;

class RegisterUserEntityBuilder
{
    public function build(RegisterUserCommand $command): User
    {
        $user = new User();
        $user->setUuid(new Uuid($command->getUuid()));
        $user->setEmail(new Email($command->getEmail()));

        return $user;
    }
}
