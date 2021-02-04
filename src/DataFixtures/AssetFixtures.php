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

    const STONESPHOTOS = [
        'amethyst.jpg',
        'crystal.jpg',
        'diamond1.jpg',
        'diamond2.jpg',
        'stones.jpg',

    ];

    const SCULPTURESPHOTOS = [
        'buddha.jpg',
        'throne.png',
        'sculpture.jpg',
        'flying-carpet.png',
        'angel.jpg',
        'skull.jpg',
    ];

    const COINSPHOTOS = [
        'treasure.jpg',
        'vintage.jpg',
        'gold.jpg',
        'bitcoin.jpg',
    ];

    public function getDependencies()
    {
        return [UserFixtures::class, CategoryFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 10; $i++) {
            $asset= new Asset();
            $asset->setTitle($faker->sentence(2, true));
            $asset->setPlaceOfDiscovery($faker->sentence(3, true));
            $asset->setDepositDate(new DateTime('now'));
            $asset->setValue(
                $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = NULL)
            );
            $asset->setPhoto(SELF::STONESPHOTOS[array_rand (SELF::STONESPHOTOS  , 1 )]);
            $asset->setUpdatedAt(new DateTime('now'));
            $asset->setOwner($this->getReference('adventurer_' . rand(1, count(UserFixtures::ADVENTURERS))));
            $asset->setCategory($this->getReference('category_1'));
            $manager->persist($asset);
            $this->addReference('asset_' . $i, $asset);
        }
        for ($i = 11; $i <= 20; $i++) {
            $asset= new Asset();
            $asset->setTitle($faker->sentence(2, true));
            $asset->setPlaceOfDiscovery($faker->sentence(3, true));
            $asset->setDepositDate(new DateTime('now'));
            $asset->setValue(
                $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = NULL)
            );
            $asset->setPhoto(SELF::SCULPTURESPHOTOS[array_rand (SELF::SCULPTURESPHOTOS  , 1 )]);
            $asset->setUpdatedAt(new DateTime('now'));
            $asset->setOwner($this->getReference('adventurer_' . rand(1, count(UserFixtures::ADVENTURERS))));
            $asset->setCategory($this->getReference('category_2'));
            $manager->persist($asset);
            $this->addReference('asset_' . $i, $asset);
        }
        for ($i = 21; $i <= SELF::NB_OBJECT; $i++) {
            $asset= new Asset();
            $asset->setTitle($faker->sentence(2, true));
            $asset->setPlaceOfDiscovery($faker->sentence(3, true));
            $asset->setDepositDate(new DateTime('now'));
            $asset->setValue(
                $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = NULL)
            );
            $asset->setPhoto(SELF::COINSPHOTOS[array_rand (SELF::COINSPHOTOS  , 1 )]);
            $asset->setUpdatedAt(new DateTime('now'));
            $asset->setOwner($this->getReference('adventurer_' . rand(1, count(UserFixtures::ADVENTURERS))));
            $asset->setCategory($this->getReference('category_3'));
            $manager->persist($asset);
            $this->addReference('asset_' . $i, $asset);
        }
        $manager->flush();
    }
}

