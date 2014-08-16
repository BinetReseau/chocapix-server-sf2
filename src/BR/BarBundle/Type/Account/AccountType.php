<?php
namespace BR\BarBundle\Type\Account;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id')
            ->add('money')
            ->add('bar')
            ->add('user_id', 'user_id', array('property_path' => 'user'))
            // ->add('user', 'user', array('read_only' => true))
            ->add('_type', 'text', array('data' => 'Account\Account', 'mapped' => false))
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
             'data_class' => 'BR\BarBundle\Entity\Account\Account',
        ));
    }

    public function getName() {
        return 'account';
    }
}
