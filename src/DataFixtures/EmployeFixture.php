<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Employe;

class EmployeFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
      
      for ($i=1; $i <=10 ; $i++) { 
     
        $employe= new Employe();

        $employe->setMatricule("matricule $i")
                ->setNomcomplet("nom de lelement $i")
                ->setDatenaissance(new\DateTime())
                ->setSalaire(15454);

                $manager->persist($employe);
      }

        $manager->flush();
    }
}
