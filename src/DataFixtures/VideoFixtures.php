<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Common\Persistence\ObjectManager;

class VideoFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $videoUrls = ['https://www.youtube.com/embed/9T5AWWDxYM4', 'https://www.youtube.com/embed/Q_R3yJLuMZw', 'https://www.youtube.com/embed/vf9Z05XY79A', 'https://www.youtube.com/embed/u5UNlhdNNTg', 'https://www.youtube.com/embed/kxZbQGjSg4w', 'https://www.youtube.com/embed/2Ul5P-KucE8', 'https://www.youtube.com/embed/nom7QBoGh5w', 'https://www.youtube.com/embed/Br6ZJM01I6s'];
        $this->createMany(8, Video::class, function ($i) use ($videoUrls, $manager) {
            $video = new Video();
            $video->setUrl($videoUrls[$i]);

            return $video;
        });

        $manager->flush();
    }
}
