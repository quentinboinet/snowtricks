<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Common\Persistence\ObjectManager;

class PictureFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $pictureNames = ['5d5a941204470.jpeg', '5d5a94120527e.jpeg', '5d5a948041b99.jpeg', '5d5a9480435a4.jpeg', '5d5a948043e57.jpeg', '5d5a96073dc58.jpeg', '5d5a96073e4bb.jpeg', '5d5a96b89e87e.jpeg', '5d5a9754063fa.jpeg', '5d5a975408ab9.jpeg', '5d5a98c7d1b65.jpeg', '5d5a99b8d3b56.jpeg', '5d5a99b8d431d.jpeg', '5d5a9aa59c33b.jpeg', '5d5a9aa59d6e8.jpeg', '5d5a9bf743748.jpeg', '5d5a9bf744855.jpeg'];
        $pictureAlt = ['Tail grab', 'Tail grab 2', 'Mute grab', 'Mute grab 2', 'Mute grab 3', 'Backflip', 'Backflip 2', 'Sideflip/Lincoln', 'Rodeo', 'Rodeo', 'Slide 50-50', 'Method air', 'Method air 2', 'Rocket air', 'Rocket air 2', 'Backside triple cork 1440', 'Backside triple cork 1440 2'];
        $this->createMany(17, Picture::class, function($i) use ($pictureAlt, $pictureNames, $manager){
            $picture = new Picture();
            $picture->setPath('/images/uploads/' . $pictureNames[$i]);
            $picture->setAlt($pictureAlt[$i]);

            return $picture;
        });

        $manager->flush();
    }
}
