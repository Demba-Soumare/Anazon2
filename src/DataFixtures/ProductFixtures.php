<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setName('Ballon de foot');
        $product->setDescription('Ballon de foot');
        $product->setPrice(10);
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_1, Category::class));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Valise');
        $product->setDescription('Valise');
        $product->setPrice(10);
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_2, Category::class));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Jeu de cartes');
        $product->setDescription('Jeu de cartes');
        $product->setPrice(10);
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_3, Category::class));
        $manager->persist($product);

        $product = new Product();
        $product->setName('maillot de foot');
        $product->setDescription('maillot de foot');
        $product->setPrice(10);
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_1, Category::class));
        $manager->persist($product);

        $manager->flush();   
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class
        ];
    }
}
