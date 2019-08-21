<?php


namespace App\Tests\Entity;


use App\Entity\RegistrationToken;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\Date;

class RegistrationTokenTest extends TestCase
{
    private $registrationToken;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->registrationToken = new RegistrationToken(New User());
    }

    public function testExpiresAtisValid()
    {
        $this->assertInstanceOf(\DateTime::class, $this->registrationToken->getExpiresAt());
        $this->assertGreaterThan(New \DateTime(), $this->registrationToken->getExpiresAt());
        $this->assertLessThan(New \DateTime("+24 hour"), $this->registrationToken->getExpiresAt());
    }

    public function testTokenLengthIsValid()
    {
        $this->assertIsString($this->registrationToken->getToken());

        $tokenLength = strlen($this->registrationToken->getToken());
        $this->assertEquals(120, $tokenLength);
    }

}