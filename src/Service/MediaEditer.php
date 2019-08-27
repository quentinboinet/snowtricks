<?php


namespace App\Service;


use App\Entity\Picture;
use App\Entity\Trick;
use App\Repository\PictureRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class MediaEditer extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function picturesEdit(int $nbrePicturesToEdit, array $picturesToEdit, Request $request, PictureRepository $pictureRepo, Trick $trick, $category)
    {
        $fileSystem = new Filesystem();
        for ($i = 0; $i < $nbrePicturesToEdit; $i++) {
            if ($picturesToEdit[$i] != "" AND $picturesToEdit[$i] != "cover") { //on enlève le dernier élément du tableau qui est toujours vide et le cas ou on veut éditer l'image de couverture quand c'est déjà l'image par défaut (aucune image pour l'instant ajoutée à cette figure)
                $pictureField = 'picture' . $picturesToEdit[$i];
                if (!empty($request->files->get($pictureField))) {
                    /** @var UploadedFile $uploadedFile */
                    $uploadedFile = $request->files->get($pictureField);
                    if ($uploadedFile->isValid() AND $uploadedFile->getSize() <= 2097152) {
                        if ($uploadedFile->guessExtension() == "jpg" OR $uploadedFile->guessExtension() == "jpeg" OR $uploadedFile->guessExtension() == "png" OR $uploadedFile->guessExtension() == "gif") {
                            $destination = $this->getParameter('kernel.project_dir') . '/public/images/uploads';
                            $newFilename = uniqid() . '.' . $uploadedFile->guessExtension();
                            $uploadedFile->move($destination, $newFilename);

                            $picture = $pictureRepo->find($picturesToEdit[$i]);

                            $fileName = $this->getParameter('kernel.project_dir') . '/public' . $picture->getPath();
                            $fileSystem->remove($fileName);

                            $picture->setPath('/images/uploads/' . $newFilename);
                            $this->em->flush();
                        } else {
                            return "wrongFormat";
                        }
                    } else {
                        return "tooHeavy";
                    }
                }
            } elseif ($picturesToEdit[$i] == "cover") {
                //on upload l'image
                $pictureField = 'picturecover';
                if (!empty($request->files->get($pictureField))) {
                    /** @var UploadedFile $uploadedFile */
                    $uploadedFile = $request->files->get($pictureField);
                    if ($uploadedFile->isValid() AND $uploadedFile->getSize() <= 2097152) {
                        if ($uploadedFile->guessExtension() == "jpg" OR $uploadedFile->guessExtension() == "jpeg" OR $uploadedFile->guessExtension() == "png" OR $uploadedFile->guessExtension() == "gif") {
                            $destination = $this->getParameter('kernel.project_dir') . '/public/images/uploads';
                            $newFilename = uniqid() . '.' . $uploadedFile->guessExtension();
                            $uploadedFile->move($destination, $newFilename);

                            $picture = new Picture();
                            $picture->setPath('/images/uploads/' . $newFilename);
                            $trick->addPicture($picture);
                            $this->em->persist($picture);

                        } else {
                            return "wrongFormat";
                        }
                    } else {
                        return "tooHeavy";
                    }
                }
            }
        }
    }

    public function videosEdit(int $nbreVideosToEdit, array $videosToEdit, Request $request, VideoRepository $videoRepo, Trick $trick)
    {
        //on boucle pour mettre à jour toutes les videos
        for ($i = 0; $i < $nbreVideosToEdit; $i++) {
            if ($videosToEdit[$i] != "") {
                $j = $i + 1;
                if (!empty($request->request->get('video' . $j))) {
                    $videoURL = $request->request->get('video' . $j);
                    $video = $videoRepo->find($videosToEdit[$i]);
                    $video->setUrl($videoURL);
                    $this->em->flush();
                } else {
                    //si le champ de l'url vidéo est vide on considère que l'on veut supprimer la vidéo
                    $video = $videoRepo->find($videosToEdit[$i]);
                    $this->em->remove($video);
                    $trick->removeVideo($video);
                }
            }
        }
    }
}