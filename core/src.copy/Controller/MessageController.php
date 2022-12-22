<?php

namespace App\Controller;

use App\Event\TestEvent;
use App\Message\TestMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MessageController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/post_message', name: 'post_message', methods: 'GET')]
    public function postMessage(ValidatorInterface $validator, MessageBusInterface $bus): JsonResponse
    {
        $msg = new TestMessage('zzzzzzzzzzzz' . time());
        try {
            $bus->dispatch($msg);
        } catch (ValidationFailedException $e) {
            $errors = $e->getViolations();
            $response = [];
            foreach ($errors as $error) {
                $response[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $response], Response::HTTP_BAD_REQUEST);
        }

//        $errors = $validator->validate($msg);
//        if ($errors->count()) {
//            $response = [];
//            foreach ($errors as $error) {
//                $response[$error->getPropertyPath()] = $error->getMessage();
//            }
//            return new JsonResponse(['errors' => $response], Response::HTTP_BAD_REQUEST);
//        }

        $response = null;
        try {
            $id = mt_rand();
//            $response = $this->handle(new TestEvent($id));
            $bus->dispatch(new TestEvent($id));
        } catch (HandlerFailedException $e) {
            var_dump($e->getPrevious());exit;
        }

        return new JsonResponse('ok: ' . $response);
    }
}
