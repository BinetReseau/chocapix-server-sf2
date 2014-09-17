<?php
namespace BR\BarBundle\Type\Transaction;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id')
            ->add('timestamp')
            ->add('moneyflow')
            ->add('canceled')
            ->add('bar_id', 'bar_id', array('property_path' => 'bar'))
            // ->add('bar', 'bar', array('read_only' => true))
            ->add('user_id', 'user_id', array('property_path' => 'user'))
            // ->add('user', 'user', array('read_only' => true))
            ->add('_type', 'text', array('data' => 'Transaction\Transaction', 'mapped' => false))
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
             'data_class' => 'BR\BarBundle\Entity\Transaction\Transaction',
        ));
    }

    public function getName() {
        return 'transaction';
    }
}
