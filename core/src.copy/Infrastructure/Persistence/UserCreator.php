<?php

namespace App\Infrastructure\Persistence;

use App\Domain\User\Entity\User;
use App\Entity\User as UserORM;
use App\Domain\User\Service\UserCreatorInterface;
use Doctrine\ORM\EntityManagerInterface;

class UserCreator implements UserCreatorInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createUser(User $user)
    {
        $obj = new UserORM();
        $obj->setId($user->getUuid());
        $obj->setEmail($user->getEmail());

        $this->entityManager->persist($obj);
        $this->entityManager->flush();
    }
}
