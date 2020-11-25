<?php

namespace App\DataFixtures;

use App\Entity\Car;
use Faker\Factory;
use App\Entity\Mark;
use App\Entity\Model;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        
        $mark1 = new Mark(); 
        $mark1->setName("Yotota");
        $manager->persist($mark1);
        
        $mark2 = new Mark(); 
        $mark2->setName("Jeupo");
        $manager->persist($mark2);

        $model1 = new Model();
        $model1->setName("Rayis")
                ->setImage("modele2.jpg")
                ->setAvgprice(16000)
                ->setMark($mark1);
        $manager->persist($model1);
        
        $model2 = new Model();
        $model2->setName("Locora")
                ->setImage("modele2.jpg")
                ->setAvgprice(20000)
                ->setMark($mark1);
        $manager->persist($model2);
        
        $model3 = new Model();
        $model3->setName("007")
                ->setImage("modele3.jpg")
                ->setAvgprice(24000)
                ->setMark($mark2);
        $manager->persist($model3);
        
        $model4 = new Model();
        $model4->setName("004")
                ->setImage("modele4.jpg")
                ->setAvgprice(32000)
                ->setMark($mark2);
        $manager->persist($model4);

        $model5 = new Model();
        $model5->setName("009")
                ->setImage("modele5.jpg")
                ->setAvgprice(25000)
                ->setMark($mark2);
        $manager->persist($model5);

        $faker = Factory::create('fr_FR');
      
        $models = [$model1,$model2,$model3,$model4,$model5];

        foreach($models as $m) {
            $rand = rand(3,5);
            for($i=1; $i<=$rand; $i++){
                $car = new Car;
                $car->setRegistration($faker->regexify("[A-Z]{2}[0-9]{3,4}[A-Z]{2}"))
                    ->setDoor($faker->randomElement($array= array(3,5)))
                    ->setYear($faker->numberBetween($min=2000,$max=2020))
                    ->setModel($m);
                $manager->persist($car);
            }
        }
        
        $manager->flush();
    }
}
