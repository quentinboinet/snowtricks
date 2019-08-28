<?php

namespace App\Service;

use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\EntityManagerInterface;

class MediaUploader extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function picturesUpload(string $type, int $nbImages, Request $request, Trick $trick, $category)
    {
        for ($i = 1; $i <= $nbImages; $i++) {

            if ($type == "add") { $pictureField = 'picture' . $i; } else { $pictureField = 'pictureAdd' . $i; }

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
                        $this->em->persist($picture);

                        $trick->addPicture($picture);
                    } else {
                        return "Seules les images au format .jpg, .jpeg, .png et .gif sont autorisées.";
                    }
                } else {
                    return "Image trop lourde ! (max. 2Mo autorisé)";
                }
            }
        }
    }

    public function videosUpload(string $type, int $nbVideos, Request $request, Trick $trick): void
    {
        if ($type == 'add') { $field = 'video'; } else { $field = 'videoAdd'; }
        for ($i = 1; $i <= $nbVideos; $i++) {
            if (!empty($request->request->get($field . $i))) {
                $videoURL = $request->request->get($field . $i);
                $video = new Video();
                $video->setUrl($videoURL);
                $this->em->persist($video);

                $trick->addVideo($video);
            }
        }
    }
}