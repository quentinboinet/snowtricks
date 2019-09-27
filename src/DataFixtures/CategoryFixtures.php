<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $categoryNames = ['Grab', 'Rotation', 'Flip', 'Slide', 'Old school'];
        $this->createMany(5, Category::class, function($i) use ($categoryNames, $manager){
            $category = new Category();
            $category->setName($categoryNames[$i]);

            return $category;
        });

        $manager->flush();
    }
}
