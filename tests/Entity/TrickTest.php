<?php


namespace App\Tests\Entity;


use App\Entity\Picture;
use App\Entity\Trick;
use PHPUnit\Framework\TestCase;

class TrickTest extends TestCase
{
    private $trick;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->trick = new Trick();
    }

    public function testNameIsString()
    {
        $this->trick->setName('Bonjour');
        $this->assertIsString($this->trick->getName());
    }

    public function testPictureAddRemove()
    {
        $picture = new Picture();
        $this->trick->addPicture($picture);
        $this->assertCount(1, $this->trick->getPictures());
        $this->trick->removePicture($picture);
        $this->assertCount(0, $this->trick->getPictures());
    }

    public function testPublishedAtIsValid()
    {
        $this->trick->setPublishedAt(New \DateTime());
        $this->assertInstanceOf(\DateTime::class, $this->trick->getPublishedAt());
    }
}