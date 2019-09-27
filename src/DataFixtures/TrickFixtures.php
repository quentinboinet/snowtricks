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
        $trickNames = ['Tail grab', 'Mute grab', 'Frontside 360', 'Backflip', 'Slideflip/Lincoln', 'Rodeo', 'Slide 50-50', 'Method air', 'Rocket air', 'Backside triple cork 1440'];
        $trickDescriptions = [
            'Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. » 
Le tail grab consiste à saisir la partie arrière de la planche, avec sa main arrière.',
            'Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. »
Le mute grab est la saisie de la carre frontside de la planche entre les deux pieds avec la main avant.',
            ' On désigne par le mot « rotation » uniquement des rotations horizontales. Le principe est d\'effectuer une rotation horizontale pendant le saut, puis d\'attérir en position switch ou normal.
Le frontside 360 consiste à réaliser un tour entier, soit 360 degrès.',
            'Il consiste à réaliser un salto arrière. Concrètement, afin de le réaliser, vous devez lancer votre têtes (et épaules) en arrière en essayant le plus vite possible d’avoir un contact visuel avec votre réception. Au moment du pop (qui doit impérativement se faire au dernier moment, c’est-à-dire sur l’arrête du kicker), pensez à donner un bon coup de bassin pour essayer de monter vos hanches vers le haut. Cela vous permettra de réaliser un beau backflip dit « laid out », autrement dit, allongé.
Attention, la synchronisation du pop et du déséquilibre arrière est extrêmement importante pour garder au mieux le contrôle dans votre backflip. Comme vous pourrez le voir, il est essentiel de vite voir votre réception afin de savoir quand déplier votre backflip, et ainsi, contrôler au mieux votre rotation. Ce qu’il faut à tout pris éviter c’est de underrotate (ne pas tourner assez) ou d’overrorate (tourner trop et partir sur 1,5 backflip par exemple). ',
            'Le sideflip en ski freestyle est une figure relativement simple à réaliser. Il s’agît simplement de réaliser un flip sur le côté (d’où « side »). Vous devrez donc sauter en lançant votre corps vers la droite ou vers la gauche (selon votre préférence) et essayer au maximum de cruncher (plier) votre corps pour contrôler au mieux votre rotation. ',
            'Ce flip consiste à réaliser à la fois un backflip et une rotation (180, 360,540,…).
Afin de le réaliser, vous devrez lancer votre rotation de côté et légèrement en arrière. ',
            'Ce slide est une figure facile à apprendre et très bien pour débuter.
Il s\'agit simplement de se laisser glisser sur le module de slide que l\'on aborde. ',
            'Cette figure – qui consiste à attraper sa planche d\'une main et le tourner perpendiculairement au sol – est un classique "old school". Il n\'empêche qu\'il est indémodable, avec de vrais ambassadeurs comme Jamie Lynn ou la star Terje Haakonsen. En 2007, ce dernier a même battu le record du monde du "air" le plus haut en s\'élevant à 9,8 mètres au-dessus du kick (sommet d\'un mur d\'une rampe ou autre structure de saut). ',
            'Cette figure, catégorisée de "old school" est réalisée avec la main avant qui attrape la carre front devant la fix avant (mute), la jambe arrière est tendue et la board est perpendiculaire au sol.',
            'En langage snowboard, un cork est une rotation horizontale plus ou moins désaxée, selon un mouvement d\'épaules effectué juste au moment du saut. Le tout premier Triple Cork a été plaqué par Mark McMorris en 2011, lequel a récidivé lors des Winter X Games 2012... avant de se faire voler la vedette par Torstein Horgmo, lors de ce même championnat. Le Norvégien réalisa son propre Backside Triple Cork 1440 et obtint la note parfaite de 50/50. '
        ];

        $trickVideos = [[], [], ['0'], ['1'], [], ['2', '3'], ['4'], ['5'], ['6'], ['7']];
        $trickPictures = [['0', '1'], ['2', '3', '4'], [], ['5', '6'], ['7'], ['8', '9'], ['10'], ['11', '12'], ['13', '14'], ['15', '16']];

        $this->createMany(10, Trick::class, function ($i) use ($trickPictures, $trickVideos, $trickDescriptions, $trickNames, $manager) {
            $trick = new Trick();
            $trick->setAuthorName($this->getRandomReference('main_users'))
                ->setName($trickNames[$i])
                ->setSlug(strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $trickNames[$i]), '-')))
                ->setDescription($trickDescriptions[$i])
                ->setPublishedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime());

            if (count($trickPictures[$i]) > 0) {
                foreach ($trickPictures[$i] as $trickPicture) {
                    $trick->addPicture($this->getReference(Picture::class . '_' . $trickPicture));
                }
            }

            if (count($trickVideos[$i]) > 0) {
                foreach ($trickVideos[$i] as $trickVideo) {
                    $trick->addVideo($this->getReference(Video::class . '_' . $trickVideo));
                }
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
