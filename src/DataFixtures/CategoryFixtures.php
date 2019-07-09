<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, Category::class, function($i) use ($manager){
            $category = new Category();
            $category->setName($this->faker->jobTitle);

            return $category;
        });

        $manager->flush();
    }
}
