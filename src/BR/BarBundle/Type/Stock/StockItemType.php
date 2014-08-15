<?php
namespace BR\BarBundle\Type\Stock;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StockItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id')
            ->add('name')
            ->add('qty')
            ->add('unit')
            ->add('price')
            ->add('tax')
            ->add('keywords')
            ->add('deleted')
            ->add('barId', 'bar_id', array('property_path' => 'bar'))
            ->add('bar', 'bar', array('read_only' => true))
            ->add('_type', 'text', array('data' => 'Stock\StockItem', 'mapped' => false))
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
             'data_class' => 'BR\BarBundle\Entity\Stock\StockItem',
        ));
    }

    public function getName() {
        return 'item';
    }
}
