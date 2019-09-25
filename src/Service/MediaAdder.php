<?php
namespace App\Service;

use App\Entity\Trick;
use Doctrine\Common\Collections\ArrayCollection;

class MediaAdder
{
    /**
     * @var FileUploader
     */
    private $fileUploader;

    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    public function addMedias(ArrayCollection $pictures, ArrayCollection $videos, Trick $trick)
    {
        foreach ($pictures as $picture) {
            if (null !== $picture->getFile()) {
                $fileName = $this->fileUploader->upload($picture->getFile());
                $picture->setPath('/images/uploads/'.$fileName);
            } else {
                $trick->removePicture($picture);
            }
        }
        foreach ($videos as $video) {
            if (null === $video->getUrl()) {
                $trick->removeVideo($video);
            }
        }
    }
}
