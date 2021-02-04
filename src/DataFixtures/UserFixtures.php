<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    /**
     * nb objects to create
     * @var int
     */
    const ADVENTURERS = ['Jason','Ulysse','Helene','Salakis','Heracles','Achille','Egée','Oedipe','Persée','Sirtakis'];

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {

        // Création d’un utilisateur de type “contributeur” (= auteur)
        foreach (SELF::ADVENTURERS as $key => $hero) {
            $adventurer = new User();
            $adventurer->setName($hero);
            $adventurer->setRoles(['ROLE_USER']);
            $adventurer->setPassword($this->passwordEncoder->encodePassword(
                $adventurer,
                'user'
            ));

            $manager->persist($adventurer);
            $this->addReference('adventurer_' . ($key + 1), $adventurer);
        }

        // Création d’un utilisateur de type “administrateur”
        $admin = new User();
        $admin->setName('admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));

        $manager->persist($admin);
        $this->addReference('admin', $admin);

        $manager->flush();
    }
}

