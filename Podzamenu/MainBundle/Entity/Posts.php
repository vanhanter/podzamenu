<?php
namespace Podzamenu\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Podzamenu\MainBundle\Entity\Posts
 *
 * @ORM\Table(name="posts")
 * @ORM\Entity
 */
class Posts
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="id_user", type="integer", length=11)
     */
    private $idUser;

    /**
     * @ORM\Column(name="label", type="string", length=100)
     */
    private $label;

    /**
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @ORM\Column(name="date", type="integer", length=11)
     */
    private $date;


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
     * Get id
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Get id
     *
     * @return text
     */
    public function getMessage()
    {
        return $this->label;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

}