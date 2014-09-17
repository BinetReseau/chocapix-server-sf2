<?php
namespace BR\BarBundle\Type\Transaction;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BuyTransactionType extends AbstractType
{
    private $om;

    public function __construct(ObjectManager $om) {
        $this->om = $om;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->addViewTransformer(new BuyTransactionTransformer($this->om))
            ->add('bar_id', 'bar_id', array('property_path' => '[bar]'))
            // ->add('bar', 'bar', array('read_only' => true))
            ->add('author_id', 'user_id', array('property_path' => '[author]'))
            // ->add('author', 'user', array('read_only' => true))
            ->add('id')
            ->add('timestamp', 'datetime')
            ->add('moneyflow')
            ->add('canceled', 'checkbox')
            ->add('item_id', 'item_id', array('property_path' => '[item]'))
            ->add('qty')
            ->add('_type', 'text', array('data' => 'Transaction\BuyTransaction', 'mapped' => false))
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
             'data_class' => null,
        ));
    }

    public function getName() {
        return 'buy_transaction';
    }
}
