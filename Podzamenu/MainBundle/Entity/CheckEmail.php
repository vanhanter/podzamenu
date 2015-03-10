<?php
namespace Podzamenu\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Podzamenu\MainBundle\Entity\CheckEmail
 *
 * @ORM\Table(name="check_email")
 * @ORM\Entity
 */
class CheckEmail
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
     * @ORM\Column(name="href", type="string", length=100)
     */
    private $href;

    /**
     * @ORM\Column(name="date_end", type="integer", length=11)
     */
    private $dateEnd;


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
     * Get idUser
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
     * Get getHref
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    public function setHref($href)
    {
        $this->href = $href;
    }

    /**
     * Get DateEnd
     *
     * @return integer
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }
}