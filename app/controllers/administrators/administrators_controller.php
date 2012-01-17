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


class AdministratorsController extends AppController {
    var $name='Administrators';    
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 function admin_login(){        
        if(!empty($this->data)){             
            $adminData=$this->Administrator->find(
                'first',
                array(
                    'conditions'=>array(
                        'username'=>$this->data['Administrator']['username'],
                        'passwd'=>md5($this->data['Administrator']['passwd'])
                    )
                )
            );
            if(empty($adminData)){
                $this->set('loginError','Invalid Login-ID/Password.');
            }else{
                $this->Session->delete('School');
                $this->Session->write('Administrator',$adminData['Administrator']);
                $this->redirect(array('controller'=>'schools','action'=>'index'));
            }
        }
    }
}
?>
