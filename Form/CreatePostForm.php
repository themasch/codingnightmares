<?php

namespace maschit\CodingNightmares\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\MinLength;
use Symfony\Component\Validator\Constraints\Collection;

class CreatePostForm extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('title', 'text');
    $builder->add('code', 'textarea', array('attr' => array('rows' => 10)));
    $builder->add('tags', 'text');
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    
  }

  public function getName()
  {
    return 'create_post';
  }
}