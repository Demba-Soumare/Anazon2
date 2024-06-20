<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const CATEGORY_1 = 'CATEGORY_1';
    const CATEGORY_2 = 'CATEGORY_2';
    const CATEGORY_3 = 'CATEGORY_3';


    public function load(ObjectManager $manager): void
    {
        $category = new Category();
        $category->setName('Sport');
        $category->setDescription('Catégorie sport');
        $this->addReference(self::CATEGORY_1, $category);
        $manager->persist($category);

        $category = new Category();
        $category->setName('Voyage');
        $category->setDescription('Catégorie voyage');
        $this->addReference(self::CATEGORY_2, $category);
        $manager->persist($category);

        $category = new Category();
        $category->setName('Loisir');
        $category->setDescription('Catégorie loisir');
        $this->addReference(self::CATEGORY_3, $category);
        $manager->persist($category);

        $manager->flush();
    }
}
