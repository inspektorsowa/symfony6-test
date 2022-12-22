<?php

namespace App\Domain\Blog\Aggregate;

use App\Domain\Blog\Entity\Post;

class PostAggregate
{
    private Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getPost(): Post
    {
        return $this->post;
    }
}
