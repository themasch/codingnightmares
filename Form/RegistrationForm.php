<?php

namespace maschit\CodingNightmares\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\MinLength;
use Symfony\Component\Validator\Constraints\Collection;

class RegistrationForm extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('email', 'email', array('label' => 'E-Mail', 'attr' => array('placeholder'=>'E-Mail')));
    $builder->add('password', 'repeated', array (
        'type'            => 'password',
        'first_name'      => "password",
        'second_options'   => array('label' => 'confirm Password'),
        'second_name'     => "password_confirm",
        'invalid_message' => "The passwords don't match!"
    ));
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $collectionConstraint = new Collection(array(
        'password' => new MinLength(8),
        'email' => new Email(array('message' => 'Invalid email address')),
    ));

    $resolver->setDefaults(array(
        'validation_constraint' => $collectionConstraint
    ));
  }

  public function getName()
  {
    return 'registration';
  }
}