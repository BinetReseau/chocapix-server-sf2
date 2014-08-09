<?php
namespace BR\BarBundle\Type\Auth;

use BR\BarBundle\Type\IdTypeBase;
use Doctrine\Common\Persistence\ObjectManager;

class UserIdType extends IdTypeBase
{
    public function __construct(ObjectManager $om) {
        parent::__construct($om, 'BRBarBundle:Auth\User', 'user');
    }
}
