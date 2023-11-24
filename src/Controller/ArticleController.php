<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Image;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;


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

            // Vérifiez si un fichier a été téléchargé
            if ($uploadedFile) {
                // Générez un nom de fichier unique
                $newFilename = md5(uniqid()) . '.' . $uploadedFile->guessExtension();

                // Déplacez le fichier vers le répertoire de destination
                try {
                    $uploadedFile->move(
                        $this->getParameter('upload_directory'), // Assurez-vous de configurer le paramètre 'images_directory' dans votre fichier de configuration
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gestion des erreurs lors du déplacement du fichier
                    // ... (vous pouvez ajouter des messages flash ici)
                }

                // Mettez à jour le champ 'image' de l'entité Article avec le nom du fichier
                $article->setImage($newFilename);
            }

            // Enregistrez l'entité dans la base de données
            //$entityManager->persist($article);
            //$entityManager->flush();
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
