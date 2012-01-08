<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of students_controller
 *
 * @author tirthbodawala
 */
class StudentsController extends AppController{
    var $name="Students";
    
    function index(){
        pr($this->Student->find('all'));
        die;
    }
    
    function add(){
        $section=$this->Student->Section->find('list');
        $standard=$this->Student->Standard->find('list');
        $caste=$this->Student->Caste->find('list');
        $disability=$this->Student->Disability->find('list');
        $this->set(compact('caste','section','standard','disability'));
        if(!empty($this->data)){
            $this->data['Student']['school_id']=$this->Session->read('School.id');
            if($this->data['Student']['dob']!=""||$this->data['Student']['dob']!=NULL ){
                $this->data['Student']['dob']=date('Y-m-d',strtotime($this->data['Student']['dob']));
            }
            if($this->Student->save($this->data)){
               $this->sendJson('true');
            }else{
                if($this->data['Student']['dob']!=""||$this->data['Student']['dob']!=NULL ){
                    $this->data['Student']['dob']=date('d-m-Y',strtotime($this->data['Student']['dob']));
                }
            }
        }
    }
    
    function edit($studentId=NULL){
        if($studentId==NULL){
            $this->sendJson("false");
        }
        if(empty($this->data)){
            $this->Student->read(NULL,$studentId);
            if(!($this->data=$this->Student->read(NULL,$studentId))){
                $this->sendJson("false");
            }
            $this->data['Student']['dob']=date('d-m-Y',strtotime($this->data['Student']['dob']));
        }else{
            $this->data['Student']['id']=$studentId;
            $this->data['Student']['school_id']=$this->Session->read('School.id');
            if($this->data['Student']['dob']!=""||$this->data['Student']['dob']!=NULL ){
                $this->data['Student']['dob']=date('Y-m-d',strtotime($this->data['Student']['dob']));
            }
            if($this->Student->save($this->data)){
               $this->sendJson('true');
            }else{
                if($this->data['Student']['dob']!=""||$this->data['Student']['dob']!=NULL ){
                    $this->data['Student']['dob']=date('d-m-Y',strtotime($this->data['Student']['dob']));
                }
            }
        }
        $section=$this->Student->Section->find('list');
        $standard=$this->Student->Standard->find('list');
        $caste=$this->Student->Caste->find('list');
        $disability=$this->Student->Disability->find('list');
        $this->set(compact('caste','section','standard','disability'));
    }
    /**
     * View for pagination purpose so that each of them could be handled easily
     */
    function paginatedview(){
        if($this->RequestHandler->isAjax()){
            $this->layout='ajax';
        }
        //$this->layout='ajax';
        $this->paginate=array(
            'limit'=>STUDENT_PAGINATION_LIMIT,
            'order'=>array(
                'Student.created'=>'desc'
            ),
            'conditions'=>array(
                'school_id'=>$this->Session->read('School.id')
            )
        );
        $studentData=$this->Paginate('Student');
        $this->set(compact('studentData'));
        
    }
    
    /**
     * To toggle the status of the Student
     * @param Numeric $studentId
     */
    function toggleStatus($studentId=NULL){
        
        if(!$this->RequestHandler->isAjax()){
            $this->redirect(array('controller'=>'schools','action'=>'home'));
        }
        
        if($studentId==NULL){
            $this->sendJson('false');
        }
        $this->Student->id=$studentId;
        if(!($studentData=$this->Student->read())){
            $this->sendJson('false');
        }
        $currentStatus=$studentData['Student']['status'];
        $currentStatus==1?$newStatus=0:$newStatus=1;
        $isSaved=$this->Student->saveField('status',$newStatus);
        if($isSaved){
            $this->sendJson('true');
        }
        $this->sendJson('false');
    }
    
}

?>
