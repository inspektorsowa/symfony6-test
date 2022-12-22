<?php

namespace App\Application\Command\User\Register;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegisterUserCommandValidator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(RegisterUserCommand $command): void
    {
        $errors = $this->validator->validate($command);
        if ($errors->count() === 0) return;
    }
}
