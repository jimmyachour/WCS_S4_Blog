<?php


namespace App\DataFixtures;

use Faker;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');


        for ($x = 0; $x <= 50; $x++) {

            $article = new Article();
            $article->setTitle(strtolower($faker->sentence(6, true)));
            $article->setContent(strtolower($faker->paragraphs( 3, true)));

            $manager->persist($article);
            $article->setCategory($this->getReference('categorie_'. rand(0, 6)));
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }

}