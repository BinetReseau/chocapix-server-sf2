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
            ->add('user', 'user_id')
            ;
    }
    public function getName() {
        return 'account';
    }
}
