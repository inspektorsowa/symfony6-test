<?php

namespace App\User\Application\Query\GetUsers;

use App\User\Application\Query\GetUserProfile\GetUserProfileView;

class GetUsersView
{
    /** @var GetUserProfileView[] */
    private array $users = [];

    public function getUsers(): array
    {
        return $this->users;
    }

    public function setUsers(array $users): void
    {
        $this->users = $users;
    }
}
