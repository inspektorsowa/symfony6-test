<?php

namespace App\User\UI\Web;

use App\Common\UI\Web\WebController;
use App\User\Application\Query\GetUserProfile\GetUserProfileQuery;
use App\User\Application\Query\GetUsers\GetUsersQuery;
use App\User\Infrastructure\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserPresenter extends WebController
{
    #[Route('/users', name: 'get_users', methods: 'GET')]
    public function getUsers(UserRepository $repository): Response
    {
        try {
            var_dump($repository->findAll());
            exit;
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
        return new JsonResponse(
            $this->messageBus->dispatch(new GetUsersQuery())
        );
    }

    #[Route('/user/{uuid}', name: 'get_user_by_uuid', methods: 'GET')]
    public function getUserProfileData(string $uuid): Response
    {
        return new JsonResponse(
            $this->messageBus->dispatch(new GetUserProfileQuery($uuid))
        );
    }
}
