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
        parent::beforeFilter();
    }
    /**
     * Login function to login to the proper school
     */
    function login(){
        $this->layout="home";
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
                $this->Session->delete('Administrator');
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
    function admin_logout(){
        $this->Session->delete('Administrator');
        $this->redirect(array('controller'=>'administrators','action'=>'login'));
    }
    
    function admin_index(){}
    function index(){}
    
    function admin_paginatedview(){
        if($this->RequestHandler->isAjax()){
            $this->layout='ajax';
        }
        //$this->layout='ajax';
        $this->paginate=array(
            'limit'=>SCHOOL_PAGINATION_LIMIT,
            'order'=>array(
                'School.created'=>'desc'
            )
        );
        $schoolData=$this->paginate();
        $this->set(compact('schoolData'));
    }
    function admin_add(){
        if(!empty($this->data)){
            $this->data['Block']['name']=trim($this->data['Block']['name']);
            $this->data['Cluster']['name']=trim($this->data['Cluster']['name']);
            $this->data['Village']['name']=trim($this->data['Village']['name']);
            if($this->data['Block']['name']==""){
                $this->School->invalidate('Block.name');
            }
            if($this->data['Cluster']['name']==""){
                $this->School->invalidate('Cluster.name');
            }
            if($this->data['Village']['name']==""){
                $this->School->invalidate('Village.name');
            }
            $this->data['School']['loginid']=$this->data['School']['disecode'];
            $block_id=$this->School->Block->find('first',array('conditions'=>array('name'=>$this->data['Block']['name']),'recursive'=>'-1'));
            if(empty($block_id)){
                $this->data['Block']['id']=NULL;
                $this->School->Block->save($this->data['Block']);
                $block_id=$this->School->Block->getLastInsertId();
            }else{
                $block_id=$block_id['Block']['id'];
            }
            $cluster_id=$this->School->Cluster->find('first',array('conditions'=>array('name'=>$this->data['Cluster']['name']),'recursive'=>'-1'));
            if(empty($cluster_id)){
                $this->data['Cluster']['block_id']=$block_id;
                $this->data['Cluster']['id']=NULL;
                $this->School->Cluster->save($this->data['Cluster']);
                $cluster_id=$this->School->Cluster->getLastInsertId();
            }else{
                $cluster_id=$cluster_id['Cluster']['id'];
            }
            $village_id=$this->School->Village->find('first',array('conditions'=>array('name'=>$this->data['Village']['name']),'recursive'=>'-1'));
            if(empty($village_id)){
                $this->data['Village']['cluster_id']=$cluster_id;
                $this->data['Village']['id']=NULL;
                $this->School->Village->save($this->data['Village']);
                $village_id=$this->School->Village->getLastInsertId();
            }else{
                $village_id=$village_id['Village']['id'];
            }
            $this->data['School']['passwd']=md5($this->data['School']['disecode']);
            $this->data['School']['block_id']=$block_id;
            $this->data['School']['cluster_id']=$cluster_id;
            $this->data['School']['village_id']=$village_id;
            if($this->School->save($this->data)){
               $this->sendJson('true');
            }
        }
    }
}

?>
