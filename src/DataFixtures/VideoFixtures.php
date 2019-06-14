<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VideoFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, Video::class, function($i) use ($manager){
            $video = new Video();
            $video->setUrl('/images/logo.png');

            return $video;
        });

        $manager->flush();
    }
}
