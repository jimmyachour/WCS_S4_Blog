<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;

use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/** @Route("/blog", name="blog_") */
class BlogController extends AbstractController
{
    /**
     * Page accueil
     *
     * @Route("/", name="index")
     */
    public function index():Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        return $this->render('Blog/index.html.twig', ['articles' => $articles]);
    }

    /**
     * Page show
     *
     * @Route("/article/{id}", name="article")
     */
    public function show(Article $article):Response
    {
        return $this->render('Blog/show.html.twig', ['article' => $article]);
    }

    /**
     * Page show by category
     *
     * @Route("/category/{name}", name="category")
     */
    public function showByCategory(Category $category): Response
    {
        $articles = $category->getArticles();

        return $this->render('Blog/category.html.twig', ['articles' => $articles, 'category' => $category]);
    }

    /**
     * Page show tag
     *
     * @Route("/tag/{name}", name="tag")
     */
    public function showByTag(Tag $tag): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $listTags = $entityManager->getRepository(Tag::class)->findAll();

        return $this->render('Blog/tag.html.twig', ['tag' => $tag, 'listTags' => $listTags]);
    }


}