<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Faker\Factory;
use App\Entity\Product;
use Bezhanov\Faker\Provider\Commerce;
use Bluemmb\Faker\PicsumPhotosProvider;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker));

        $colorCategory= ['success','danger','warning','info','dark'];

        for ($c=0; $c < 5 ; $c++) 
        { 
            $category = new Category();

            $category->setName($faker->department())
                     ->setColor($colorCategory[$c]);

            $manager->persist($category);
            
            for ($p=1; $p < 10 ; $p++) 
            { 
                $product = new Product();

                $product->setName($faker->productName())
                        ->setShortDescription($faker->sentence(20))
                        ->setPrice($faker->randomFloat(2,10,300))
                        ->setLongDescription($faker->paragraph(50))
                        ->setQuantity($faker->numberBetween(0,50))
                        ->setVisible($faker->boolean())
                        ->setCreatedAt($faker->dateTimeThisYear())
                        ->setMainPicture($faker->imageUrl(300, 300, true))
                        ->setCategory($category);

                $manager->persist($product);            
            }
            $manager->flush();
        } 
    }
}

