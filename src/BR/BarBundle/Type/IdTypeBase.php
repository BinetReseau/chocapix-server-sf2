<?php
namespace BR\BarBundle\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Common\Persistence\ObjectManager;

class IdTypeBase extends AbstractType
{
    /**
     * @var ObjectManager
     */
    private $om;

    private $entityClassName;

    private $name;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om, $entityClassName, $name) {
        $this->om = $om;
        $this->entityClassName = $entityClassName;
        $this->name = $name;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->addModelTransformer(new EntityIdTransformer($this->om, $this->entityClassName, $this->name));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'invalid_message' => 'The selected ' + $this->name + ' does not exist'
            ));
    }

    public function getParent() {
        return 'number';
    }

    public function getName() {
        return $this->name + '_id';
    }
}
