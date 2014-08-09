<?php
namespace BR\BarBundle\Type\Stock;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class StockItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('id', 'integer', array('read_only' => 'true'))
        	->add('bar', 'bar_id')
        	->add('name', 'text')
        	->add('qty', 'number')
        	// ->add('unit')
        	->add('price', 'number')
        	// ->add('tax')
        	// ->add('keywords')
        	;
    }
    public function getName() {
        return 'item';
    }
}
