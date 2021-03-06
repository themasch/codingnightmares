<?php

namespace maschit\CodingNightmares\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use maschit\CodingNightmares\WebsiteBundle\Form\RegistrationForm;
use maschit\CodingNightmares\WebsiteBundle\Form\CreatePostForm;
use JMS\DiExtraBundle\Annotation as DI;

use maschit\CodingNightmares\WebsiteBundle\Entity\Post;
use maschit\CodingNightmares\WebsiteBundle\Entity\Tag;
use maschit\CodingNightmares\WebsiteBundle\Entity\Language;

class DefaultController extends Controller
{
  /**
   * @DI\Inject
   */
  private $router;

  /**
   * @DI\Inject
   */
  private $request;

  /**
   * @DI\Inject("doctrine.orm.entity_manager")
   */
  private $em;

  /**
   * @Route("/", name="index")
   * @Template()
   */
  public function indexAction()
  { 
    $posts = $this->em->getRepository('maschit\\CodingNightmares\\WebsiteBundle\\Entity\\Post')->findAll();
    return array(
      'posts' => $posts, 
      'reg_form' => $this->createForm(new RegistrationForm())->createView(),
      'includeForms' => 'true');
  }

  /**
   * @Route("/create", name="create")
   * @Template()
   * maschit\CodingNightmares\WebsiteBundle\Entity\
   */
  public function createAction()
  {
    $req  = $this->getRequest();
    $form = $this->createForm(new CreatePostForm());
    if($req->getMethod() === 'POST') {
      $form->bind($req);
      if(!$form->isValid())
        return array( 'form' => $form->createView() );
      
      $langRepo = $this->em->getRepository('maschit\\CodingNightmares\\WebsiteBundle\\Entity\\Language');
      $tagRepo = $this->em->getRepository('maschit\\CodingNightmares\\WebsiteBundle\\Entity\\Tag');
      
      $lang = $langRepo->getLang('php'); // @TODO: field for that language!

      $post = new Post();
      $data = $form->getData();
      $post->setTitle($data['title']);
      $post->setDateAdded(new \DateTime());
      $post->setLang($lang);
      $post->setContent($data['code']);

      $tags = explode(',', $data['tags']);
      foreach($tags as $tag) {
        $tag = trim($tag);
        if(strlen($tag) < 2) continue;
        $tagObj = $tagRepo->getTag($tag);
        $post->addTag($tagObj);
      }
      $this->em->persist($post);
      $this->em->flush($post);

      return new RedirectResponse($this->router->generate('index'));

    } else {
      return array( 'form' => $form->createView() );
    }
  }

  /**
   * @Route("/login_check", name="login_check")
   */
  public function loginCheckAction() {}

  /**
   * @Route("/logout", name="logout")
   */
  public function logoutAction() {}
}
