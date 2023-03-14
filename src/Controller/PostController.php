<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use App\Repository\TeaserRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/post')]
class PostController extends AbstractController
{
    #[Route('/', name: 'app_post_index', methods: ['GET'])]
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }

    /**
     * @throws NonUniqueResultException
     */
    #[Route('/{id}/{exclude}', name: 'app_post_show', defaults: ['exclude' => '0'], methods: ['GET'])]
    public function show(Post $post, string $exclude, PostRepository $postRepository, TeaserRepository $teaserRepository): Response
    {
        $excludeIds = explode('-', $exclude);
        $excludeIds[] = $post->getId();
        $teasers = $teaserRepository->findAll();
        shuffle($teasers);

        return $this->render('post/show.html.twig', [
            'post' => $post,
            'next' => $postRepository->getNextPost(array_values($excludeIds)),
            'teasers' => $teasers,
        ]);
    }
}
