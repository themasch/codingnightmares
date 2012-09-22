<?php

namespace maschit\CodingNightmares\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * maschit\CodingNightmares\WebsiteBundle\Entity\User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User implements UserInterface
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
     * @var string $mail
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string $password hashed password
     *
     * @ORM\Column(name="password", type="string", length="100")
     */
    private $password;


    /**
     * @var \DateTime $joined
     *
     * @ORM\Column(name="joined", type="datetime")
     */
    private $joined;


    /**
     * @var boolean $is_moderator
     *
     * @ORM\Column(name="is_moderator", type="boolean")
     */
    private $is_moderator;

    /**
     * @var string $verify_secret
     *
     * @ORM\Column(name="verify_secret", type="string", length=100)
     */
    private $verify_secret;

    /**
     * @var boolean $verified
     *
     * @ORM\Column(name="verified", type="boolean")
     */
    private $verified;

    /**
     * @var string $salt
     * 
     * @ORM\Column(name="salt", type="string")
     */
    private $salt;


    public function __construct()
    {
        $this->salt = '$2y$07$'.substr(md5(uniqid(null, true)), 0, 20).'$';
        $this->verify_secret = sha1(uniqid(null, true).microtime(true));
        $this->verified = false;
        $this->is_moderator = false;
        $this->setJoined(new \DateTime());
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

    /**
     * Set mail
     *
     * @param string $mail
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    
        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set joined
     *
     * @param \DateTime $joined
     * @return User
     */
    public function setJoined($joined)
    {
        $this->joined = $joined;
    
        return $this;
    }

    /**
     * Get joined
     *
     * @return \DateTime 
     */
    public function getJoined()
    {
        return $this->joined;
    }

    /**
     * Set is_moderator
     *
     * @param boolean $isModerator
     * @return User
     */
    public function setIsModerator($isModerator)
    {
        $this->is_moderator = $isModerator;
    
        return $this;
    }

    /**
     * Get is_moderator
     *
     * @return boolean 
     */
    public function getIsModerator()
    {
        return $this->is_moderator;
    }

    /**
     * Set verify_secret
     *
     * @param string $verifySecret
     * @return User
     */
    public function setVerifySecret($verifySecret)
    {
        $this->verify_secret = $verifySecret;
    
        return $this;
    }

    /**
     * Get verify_secret
     *
     * @return string 
     */
    public function getVerifySecret()
    {
        return $this->verify_secret;
    }

    /**
     * Set verified
     *
     * @param boolean $verified
     * @return User
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;
    
        return $this;
    }

    /**
     * Get verified
     *
     * @return boolean 
     */
    public function getVerified()
    {
        return $this->verified;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->getMail();
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return $this->getIsModerator() ? array('ROLE_ADMIN') : array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    public function isEqualTo(UserInterface $user)
    {
        return $user->getUsername() === $this->mail;
    }
}