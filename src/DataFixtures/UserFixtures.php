<?php

namespace App\DataFixtures;

use App\Entity\User;
 
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public const ADMIN_USER_REFERENCE = 'admin-user';

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setPassword($this->passwordEncoder->encodePassword($user,'user01'));
        $user->setEmail('user@bank.fr');
        $user->setRoles(['ROLE_USER']);
        $user->setCivility('Mr');
        $user->setLastname('Jhon');
        $user->setFirstname('Doe');
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setPassword($this->passwordEncoder->encodePassword($user,'admin01'));
        $user->setEmail('admin@bank.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setLastname('Johnny');
        $user->setFirstname('Depp');
        $user->setCivility('Mr');
        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::ADMIN_USER_REFERENCE, $user);
    }
}


