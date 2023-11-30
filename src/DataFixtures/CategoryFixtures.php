<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        CategoryFactory::createSequence(
            json_decode(
                file_get_contents(__DIR__.'/data/Category.json'),
                JSON_OBJECT_AS_ARRAY
            )
        );
    }

    public function getDependencies()
    {
        return [
            ContactFixtures::class,
        ];
    }
}
