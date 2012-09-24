<?php

namespace maschit\CodingNightmares\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContext;
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
   *
   * this action is only called to show the from. The checks are done inside the 
   * symfony security layer
   * 
   * @Template()
   */
  public function loginAction()
  {
    $session = $this->request->getSession();
    $attributes = $this->request->attributes;
    if($attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
      $error = $attributes->get(SecurityContext::AUTHENTICATION_ERROR);
    } 
    else {
      $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
    }
    return array(
      'last_username' => $session->get(SecurityContext::LAST_USERNAME), 
      'error' => $error
    );

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
      //@TODO: check if users exists
      $data = $form->getData();
      $user = new User();
      $encoder = $this->encoderFactory->getEncoder($user);
      $password = $encoder->encodePassword($data['password'], $user->getSalt());
      $user->setPassword($password);
      $user->setMail($data['email']);
      $this->em->persist($user);
      $this->em->flush();
      // @TODO send user an verifycation email
      return new Response('welcome!');  //@TODO: create view
    }
    return array('reg_form' => $form->createView());

  }
}
