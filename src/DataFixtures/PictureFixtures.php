<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Common\Persistence\ObjectManager;

class PictureFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, Picture::class, function($i) use ($manager){
            $picture = new Picture();
            $picture->setPath('/images/logo.png');

            return $picture;
        });

        $manager->flush();
    }
}
