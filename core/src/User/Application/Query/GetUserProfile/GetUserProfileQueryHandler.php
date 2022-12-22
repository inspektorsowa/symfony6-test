<?php

namespace App\User\Application\Query\GetUserProfile;

use App\Common\Messenger\QueryHandlerInterface;
use Redis;
use Symfony\Component\Serializer\SerializerInterface;

class GetUserProfileQueryHandler implements QueryHandlerInterface
{
    private Redis $redis;
    private SerializerInterface $serializer;

    public function __construct(Redis $redisDefault, SerializerInterface $serializer)
    {
        $this->redis = $redisDefault;
        $this->serializer = $serializer;
    }

    public function __invoke(GetUserProfileQuery $query): GetUserProfileView
    {
        $user = $this->redis->get('user_' . $query->getUuid());

        return $this->serializer->deserialize($user, GetUserProfileView::class, 'json');
    }
}
