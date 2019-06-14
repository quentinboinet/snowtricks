<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_users', function($i) {
            $user = new User();
            $user->setUsername(sprintf('dummy_user%d', $i));
            $user->setEmail(sprintf('dummy_user%d@gmail.com', $i));
            $user->setLastName($this->faker->lastName);
            $user->setFirstName($this->faker->firstName);
            return $user;
        });
        $manager->flush();
    }
}
