<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        $user = new User();
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $user->setEmail("jeandesir84@gmail.com");
        $user->setUser("$faker->name");
        $user->setAdress("$faker->address");
        $user->setCity("$faker->city");
        $user->setAccompte("$faker->randomDigit");
        $user->setCategory("$faker->randomDigit");
        $user->setZipCiode("$faker->randomDigit");

        $manager->persist($user);
        $manager->flush();

        $faker = \Faker\Factory::create('fr_FR');
        $b = mt_rand(5, 100);
        for ($j = 0; $j < $b; $j++) {

            $user = new User();
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
            $user->setEmail("$faker->email");
            $user->setUser("$faker->name");
            $user->setAdress("$faker->address");
            $user->setCity("$faker->city");
            $user->setAccompte("$faker->randomDigit");
            $user->setCategory("$faker->randomDigit");
            $user->setZipCiode("$faker->randomDigit");

            $manager->persist($user);
            $manager->flush();
        }
    }
}
