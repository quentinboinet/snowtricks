<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_users', function($i) {
            $user = new User();
            $user->setUsername(sprintf('dummy_user%d', $i));
            $user->setEmail(sprintf('dummy_user%d@gmail.com', $i));
            $user->setLastName($this->faker->lastName);
            $user->setFirstName($this->faker->firstName);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'password'
            ));
            $user->setStatus(1);
            return $user;
        });

        $this->createMany(3, 'admin_users', function($i) {
            $user = new User();
            $user->setUsername(sprintf('admin_user%d', $i));
            $user->setEmail(sprintf('admin_user%d@gmail.com', $i));
            $user->setLastName($this->faker->lastName);
            $user->setFirstName($this->faker->firstName);
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'password'
            ));
            $user->setStatus(1);
            return $user;
        });
        $manager->flush();
    }
}
