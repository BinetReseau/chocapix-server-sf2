<?php
namespace BR\BarBundle\Type\Bar;

use Doctrine\Common\Persistence\ObjectManager;
use BR\BarBundle\Type\IdTypeBase;

class BarIdType extends IdTypeBase
{
    public function __construct(ObjectManager $om) {
        parent::__construct($om, 'BRBarBundle:Bar\Bar', 'bar');
    }

    public function getName() {
        return 'bar_id';
    }

    public function getParent() {
        return 'text';
    }
}
