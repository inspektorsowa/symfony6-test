<?php

namespace App\User\Application\Query\GetUserProfile;

use App\Common\Messenger\QueryInterface;
use Symfony\Component\Validator\Constraints as Assert;

class GetUserProfileQuery implements QueryInterface
{
    #[Assert\UUid(versions: [4])]
    private string $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
