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
    const NB_OBJECT = 10;

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {

        // Création d’un utilisateur de type “contributeur” (= auteur)
        for ($i = 1; $i <= self::NB_OBJECT; $i++) {
            $adventurer = new User();
            $adventurer->setName('adventurer' . $i);
            $adventurer->setRoles(['ROLE_USER']);
            $adventurer->setPassword($this->passwordEncoder->encodePassword(
                $adventurer,
                'user'
            ));

            $manager->persist($adventurer);
            $this->addReference('adventurer_' . $i, $adventurer);
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

