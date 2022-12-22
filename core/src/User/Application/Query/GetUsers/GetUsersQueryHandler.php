<?php

namespace App\User\Application\Query\GetUsers;

use App\User\Infrastructure\Repository\UserRepository;
use App\Common\Messenger\QueryHandlerInterface;
use App\User\Application\Query\GetUserProfile\GetUserProfileView;
use Symfony\Component\Serializer\SerializerInterface;

class GetUsersQueryHandler implements QueryHandlerInterface
{
    private UserRepository $repository;
    private SerializerInterface $serializer;

    public function __construct(UserRepository $repository, SerializerInterface $serializer)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
    }

    public function __invoke(GetUsersQuery $query): array
    {
        return array_map(
            fn($user) => $this->serializer->deserialize($user, GetUserProfileView::class, 'array'),
            $this->repository->findAll()
        );
    }
}
