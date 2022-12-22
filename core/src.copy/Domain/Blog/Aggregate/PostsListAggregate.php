<?php

namespace App\Domain\Blog\Aggregate;

use App\Domain\Blog\Entity\Post;
use Traversable;

class PostsListAggregate implements \IteratorAggregate
{
    private array $posts;

    public function __construct(Post ...$posts)
    {
        $this->posts = $posts;
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->posts);
    }
}
