<?php
namespace BR\BarBundle\Controller;

use Adrotec\BreezeJsBundle\Controller\BreezeJsController;

class ApiController extends BreezeJsController {
    // limit the api to certain classes.
    // if you want to include all classes from all the enabled bundles, return null from this method
    public function getClientClasses(){
        return null;
    }

    public function apiAction($route){
        return parent::apiAction($route);
    }
}
