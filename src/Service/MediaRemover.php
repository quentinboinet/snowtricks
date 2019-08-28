<?php


namespace App\Service;


use App\Entity\Trick;
use App\Repository\PictureRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;

class MediaRemover extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function picturesRemove(int $nbrePicturesToDelete, array $picturesToDelete, PictureRepository $pictureRepo, Trick $trick)
    {
        $fileSystem = new Filesystem();
        for ($i = 0; $i < $nbrePicturesToDelete; $i++) {
            if ($picturesToDelete[$i] != "")//dernier élément du tableau
            {
                $picture = $pictureRepo->find($picturesToDelete[$i]);
                $this->em->remove($picture);

                //on la supprime du serveur
                $fileName = $this->getParameter('kernel.project_dir') . '/public' . $picture->getPath();
                $fileSystem->remove($fileName);

                $trick->removePicture($picture);
            }
        }
    }

    public function videosRemove(int $nbreVideosToDelete, array $videosToDelete, VideoRepository $videoRepo, Trick $trick)
    {
        for ($i = 0; $i < $nbreVideosToDelete; $i++) {
            if ($videosToDelete[$i] != "") {
                $video = $videoRepo->find($videosToDelete[$i]);
                $this->em->remove($video);
                $trick->removeVideo($video);
            }
        }
    }
}