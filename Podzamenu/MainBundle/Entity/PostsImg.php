<?php
namespace Podzamenu\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Podzamenu\MainBundle\Entity\PostsImg
 *
 * @ORM\Table(name="posts_img")
 * @ORM\Entity
 */
class PostsImg
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="id_post", type="integer", length=11)
     */
    private $idPost;

    /**
     * @ORM\Column(name="norm_img", type="string", length=50)
     */
    private $normImg;

    /**
     * @ORM\Column(name="mini_img", type="string", length=50)
     */
    private $miniImg;


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
    public function getIdPost()
    {
        return $this->idPost;
    }

    public function setIdPost($idPost)
    {
        $this->idPost = $idPost;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getNormImg()
    {
        return $this->normImg;
    }

    public function setNormImg($normImg)
    {
        $this->normImg = $normImg;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getMiniImg()
    {
        return $this->miniImg;
    }

    public function setMiniImg($miniImg)
    {
        $this->miniImg = $miniImg;
    }
}