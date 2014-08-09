<?php
namespace BR\BarBundle\Type\Stock;

use Doctrine\Common\Persistence\ObjectManager;
use BR\BarBundle\Type\IdTypeBase;

class StockItemIdType extends IdTypeBase
{
    public function __construct(ObjectManager $om) {
        parent::__construct($om, 'BR\BarBundle\Entity\Stock\StockItem', 'item');
    }

    public function getName() {
        return 'item_id';
    }

}
