<?php
/**
 *PHP version 5.6
 *
 *My_Blog v1.00
 *
 *@author Mohamed Yousef <engineer.mohamed.yossef@gmail.com>
 *@copyright (C) My_Blog 2018
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Posts
 * 
 * @ORM\Table(name="posts")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostsRepository")
 */
class Posts
{
    /**
     * @var integer
     *
     * @ORM\Column(name="p_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pId;

    /**
     * @var string
     *
     * @ORM\Column(name="p_title", type="string", length=150, nullable=false)
     */
    private $pTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="p_content", type="text", length=65535, nullable=false)
     */
    private $pContent;

    /**
     * @var datetime
     *
     * @ORM\Column(name="p_date", type="datetime")
     */
    private $pDate;    

    /**
     * @var string
     *
     * @ORM\Column(name="p_cat", type="string", length=150, nullable=false)
     */
    private $pCat;

    /**
     * Get pId
     *
     * @return integer
     */
    public function getPId()
    {
        return $this->pId;
    }

    /**
     * Set pTitle
     *
     * @param string $pTitle
     *
     * @return Posts
     */
    public function setPTitle($pTitle)
    {
        $this->pTitle = $pTitle;

        return $this;
    }

    /**
     * Get pTitle
     *
     * @return string
     */
    public function getPTitle()
    {
        return $this->pTitle;
    }

    /**
     * Set pContent
     *
     * @param string $pContent
     *
     * @return Posts
     */
    public function setPContent($pContent)
    {
        $this->pContent = $pContent;

        return $this;
    }

    /**
     * Get pContent
     *
     * @return string
     */
    public function getPContent()
    {
        return $this->pContent;
    }

    /**
     * Set pDate
     *
     * @param \DateTime $pDate
     *
     * @return Posts
     */
    public function setPDate($pDate)
    {
        $this->pDate = $pDate;

        return $this;
    }

    /**
     * Get pDate
     *
     * @return \DateTime
     */
    public function getPDate()
    {
        return $this->pDate;
    }

    

    /**
     * Set pCat
     *
     * @param string $pCat
     *
     * @return Posts
     */
    public function setPCat($pCat)
    {
        $this->pCat = $pCat;

        return $this;
    }

    /**
     * Get pCat
     *
     * @return string
     */
    public function getPCat()
    {
        return $this->pCat;
    }
}
