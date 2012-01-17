<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {
    var $helpers=array('Html','Paginator','Text','Session','Form');
    var $components = array('RequestHandler','Session');
    
    public function beforeFilter(){
        $this->checkUser();
        parent::beforeFilter();
    }
    private function checkUser(){
        $isAdmin=False;
        $isSchool=False;
        if($this->Session->check('School')){    
            $isSchool=true;
        }else if($this->Session->check('Administrator')){
            $isAdmin=true;
        }
        $controller=$this->params['controller'];
        $action=$this->params['action'];
        if(isset($this->params['prefix']) && strtolower($this->params['prefix'])=='admin'){
            if(!$isAdmin){
                if($controller!='administrators' || $action!='admin_login'){
                    $this->redirect(array('prefix'=>'admin','controller'=>'administrators','action'=>'admin_login'));
                }
            }else{
                if($controller=='administrators' && $action=='admin_login'){
                    $this->redirect(array('prefix'=>'admin','controller'=>'schools','action'=>'admin_index'));
                }
            }
        }else{
            if(!$isSchool){
                if($controller!='schools' || $action!='login'){
                    $this->redirect(array('controller'=>'schools','action'=>'login'));
                }
            }
        }
    }
    public function sendJson($msg){
        header('Content-type: application/json');
        if(!is_array($msg)){
            $msg['msg']=$msg;
        }
        echo json_encode($msg);
        die;
    }
}