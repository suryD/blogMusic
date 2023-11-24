<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController
{
    #[Route('/article', name: 'article_', methods: ['GET'])]
    public function index ( ArticleRepository $articleRepository, Request $request):Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gérez le téléchargement et le stockage de l'image ici
            $uploadedFile = $form['image']->getData();


        }
        return $this->render('article/new.html.twig', [
            'form' => $form->createView(),
            'article' => $articleRepository->findall(),

        ]);
    }




    public function list(): Response
    {

        return $this->render('article/list.html.twig',
        );
    }


}
