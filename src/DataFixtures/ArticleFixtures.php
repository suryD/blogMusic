<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;



class ArticleFixtures extends Fixture
{
   public function load(ObjectManager $manager): void

    {
        // Créez et persistez des objets Article avec des données d'exemple
        for ($i = 1; $i <= 10; $i++) {
            $article = new Article();
            $article->setTitle('Article ' . $i);
            $article->setContent('Contenu de l\'article ' . $i);

            // Assurez-vous que vous avez une relation bidirectionnelle avec l'entité User.
            // $user est une instance d'entité User ou null, selon votre cas.
            $user = $this->getReference('user_' . rand(1, 5));
            $article->setUser($user);

            $manager->persist($article);
        }

        $manager->flush();
    }
    }
