<?php
namespace maschit\CodingNightmares\WebsiteBundle\Entity;
 
use Doctrine\ORM\EntityRepository;
use maschit\CodingNightmares\WebsiteBundle\Entity\Tag;
 
class TagRepository extends EntityRepository
{
  public function getTag($name) {
    $name = strtolower($name);
    // 1. check if exists
    $result = $this->findOneByName($name);
    // 2. if yes, get & return
    if($result !== null)
      return $result;
    // 3. if not, create
    $tag = new Tag();
    $tag->setName($name);
    //    ... persist
    $this->_em->persist($tag);
    $this->_em->flush($tag);
    //    and return
    return $tag;
  }
}
