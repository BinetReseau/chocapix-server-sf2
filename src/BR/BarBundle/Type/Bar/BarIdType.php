<?php
namespace BR\BarBundle\Type\Bar;

use BR\BarBundle\Type\IdTypeBase;
use Doctrine\Common\Persistence\ObjectManager;

class BarIdType extends IdTypeBase
{
    public function __construct(ObjectManager $om, repoName, $name) {
        parent::__construct($om, 'BRBarBundle:Bar\Bar', 'bar');
    }
}
