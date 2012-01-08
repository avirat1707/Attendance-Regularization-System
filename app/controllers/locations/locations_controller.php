<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of location_controller
 *
 * @author tirthbodawala
 */
class locationsController extends AppController{
    var $name='Locations';
    function index(){
        $all_locations=$this->Location->find('all',array('order'=>array('location')));
        $this->set(compact('all_locations'));
    }
}

?>
