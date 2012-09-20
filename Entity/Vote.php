<?php

namespace maschit\CodingNightmares\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * maschit\CodingNightmares\WebsiteBundle\Entity\Vote
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Vote
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime $date
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer $value
     *
     * @ORM\Column(name="value", type="smallint")
     */
    private $value;

    /**
     * @var Post $post
     * 
     * @ORM\ManyToOne(targetEntity="Post")
     */
    private $post;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Vote
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set value
     *
     * @param integer $value
     * @return Vote
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set post
     *
     * @param maschit\CodingNightmares\WebsiteBundle\Entity\Post $post
     * @return Vote
     */
    public function setPost(\maschit\CodingNightmares\WebsiteBundle\Entity\Post $post = null)
    {
        $this->post = $post;
    
        return $this;
    }

    /**
     * Get post
     *
     * @return maschit\CodingNightmares\WebsiteBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }
}