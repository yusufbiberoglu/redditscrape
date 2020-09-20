<?php

namespace App\Controller;

use App\Entity\RedditPost;
use App\Form\RedditPostType;
use App\Repository\RedditPostRepository;
use App\Service\RedditScraper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class RedditPostController extends AbstractController
{
    /**
     * @Route("/", name="reddit_post_index", methods={"GET"})
     */
    public function index(RedditPostRepository $redditPostRepository, RedditScraper $redditScraper): Response
    {
         $redditScraper->scrape();

        return $this->render('reddit_post/index.html.twig', [
            'reddit_posts' => $redditPostRepository->findAll(),
        ]);
    }

    public function scraper(RedditScraper $redditScraper)
    {
        $result = $redditScraper->scrape();

        dump($result);

        return $this->render('reddit_post/index.html.twig', [
            'posts' => [],
        ]);

    }

    /**
     * @Route("/new", name="reddit_post_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $redditPost = new RedditPost();
        $form = $this->createForm(RedditPostType::class, $redditPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($redditPost);
            $entityManager->flush();

            return $this->redirectToRoute('reddit_post_index');
        }

        return $this->render('reddit_post/new.html.twig', [
            'reddit_post' => $redditPost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reddit_post_show", methods={"GET"})
     */
    public function show(RedditPost $redditPost): Response
    {
        return $this->render('reddit_post/show.html.twig', [
            'reddit_post' => $redditPost,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reddit_post_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RedditPost $redditPost): Response
    {
        $form = $this->createForm(RedditPostType::class, $redditPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reddit_post_index');
        }

        return $this->render('reddit_post/edit.html.twig', [
            'reddit_post' => $redditPost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reddit_post_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RedditPost $redditPost): Response
    {
        if ($this->isCsrfTokenValid('delete'.$redditPost->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($redditPost);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reddit_post_index');
    }
}
