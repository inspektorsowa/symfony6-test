<?php

namespace App\User\UI\Web;

use App\Common\UI\Web\WebController;
use App\User\Application\Command\RegisterUser\Exception\EmailExistsException;
use App\User\Application\Command\RegisterUser\RegisterUserCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends WebController
{
    #[Route('/user', name: 'post_user', methods: 'POST')]
    public function postUserAction(Request $request, SerializerInterface $serializer): Response
    {
        try {
            return new JsonResponse(
                $this->messageBus->dispatch(
                    $serializer->deserialize($request->getContent(), RegisterUserCommand::class, 'json')
                ),
                Response::HTTP_CREATED
            );
        } catch (ExceptionInterface $e) {
            return new JsonResponse('Invalid payload: ' . $e->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (ValidationFailedException $e) {
            $errors = [];
            foreach ($e->getViolations() as $error) {
                $errors[$error->getPropertyPath()][] = $error->getMessage();
            }
            return new JsonResponse(['msg' => 'Validation error', 'errors' => $errors], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return match (get_class($e->getPrevious())) {
                EmailExistsException::class => new JsonResponse(['msg' => 'Email already exists'],
                    Response::HTTP_NOT_ACCEPTABLE),
                default => new JsonResponse(['class' => get_class($e), 'message' => $e->getMessage()],
                    Response::HTTP_INTERNAL_SERVER_ERROR),
            };
        }
    }
}
