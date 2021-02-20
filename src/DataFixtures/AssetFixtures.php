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
        'https://pixabay.com/photos/crystal-rock-crystal-mineral-1685590/',
        'https://pixabay.com/photos/amethyst-crystal-purple-macro-1394397/',
        'https://pixabay.com/photos/gems-gemstones-semi-precious-stones-1400677/',
        'https://pixabay.com/photos/precious-stone-pierre-crystal-3259727/',
        'https://pixabay.com/photos/stones-gems-crystal-precious-498592/',

    ];

    const SCULPTURESPHOTOS = [
        'https://pixabay.com/photos/buddha-statue-buddhism-sculpture-199462/',
        'https://pixabay.com/photos/angel-statue-figure-stone-2401263/',
        'https://pixabay.com/photos/sculpture-bronze-bronze-statue-3410011/',
        'https://pixabay.com/photos/sculpture-julius-caesar-statue-art-3357150/',
        'https://pixabay.com/photos/sculpture-christ-figure-3408348/',
        'https://pixabay.com/photos/buddha-statue-temple-buddhism-5082641/',
    ];

    const COINSPHOTOS = [
        'https://pixabay.com/photos/gold-coin-museum-treasure-thaler-1633073/',
        'https://pixabay.com/photos/coins-cent-specie-money-euro-232010/',
        'https://pixabay.com/photos/coins-money-currency-euro-specie-3652814/',
        'https://pixabay.com/photos/coins-gold-golden-bounty-riches-1637722/',
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

