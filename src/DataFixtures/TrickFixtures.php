<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\Video;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TrickFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(50, Trick::class, function($i) use ($manager){
            $trick = new Trick();
            $trick->setAuthorName($this->getRandomReference('main_users'))
                ->setName('Backflip-' . $i)
                ->setSlug('backflip-' . $i)
                ->setDescription(<<<EOF
                Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
                lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
                labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
                **turkey** shank eu pork belly meatball non cupim.
                Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
                laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
                capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
                picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
                occaecat lorem meatball prosciutto quis strip steak.
                Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
                mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
                strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
                cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
                fugiat.
            EOF
                )
                ->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))))
                ->setUpdatedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));

            $pictures = $this->getRandomReferences(Picture::class, $this->faker->numberBetween(0, 5));
            foreach ($pictures as $picture) {
                $trick->addPicture($picture);
            }

            $videos = $this->getRandomReferences(Video::class, $this->faker->numberBetween(0, 5));
            foreach ($videos as $video) {
                $trick->addVideo($video);
            }

            $category = $this->getRandomReference(Category::class);
            $trick->setCategory($category);

            return $trick;
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        //on s'assure que les images soient bien chargées et crées avant de les associer à des tricks
        return [
            CategoryFixtures::class, PictureFixtures::class, VideoFixtures::class, UserFixtures::class,
        ];
    }
}
