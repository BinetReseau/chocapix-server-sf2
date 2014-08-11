<?php
namespace BR\BarBundle\Type\Account;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id')
            ->add('money')
            ->add('bar')
            ->add('userId', 'user_id', array('property_path' => 'user'))
            ;
    }
    public function getName() {
        return 'account';
    }
}
