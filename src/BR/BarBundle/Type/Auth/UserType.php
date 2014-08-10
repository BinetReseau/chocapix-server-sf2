<?php
namespace BR\BarBundle\Type\Auth;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id')
            ->add('name')
            ;
    }
    public function getName() {
        return 'user';
    }
}
