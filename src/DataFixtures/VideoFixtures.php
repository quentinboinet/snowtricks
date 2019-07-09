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
            $video->setUrl('https://www.youtube.com/embed/dSZ7_TXcEdM');

            return $video;
        });

        $manager->flush();
    }
}
