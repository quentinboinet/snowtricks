<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TrickFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<=50; $i++)
        {
            $trick = new Trick();
            $trick->setAuthorName('Quentin Boinet')
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
                ->setCategory('Rotation')
                ->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))))
                ->setUpdatedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));

            $manager->persist($trick);
        }
        $manager->flush();
    }
}
