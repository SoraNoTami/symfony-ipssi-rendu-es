<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Product;
use App\Entity\Article;
use App\Entity\Category;
use App\Form\ProductType;
use App\Form\ArticleType;
use App\Form\CategoryType;
use App\Repository\ProductRepository;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
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
    
    //Edit an Article
    #[Route('/article/edit/{id}', name: 'app_article_edit', methods: ['GET', 'POST'])]
    public function editArticle(Request $request, Article $article, ArticleRepository $articleRepository): Response
    {
        // $author = $article->getAuthor()->getId();
        // $user = $this->getUser()->getId();

            // if ($user == $author) {
                $form = $this->createForm(ArticleType::class, $article);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $article->setUpdatedAt(new DateTimeImmutable('now'));
                    $articleRepository->save($article, true);

                    return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
                }

                return $this->renderForm('content/article/edit.html.twig', [
                    'article' => $article,
                    'form' => $form,
                ]);
            // }else {
            //     return $this->redirectToRoute('app_home');
            // } 
        
    }

    // Delete an Article
    #[Route('/article/delete/{id}', name: 'app_article_delete')]
    public function deleteArticle(Article $article, ArticleRepository $articleRepository)
    {
        $articleRepository->remove($article, true);

        return $this->redirectToRoute('app_home');
    }

    // Create a Product
    #[Route('/product/create', name: 'app_product_create', methods: ['GET', 'POST'])]
    public function createProduct(Request $request, ProductRepository $productRepository): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setCreatedAt(new DateTimeImmutable('now'));
            $product->setSeller($user);
            $productRepository->save($product, true);

            return $this->redirectToRoute('app_products', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('content/product/create.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }
    
    // Edit a Product 
    #[Route('/product/edit/{id}', name: 'app_product_edit', methods: ['GET', 'POST'])]
    public function editProduct(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setUpdatedAt(new DateTimeImmutable('now'));
            $productRepository->save($product, true);

            return $this->redirectToRoute('app_products', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('content/product-edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    //Delete a Product
    #[Route('/product/delete/{id}', name: 'app_product_delete')]
    public function deleteProduct(Product $product, ProductRepository $productRepository)
    {
        $productRepository->remove($product, true);

        return $this->redirectToRoute('app_products');
    }

    //Create a Category
    #[Route('/category/create', name: 'app_category_create', methods: ['GET', 'POST'])]
    public function createCategory(Request $request, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->save($category, true);

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    //Edit a Category
    #[Route('/category/edit/{id}', name: 'app_category_edit', methods: ['GET', 'POST'])]
    public function editCategory(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->save($category, true);

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    //Delete a Category
    #[Route('/category/delete/{id}', name: 'app_category_delete', methods: ['POST'])]
    public function deleteCategory(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->request->get('_token'))) {
            $categoryRepository->remove($category, true);
        }

        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
}
