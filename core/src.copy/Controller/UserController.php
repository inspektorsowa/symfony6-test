<?php

namespace App\Controller;

use App\Application\Command\User\Register\RegisterUserCommand;
use App\Domain\Shared\ValueObject\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'post_user', methods: 'POST')]
    public function postUser(Request $request, MessageBusInterface $bus): Response
    {
        $uuid = new Uuid();
        $command = new RegisterUserCommand();
        $command->setUuid($uuid);
        $command->setEmail($request->get('email'));
        $bus->dispatch($command);

        return new JsonResponse(['uuid' => $uuid], Response::HTTP_ACCEPTED);
    }
}
