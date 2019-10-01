<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager; 
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
    * @var UserPasswordEncoderInterface
    */
   private $encoder;
 
   /**
    * @var EntityManager
    */
   private $entityManager;
 
   /**
    * UserFixtures constructor.
    * @param UserPasswordEncoderInterface $encoder Password encoder instance
    */
   public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $entityManager) 
   {
        $this->encoder = $encoder;
        $this->entityManager = $entityManager;
   }

   public function load(ObjectManager $manager)
   {
        $user = new User();
        $user->setUsername('sf4user');
        $user->setEmail('sf4user@sf4server.com');
        $password = $this->encoder->encodePassword($user, 'abc123');
        $user->setPassword($password);
 
        $this->entityManager->persist($user);
        $this->entityManager->flush();
   }
}
