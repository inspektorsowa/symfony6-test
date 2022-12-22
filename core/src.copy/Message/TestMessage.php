<?php

namespace App\Message;

use Symfony\Component\Validator\Constraints as Assert;

class TestMessage implements MessageInterface
{
    #[Assert\Length(min: 5)]
    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
