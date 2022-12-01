<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActionController extends AbstractController
{   
    // Create an Article
    #[Route('/article/create', name: 'app_article_create', methods: ['GET', 'POST'])]
    public function createArticle(Request $request, ArticleRepository $articleRepository): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setAuthor($user);
            $article->setCreatedAt(new DateTimeImmutable('now'));
            $articleRepository->save($article, true);

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('content/article/create.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }
}
