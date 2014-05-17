<?php

namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BRBarBundle:Default:index.html.twig', array('name' => $name));
    }
}
