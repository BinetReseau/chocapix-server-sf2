<?php
namespace BR\BarBundle\Type\Bar;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id')
            ->add('name')
            ->add('_type', 'text', array('data' => 'Bar\Bar', 'mapped' => false))
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
             'data_class' => 'BR\BarBundle\Entity\Bar\Bar',
        ));
    }

    public function getName() {
        return 'bar';
    }
}
