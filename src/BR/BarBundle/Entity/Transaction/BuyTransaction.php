<?php
namespace BR\BarBundle\Entity\Transaction;

use Doctrine\ORM\Mapping as ORM;
use BR\BarBundle\Command\Types\Annotations\GenerateType;

use BR\BarBundle\Entity\Operation\AccountOperation;
use BR\BarBundle\Entity\Operation\StockOperation;

/**
 * @ORM\Entity
 * @ORM\Table(name="tr_Buy")
 * @GenerateType("buy_transaction")
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

    public function getItem() {
        foreach ($this->operations as $op) {
            if ($op instanceof StockOperation)
                return $op->getItem();
        }
    }
    public function getQty() {
        foreach ($this->operations as $op) {
            if ($op instanceof StockOperation)
                return $op->getDeltaqty();
        }
    }
}
