<?php

namespace App\DataFixtures;

use App\Entity\Supplier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;

class SupplierFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker::create('ru_RU');

        for ($i = 0; $i < 50; ++$i) {
            $supplier = new Supplier();
            $supplier->setName($faker->company);
            $manager->persist($supplier);
        }

        $manager->flush();
    }
}
