<?php

namespace App\Domain\Blog\Repository;

use App\Domain\Blog\Aggregate\PostAggregate;
use App\Domain\Blog\Aggregate\PostsListAggregate;
use App\Domain\Shared\ValueObject\Uuid;

interface PostRepositoryInterface
{
    public function findById(Uuid $id): PostAggregate;
    public function findAll(): PostsListAggregate;
    public function save(Post $post);
    public function delete(Post $post);
}
