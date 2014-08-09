<?php
namespace BR\BarBundle\Type\Stock;

use BR\BarBundle\Type\IdTypeBase;
use Doctrine\Common\Persistence\ObjectManager;

class StockItemIdType extends IdTypeBase
{
    public function __construct(ObjectManager $om) {
        parent::__construct($om, 'BRBarBundle:Stock\StockItem', 'item');
    }
}
