<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\UserRepository;
 
use App\Entity\Project;
 
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
 
use App\DataFixtures\UserFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROJECT_REFERENCE = 'project-project';

    public function load(ObjectManager $manager)
    {
        $user = $this->getReference(UserFixtures::USER_USER_REFERENCE);
        $user2 = $this->getReference(UserFixtures::ADMIN_USER_REFERENCE);

        $project = new Project();
        $project->setUser($user)
            ->setName('Tour Eiffel')
            ->setDescription('Déplacer la Tour Eiffel sur le Mont Gerbier des joncs')
            ->setState('En cours')
            ->setOpenDate(new \DateTime('2020-01-01'))
            ->setScheduleDate(new \DateTime('2021-04-01'))
            ->setIsArchived(false)
            ;
        $manager->persist($project);       
        // $manager->flush();
        $this->addReference(self::PROJECT_REFERENCE, $project);

        $project = new Project();
        $project->setUser($user)
            ->setName('Maison Blanche')
            ->setDescription('Refaire la decoration pour fêter le départ de Donald et préparrer la venue de mikey')
            ->setState('A faire')
            ->setOpenDate(new \DateTime('2021-01-01'))
            ->setScheduleDate(new \DateTime('2021-04-01'))
            ->setIsArchived(false)
            ;
        $manager->persist($project);       
        // $manager->flush();
    
        $project = new Project();
        $project->setUser($user)
            ->setName('Kremlin')
            ->setDescription('Sed efficitur dictum rhoncus. Cras at faucibus leo. Donec ultricies purus quis congue pulvinar. Quisque augue orci, molestie viverra odio eu, dapibus laoreet quam. Aenean id leo non diam luctus laoreet eu gravida tortor. Nunc at velit tempus, sagittis nunc quis, blandit diam. Cras nisi ipsum, iaculis consequat nisi mollis, placerat efficitur quam.')
            ->setState('Fini')
            ->setOpenDate(new \DateTime('2018-01-01'))
            ->setScheduleDate(new \DateTime('2019-04-01'))
            ->setCloseDate(new \DateTime('2019-01-01'))
            ->setIsArchived(false)
            ;
        $manager->persist($project);       

        $project = new Project();
        $project->setUser($user)
            ->setName('Remonter le temps')
            ->setDescription('Sed efficitur dictum rhoncus. Cras at faucibus leo. Donec ultricies purus quis congue pulvinar. Quisque augue orci, molestie viverra odio eu, dapibus laoreet quam. Aenean id leo non diam luctus laoreet eu gravida tortor. Nunc at velit tempus, sagittis nunc quis, blandit diam. Cras nisi ipsum, iaculis consequat nisi mollis, placerat efficitur quam.')
            ->setState('En cours')
            ->setOpenDate(new \DateTime('2020-01-01'))
            ->setScheduleDate(new \DateTime('2020-04-01'))
            ->setCloseDate(new \DateTime(''))
            ->setIsArchived(false)
            ;
        $manager->persist($project);       

        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}