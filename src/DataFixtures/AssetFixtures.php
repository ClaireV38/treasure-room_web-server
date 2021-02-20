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
        'https://cdn.pixabay.com/photo/2015/01/17/13/52/gem-602252__340.jpg',
        'https://cdn.pixabay.com/photo/2016/09/21/20/24/crystal-1685590__340.jpg',
        'https://cdn.pixabay.com/photo/2017/09/06/21/43/crystal-2723145__340.jpg',
        'https://cdn.pixabay.com/photo/2013/06/08/19/15/diamond-123338__340.jpg',
        'https://cdn.pixabay.com/photo/2016/02/14/09/45/diamond-1199183__340.jpg',

    ];

    const SCULPTURESPHOTOS = [
        'https://cdn.pixabay.com/photo/2013/10/22/19/54/buddha-199462__340.jpg',
        'https://cdn.pixabay.com/photo/2017/06/14/06/51/angel-2401263__340.jpg',
        'https://cdn.pixabay.com/photo/2018/10/11/17/38/angel-3740393__340.jpg',
        'https://cdn.pixabay.com/photo/2018/05/17/23/45/sculpture-3410011__340.jpg',
        'https://cdn.pixabay.com/photo/2018/04/28/12/17/sculpture-3357150__340.jpg',
        'https://cdn.pixabay.com/photo/2016/11/19/21/04/angel-1841177__340.jpg',
    ];

    const COINSPHOTOS = [
        'https://cdn.pixabay.com/photo/2016/08/31/10/43/gold-1633073__340.jpg',
        'https://cdn.pixabay.com/photo/2018/09/23/18/38/coins-3698092__340.jpg',
        'https://cdn.pixabay.com/photo/2017/12/17/14/12/bitcoin-3024279__340.jpg',
        'https://cdn.pixabay.com/photo/2015/01/19/23/18/money-605075__340.jpg',
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
            $asset->setOwner($this->getReference('adventurer_' . rand(1, count(UserFixtures::ADVENTURERS))));
            $asset->setCategory($this->getReference('category_3'));
            $manager->persist($asset);
            $this->addReference('asset_' . $i, $asset);
        }
        $manager->flush();
    }
}

