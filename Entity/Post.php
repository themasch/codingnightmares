<?php

namespace maschit\CodingNightmares\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * maschit\CodingNightmares\WebsiteBundle\Entity\Post
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Post
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
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=80)
     */
    private $title;

    /**
     * @var string $content
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime $date_added
     *
     * @ORM\Column(name="date_added", type="datetime")
     */
    private $date_added;

    /**
     * @var User $author
     * 
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $author;

    /**
     * @var Language $lang
     * 
     * @ORM\ManyToOne(targetEntity="Language")
     */
    private $lang;

    /**
     * @var User $moderator
     * 
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $moderator;


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
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date_added
     *
     * @param \DateTime $dateAdded
     * @return Post
     */
    public function setDateAdded($dateAdded)
    {
        $this->date_added = $dateAdded;
    
        return $this;
    }

    /**
     * Get date_added
     *
     * @return \DateTime 
     */
    public function getDateAdded()
    {
        return $this->date_added;
    }

    /**
     * Set author
     *
     * @param maschit\CodingNightmares\WebsiteBundle\Entity\User $author
     * @return Post
     */
    public function setAuthor(\maschit\CodingNightmares\WebsiteBundle\Entity\User $author = null)
    {
        $this->author = $author;
    
        return $this;
    }

    /**
     * Get author
     *
     * @return maschit\CodingNightmares\WebsiteBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set lang
     *
     * @param maschit\CodingNightmares\WebsiteBundle\Entity\Language $lang
     * @return Post
     */
    public function setLang(\maschit\CodingNightmares\WebsiteBundle\Entity\Language $lang = null)
    {
        $this->lang = $lang;
    
        return $this;
    }

    /**
     * Get lang
     *
     * @return maschit\CodingNightmares\WebsiteBundle\Entity\Language 
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set moderator
     *
     * @param maschit\CodingNightmares\WebsiteBundle\Entity\User $moderator
     * @return Post
     */
    public function setModerator(\maschit\CodingNightmares\WebsiteBundle\Entity\User $moderator = null)
    {
        $this->moderator = $moderator;
    
        return $this;
    }

    /**
     * Get moderator
     *
     * @return maschit\CodingNightmares\WebsiteBundle\Entity\User 
     */
    public function getModerator()
    {
        return $this->moderator;
    }
}