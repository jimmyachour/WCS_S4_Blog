<?php


namespace App\Controller;


use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * Page show
     *
     * @Route("/blog/show/{slug}", name="blog_show", requirements={"slug"="[a-z0-9]+([-][a-z0-9]+)*"})
     */
    public function show($slug = 'article-sans-titre'):Response
    {
        $article =  new Article();
        $article->setTitle($slug);

        return $this->render('Blog/show.html.twig', ['title' => $article->getTitle()]);
    }
}