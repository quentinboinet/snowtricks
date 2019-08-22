<?php


namespace App\Tests\Entity;


use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\User;
use App\Entity\Video;
use PHPUnit\Framework\TestCase;

class TrickTest extends TestCase
{
    private $trick;

    public function setUp()
    {

        $this->trick = new Trick();
    }

    public function testNameIsString()
    {
        $this->trick->setName('Bonjour');
        $this->assertIsString($this->trick->getName());
    }

    public function testSlugIsString()
    {
        $this->trick->setSlug('trick-name');
        $this->assertIsString($this->trick->getSlug());
    }

    public function testDescriptionIsString()
    {
        $this->trick->setDescription('Description de la figure');
        $this->assertIsString($this->trick->getDescription());
    }

    public function testPictureAddRemove()
    {
        $picture = new Picture();
        $this->trick->addPicture($picture);
        $this->assertCount(1, $this->trick->getPictures());
        $this->trick->removePicture($picture);
        $this->assertCount(0, $this->trick->getPictures());
    }

    public function testVideoAddRemove()
    {
        $video = new Video();
        $this->trick->addVideo($video);
        $this->assertCount(1, $this->trick->getVideos());
        $this->trick->removeVideo($video);
        $this->assertCount(0, $this->trick->getVideos());
    }

    public function testCommentAddRemove()
    {
        $comment = new Comment();
        $this->trick->addComment($comment);
        $this->assertCount(1, $this->trick->getComments());
        $this->trick->removeComment($comment);
        $this->assertCount(0, $this->trick->getComments());
    }

    public function testCategory()
    {
        $category = new Category();
        $this->trick->setCategory($category);
        $this->assertEquals(new Category(), $this->trick->getCategory());
        $this->assertInstanceOf(Category::class, $this->trick->getCategory());
    }

    public function testPublishedAtIsValid()
    {
        $this->trick->setPublishedAt(New \DateTime());
        $this->assertInstanceOf(\DateTime::class, $this->trick->getPublishedAt());
    }

    public function testUpdatedAtIsValid()
    {
        $this->trick->setUpdatedAt(New \DateTime());
        $this->assertInstanceOf(\DateTime::class, $this->trick->getUpdatedAt());
    }

    public function testIdIsNull()
    {
        $this->assertNull($this->trick->getId());
    }

    public function testAuthorName()
    {
        $user = new User();
        $user->setUsername('Quentin');
        $this->trick->setAuthorName($user);
        $this->assertEquals('Quentin', $this->trick->getAuthorName()->getUsername());
    }
}