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
 * Comments
 *
 * @ORM\Table(name="comments")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentsRepository")
 */
class Comments
{
    /**
     * @var integer
     *
     * @ORM\Column(name="c_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cId;

    /**
     * @var string
     *
     * @ORM\Column(name="c_visitor_email", type="text", length=250, nullable=false)
     */
    private $cVisitorEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="c_content", type="text", length=65535, nullable=false)
     */
    private $cContent;

    /**
     * @var integer
     *
     * @ORM\Column(name="c_post_id", type="integer")
     */
    private $cPostId;

    /**
     * @var datetime
     *
     * @ORM\Column(name="c_date", type="datetime")
     */
    private $cDate;

    /**
     * Get cId
     *
     * @return integer
     */
    public function getCId()
    {
        return $this->cId;
    }

    /**
     * Set cVisitorEmail
     *
     * @param string $cVisitorEmail
     *
     * @return Comments
     */
    public function setCVisitorEmail($cVisitorEmail)
    {
        $this->cVisitorEmail = $cVisitorEmail;

        return $this;
    }

    /**
     * Get cVisitorEmail
     *
     * @return string
     */
    public function getCVisitorEmail()
    {
        return $this->cVisitorEmail;
    }

    /**
     * Set cContent
     *
     * @param string $cContent
     *
     * @return Comments
     */
    public function setCContent($cContent)
    {
        $this->cContent = $cContent;

        return $this;
    }

    /**
     * Get cContent
     *
     * @return string
     */
    public function getCContent()
    {
        return $this->cContent;
    }

    /**
     * Set cPostId
     *
     * @param integer $cPostId
     *
     * @return Comments
     */
    public function setCPostId($cPostId)
    {
        $this->cPostId = $cPostId;

        return $this;
    }

    /**
     * Get cPostId
     *
     * @return integer
     */
    public function getCPostId()
    {
        return $this->cPostId;
    }

    /**
     * Set cDate
     *
     * @param \DateTime $cDate
     *
     * @return Comments
     */
    public function setCDate($cDate)
    {
        $this->cDate = $cDate;

        return $this;
    }

    /**
     * Get cDate
     *
     * @return \DateTime
     */
    public function getCDate()
    {
        return $this->cDate;
    }
}
