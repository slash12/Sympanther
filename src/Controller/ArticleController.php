<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    private $articlesRepository;

    public function __construct(ArticleRepository $articlesRepository)
    {
        $this->articlesRepository = $articlesRepository;
    }

    /**
     * @Route("/", name="articles_index")
     */
    public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'collection' => $this->articlesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/articles/{slug}", name="article_item")
     */
    public function item(string $slug): Response
    {
        if (null === $article = $this->articlesRepository->findOneBy([
            'slug' => $slug
        ])) {
            throw $this->createNotFoundException();
        }

        return $this->render('article/item.html.twig', ['item' => $article]);
    }
}
