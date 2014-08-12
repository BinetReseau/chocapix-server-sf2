<?php
namespace BR\BarBundle\Type\Auth;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id')
            ->add('name')
            ->add('_type', 'text', array('data' => 'BR\BarBundle\Entity\Auth\User', 'mapped' => false))
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
             'data_class' => 'BR\BarBundle\Entity\Auth\User',
        ));
    }

    public function getName() {
        return 'user';
    }
}
