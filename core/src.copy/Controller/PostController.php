<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Redis;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class PostController extends AbstractController
{
    #[Route('/post', name: 'create_post', methods: 'POST')]
    public function createPost(EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        $post->setTitle('test nr ' . mt_rand());
        $post->setContent('content');
        $entityManager->persist($post);
        $entityManager->flush();

        return new JsonResponse($post->toArray());
    }

    #[Route('/redis', name: 'redis_test', methods: 'GET')]
    public function redisTest(Redis $redisDefault)
    {
        $redisDefault->set('test', 'foo');
        var_dump($redisDefault->get('test'));exit;
    }

    #[Route('/posts', name: 'get_posts', methods: 'GET')]
    public function getPosts(EntityManagerInterface $entityManager): Response
    {
        $posts = $entityManager->getRepository(Post::class)->findAll();

        return new JsonResponse(array_map(fn(Post $post) => $post->toArray(), $posts));
    }

    #[Route('/post/{id}', name: 'get_post', methods: 'GET')]
    public function getPost(string $id, EntityManagerInterface $entityManager): Response
    {
        if (!Uuid::isValid($id)) {
            return new JsonResponse(['error' => 'Invalid ID'], Response::HTTP_BAD_REQUEST);
        }
        $post = $entityManager->find(Post::class, $id);
        if (!$post) {
            return new JsonResponse(['error' => 'Post not found'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($post->toArray());
    }
}
