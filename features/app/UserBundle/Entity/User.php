<?php

namespace SwitchUserStatelessBundle\Tests\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Groups({"default_output"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(length=255, unique=true)
     *
     * @Groups({"default_output"})
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column
     *
     * @Groups({"default_output"})
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(length=255, unique=true)
     *
     * @Groups({"default_output"})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(length=255)
     *
     * @Groups({"default_output"})
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(length=255)
     *
     * @Groups({"default_output"})
     */
    private $firstName;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
}
