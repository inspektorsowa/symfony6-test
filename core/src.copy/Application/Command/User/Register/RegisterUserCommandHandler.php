<?php

namespace App\Application\Command\User\Register;

use App\Domain\User\Service\UserService;

class RegisterUserCommandHandler
{
    private RegisterUserEntityBuilder $entityBuilder;
    private RegisterUserCommandValidator $validator;
    private UserService $userService;

    public function __construct(
        RegisterUserCommandValidator $validator,
        RegisterUserEntityBuilder $entityBuilder,
        UserService $userService
    ) {
        $this->validator = $validator;
        $this->entityBuilder = $entityBuilder;
        $this->userService = $userService;
    }

    public function __invoke(RegisterUserCommand $command)
    {
        $this->validator->validate($command);
        $user = $this->entityBuilder->build($command);
        $this->userService->registerUser($user);
    }
}
