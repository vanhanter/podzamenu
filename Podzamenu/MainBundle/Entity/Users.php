<?php
namespace Podzamenu\MainBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Podzamenu\MainBundle\Entity\Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(name="status", type="integer", length=11)
     */
    private $status;
    
    /**
     * @ORM\Column(name="username", type="string", length=50, unique=true)
     */
    private $username;
    
    /**
     * @ORM\Column(name="password", type="string", length=100)
     */
    private $password;
    
    /**
     * @ORM\Column(name="salt", type="string", length=100)
     */
    private $salt;

    /**
     * @ORM\Column(name="public", type="integer", length=11)
     */
    private $public;

    /**
     * @ORM\Column(name="count_login", type="integer", length=11)
     */
    private $countLogin;

    
    public function __construct()
    {
        $this->isActive = true;
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function equals(UserInterface $user)
    {
        return $user->getUsername() === $this->username;
    }

    public function eraseCredentials()
    {
    }

    public function getUsername()
    {
        return $this->username;
    }
    
    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    public function getSalt()
    {
        return $this->salt;
    }
    
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set status
     *
     * @param integer $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set public
     *
     * @param integer $public
     */
    public function setPublic($public)
    {
        $this->public = $public;
    }

    /**
     * Get public
     *
     * @return integer
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set count_login
     *
     * @param integer $public
     */
    public function setCountlogin($countLogin)
    {
        $this->countLogin = $countLogin;
    }

    /**
     * Get count_login
     *
     * @return integer
     */
    public function getCountLogin()
    {
        return $this->countLogin;
    }
}