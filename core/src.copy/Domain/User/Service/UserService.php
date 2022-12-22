<?php

namespace App\Domain\User\Service;

use App\Domain\Shared\Event\DomainEventDispatcherInterface;
use App\Domain\User\Entity\User;
use App\Domain\User\Event\UserCreatedEvent;

class UserService
{
    private UserCreatorInterface $userCreator;
    private DomainEventDispatcherInterface $eventDispatcher;

    public function __construct(
        DomainEventDispatcherInterface $eventDispatcher,
        UserCreatorInterface $userCreator
    ) {
        $this->userCreator = $userCreator;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function registerUser(User $user): void
    {
        $this->userCreator->createUser($user);
        $this->eventDispatcher->dispatch(new UserCreatedEvent($user));
    }
}
