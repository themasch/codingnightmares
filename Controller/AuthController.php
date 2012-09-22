<?php

namespace maschit\CodingNightmares\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use maschit\CodingNightmares\WebsiteBundle\Form\RegistrationForm;
use maschit\CodingNightmares\WebsiteBundle\Entity\User;
        
class AuthController extends Controller
{

  /**
   * @DI\Inject
   */
  private $request;

  /**
   * @DI\Inject("security.encoder_factory")
   */
  private $encoderFactory;

  /**
   * @DI\Inject("doctrine.orm.entity_manager")
   */
  private $em;

  /**
   * @Route("/login", name="login")
   * @Template()
   */
  public function loginAction()
  {
    // TODO
    return array();

  }

  /**
   * @Route("/register", name="register")
   * @Template()
   */
  public function registerAction()
  {    
    $form = $this->createForm(new RegistrationForm());
    if($this->request->getMethod() === 'POST') {
      $form->bind($this->request);
      if(!$form->isValid())
        return array('reg_form' => $form->createView());
      $data = $form->getData();
      $user = new User();
      $encoder = $this->encoderFactory->getEncoder($user);
      $password = $encoder->encodePassword($data['password'], $user->getSalt());
      $user->setPassword($password);
      $user->setMail($data['email']);
      $this->em->persist($user);
      $this->em->flush();
      return new Response('welcome!'); 
    }
    return array('reg_form' => $form->createView());
    //$user->setMail($data['email'])->setPassword();

  }
}
