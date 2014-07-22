<?php
namespace BR\BarBundle\Entity\Transaction;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

use BR\BarBundle\Entity\Operation\AccountOperation;
use BR\BarBundle\Entity\Operation\StockOperation;

/**
 * @ORM\Entity
 * @ORM\Table(name="tr_Buy")
 */
class BuyTransaction extends Transaction
{
    public function checkIntegrity() {
    	$money_items = 0;
    	$money_accounts = 0;

    	foreach ($this->operations as $op) {
    		if($op instanceof AccountOperation && $op->getMoneyFlow() < 0)
				$money_accounts += -$op->getMoneyFlow();
    		elseif ($op instanceof StockOperation && $op->getMoneyFlow() < 0)
    			$money_items += -$op->getMoneyFlow();
    		else
    			return false;
    	}

    	if($money_items == $money_accounts) {
	    	$this->moneyflow = $money_items;
	    	return true;
    	}
    	else
    		return false;
    }
}
