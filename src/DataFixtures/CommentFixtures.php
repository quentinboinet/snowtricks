<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Trick;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(100, Comment::class, function($i) use ($manager){
            $comment = new Comment();
            $comment->setUser($this->getRandomReference('main_users'));
            $comment->setTrick($this->getRandomReference(Trick::class));
            $comment->setContent($this->faker->sentence(6, true));
            $comment->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));

            return $comment;
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class, TrickFixtures::class,
        ];
    }
}
