<?php
namespace BR\BarBundle\Type\Bar;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id')
            ->add('name')
            ;
    }
    public function getName() {
        return 'bar';
    }
}
