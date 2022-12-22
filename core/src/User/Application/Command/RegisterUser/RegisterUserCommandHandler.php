<?php

namespace App\User\Application\Command\RegisterUser;

use App\Common\Messenger\CommandHandlerInterface;
use App\User\Application\Command\RegisterUser\Exception\EmailExistsException;
use App\User\Infrastructure\Entity\User;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;

class RegisterUserCommandHandler implements CommandHandlerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws EmailExistsException
     */
    public function __invoke(RegisterUserCommand $command)
    {
        $user = new User();
        $user->setEmail($command->getEmail());

        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw new EmailExistsException();
        }

        return ['msg' => 'ok'];
    }
}
