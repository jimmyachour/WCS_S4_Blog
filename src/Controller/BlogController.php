<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;

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
     * @Route("/show/{slug}", name="show", requirements={"slug"="[a-z0-9]+([-][a-z0-9]+)*"})
     */
    public function show(string $slug = 'article-sans-titre'):Response
    {
        $article =  new Article();
        $article->setTitle($slug);

        return $this->render('Blog/show.html.twig', ['title' => $article->getTitle()]);
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


}