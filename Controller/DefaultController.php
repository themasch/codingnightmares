<?php

namespace maschit\CodingNightmares\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use maschit\CodingNightmares\WebsiteBundle\Form\RegistrationForm;

use maschit\CodingNightmares\WebsiteBundle\Entity\Post;
use maschit\CodingNightmares\WebsiteBundle\Entity\Language;

class DefaultController extends Controller
{
  /**
   * @Route("/", name="index")
   * @Template()
   */
  public function indexAction()
  {    

    // @TODO: posts from database
    $g = new \GeSHi(file_get_contents(__FILE__), 'php');
    $g->enable_classes();
    $g->set_header_type(GESHI_HEADER_PRE_TABLE);
    $g->set_overall_class('code');
    $g->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
    // @TODO: geshi as a twig extension (filter)
    // post.content|geshi(code.lang.name)
    $lang = new Language();
    $lang->setName('php');
    $post = new Post();
    $post->setTitle("bad symfony2 controller");
    $post->setLang($lang);
    $post->setDateAdded(new \DateTime());
    $post->setContent(file_get_contents(__FILE__));
    return array(
      'posts' => [$post, $post], 
      'code' => $g->parse_code(), 
      'reg_form' => $this->createForm(new RegistrationForm())->createView(),
      'includeForms' => 'true');
  }
}
