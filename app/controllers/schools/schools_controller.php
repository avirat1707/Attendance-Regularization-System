<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of schools_controller
 *
 * @author tirthbodawala
 */
class SchoolsController extends AppController {
    var $name='Schools';
    var $uses=array('School','Teacher');
    
    
    function beforeFilter(){
//        if(strtolower($this->action)!="login"){
//            if(!$this->Session->check('School.id')){
//                $this->redirect(array("controller"=>'schools','action'=>'login'));
//            }
//        }
    }
    /**
     * Login function to login to the proper school
     */
    function login(){
        if($this->Session->check('School.id')){
            $this->redirect(array('action'=>'index'));
        }
        if(!empty($this->data)){
            $schoolData=$this->School->find(
                'first',
                array(
                    'conditions'=>array(
                        'loginid'=>$this->data['School']['loginid'],
                        'passwd'=>md5($this->data['School']['passwd'])
                    )
                )
            );
            if(empty($schoolData)){
                $this->set('loginError','Invalid Login-ID/Password.');
            }else{
                $this->Session->write('School',$schoolData['School']);
                $this->redirect(array('action'=>'index'));
            }
        }
    }
    /**
     * Logout function to destroy the current session of the school and thus
     * redirect the user back to the login page!
     */
    function logout(){
        $this->Session->delete('School');
        $this->redirect(array('action'=>'login'));
    }
    
    function admin_index() {
       
       
    }

    
    function index(){
    }
}

?>
