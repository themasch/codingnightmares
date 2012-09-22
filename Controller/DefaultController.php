<?php

namespace maschit\CodingNightmares\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

        
class DefaultController extends Controller
{
  /**
   * @Route("/")
   * @Template()
   */
  public function indexAction()
  {    
    $g = new \GeSHi(file_get_contents(__FILE__), 'php');
    $g->enable_classes();
    $g->set_header_type(GESHI_HEADER_PRE_TABLE);
    $g->set_overall_class('code');
    $g->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
    return array('code' => $g->parse_code(), 'css' => $g->get_stylesheet());
  }
}
