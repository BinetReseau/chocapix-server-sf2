<?php
namespace BR\BarBundle\Type\Stock;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

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
            ;
    }
    public function getName() {
        return 'item';
    }
}
