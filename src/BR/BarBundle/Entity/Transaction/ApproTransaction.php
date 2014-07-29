<?php
namespace BR\BarBundle\Entity\Transaction;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

use BR\BarBundle\Entity\Operation\StockOperation;

/**
 * @ORM\Entity
 * @ORM\Table(name="tr_Appro")
 */
class ApproTransaction extends Transaction
{
    public function checkIntegrity() {
    	$money = 0;

    	foreach ($this->operations as $op) {
    		if($op instanceof StockOperation && $op->getMoneyFlow() >= 0)
    			$money += $op->getMoneyFlow();
    		else
    			return false;
    	}

    	$this->moneyflow = $money;
    	return true;
    }
}
