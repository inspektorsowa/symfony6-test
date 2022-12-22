<?php

namespace App\Domain\User\Service;

use App\Domain\User\Entity\User;

interface UserCreatorInterface
{
    public function createUser(User $user);
}
