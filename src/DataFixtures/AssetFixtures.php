<?php

namespace App\DataFixtures;

use App\DataFixtures\UserFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Asset;
use DateTime;
use App\DataFixtures\CategoryFixtures;


class AssetFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * nb objects to create
     * @var int
     **/
    public const NB_OBJECT = 30;

    const PHOTOS = ['amethyst.jpg', 'buddha.jpg', 'crystal.jpg', 'diamond1.jpg', 'diamond2.jpg', 'flying-carpet.png', 'sculpture.jpg', 'stone.jpg', 'throne.png'];

    public function getDependencies()
    {
        return [UserFixtures::class, CategoryFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= self::NB_OBJECT; $i++) {
            $asset= new Asset();
            $asset->setTitle($faker->sentence(2, true));
            $asset->setPlaceOfDiscovery($faker->sentence(3, true));
            $asset->setDepositDate(new DateTime('now'));
            $asset->setValue(
                $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = NULL)
            );
            $asset->setPhoto(SELF::PHOTOS[array_rand (SELF::PHOTOS  , 1 )]);
            $asset->setUpdatedAt(new DateTime('now'));
            $asset->setOwner($this->getReference('adventurer_' . rand(1, UserFixtures::NB_OBJECT)));
            $asset->setCategory($this->getReference('category_' . rand(1, count(CategoryFixtures::CATEGORIES)-1)));
            $manager->persist($asset);
            $this->addReference('asset_' . $i, $asset);
        }
        $manager->flush();
    }
}

