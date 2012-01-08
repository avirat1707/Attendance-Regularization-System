<?php
/**
 * Description of techers_controller
 *
 * @author tirthbodawala
 */
class TeachersController extends AppController {
    var $name="Teachers";
    var $paginate=array(
        'limit'=>TEACHER_PAGINATION_LIMIT
    );
    
    function add(){
        $jobtype=$this->Teacher->Jobtype->find('list');
        $this->set(compact('jobtype'));
        if(!empty($this->data)){
            $this->data['Teacher']['school_id']=$this->Session->read('School.id');
            if($this->data['Teacher']['dob']!=""||$this->data['Teacher']['dob']!=NULL ){
                $this->data['Teacher']['dob']=date('Y-m-d',strtotime($this->data['Teacher']['dob']));
            }
            if($this->data['Teacher']['dojp']!=""||$this->data['Teacher']['dojp']!=NULL ){
                $this->data['Teacher']['dojp']=date('Y-m-d',strtotime($this->data['Teacher']['dojp']));
            }
            if($this->data['Teacher']['dojs']!=""||$this->data['Teacher']['dojs']!=NULL ){
                $this->data['Teacher']['dojs']=date('Y-m-d',strtotime($this->data['Teacher']['dojs']));
            }
            if($this->Teacher->save($this->data)){
               $this->sendJson('true');
            }else{
                if($this->data['Teacher']['dob']!=""||$this->data['Teacher']['dob']!=NULL ){
                    $this->data['Teacher']['dob']=date('d-m-Y',strtotime($this->data['Teacher']['dob']));
                }
                if($this->data['Teacher']['dojp']!=""||$this->data['Teacher']['dojp']!=NULL ){
                    $this->data['Teacher']['dojp']=date('d-m-Y',strtotime($this->data['Teacher']['dojp']));
                }
                if($this->data['Teacher']['dojs']!=""||$this->data['Teacher']['dojs']!=NULL ){
                    $this->data['Teacher']['dojs']=date('d-m-Y',strtotime($this->data['Teacher']['dojs']));
                }
            }
        }
    }
    
    function edit($teacherId=NULL){
        if($teacherId==NULL){
            $this->sendJson("false");
        }
        if(empty($this->data)){
            $this->Teacher->read(NULL,$teacherId);
            if(!($this->data=$this->Teacher->read(NULL,$teacherId))){
                $this->sendJson("false");
            }

            $this->data['Teacher']['dob']=date('d-m-Y',strtotime($this->data['Teacher']['dob']));
            $this->data['Teacher']['dojp']=date('d-m-Y',strtotime($this->data['Teacher']['dojp']));
            $this->data['Teacher']['dojs']=date('d-m-Y',strtotime($this->data['Teacher']['dojs']));
        }else{
            $this->data['Teacher']['id']=$teacherId;
            $this->data['Teacher']['school_id']=$this->Session->read('School.id');
            if($this->data['Teacher']['dob']!=""||$this->data['Teacher']['dob']!=NULL ){
                $this->data['Teacher']['dob']=date('Y-m-d',strtotime($this->data['Teacher']['dob']));
            }
            if($this->data['Teacher']['dojp']!=""||$this->data['Teacher']['dojp']!=NULL ){
                $this->data['Teacher']['dojp']=date('Y-m-d',strtotime($this->data['Teacher']['dojp']));
            }
            if($this->data['Teacher']['dojs']!=""||$this->data['Teacher']['dojs']!=NULL ){
                $this->data['Teacher']['dojs']=date('Y-m-d',strtotime($this->data['Teacher']['dojs']));
            }
            if($this->Teacher->save($this->data)){
               $this->sendJson('true');
            }else{
                if($this->data['Teacher']['dob']!=""||$this->data['Teacher']['dob']!=NULL ){
                    $this->data['Teacher']['dob']=date('d-m-Y',strtotime($this->data['Teacher']['dob']));
                }
                if($this->data['Teacher']['dojp']!=""||$this->data['Teacher']['dojp']!=NULL ){
                    $this->data['Teacher']['dojp']=date('d-m-Y',strtotime($this->data['Teacher']['dojp']));
                }
                if($this->data['Teacher']['dojs']!=""||$this->data['Teacher']['dojs']!=NULL ){
                    $this->data['Teacher']['dojs']=date('d-m-Y',strtotime($this->data['Teacher']['dojs']));
                }
            }
        }
        $jobtype=$this->Teacher->Jobtype->find('list');
        $this->set(compact('jobtype'));
        
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
            'limit'=>TEACHER_PAGINATION_LIMIT,
            'order'=>array(
                'Teacher.created'=>'desc'
            ),
            'conditions'=>array(
                'Teacher.school_id'=>$this->Session->read('School.id')
            )
        );
        $teacherData=$this->Paginate('Teacher');
        $this->set(compact('teacherData'));
        
    }
    /**
     * To toggle the status of the teacher
     * @param String $teacherId
     * @param Numeric $currentStatus 
     */
    function toggleStatus($teacherId=NULL){
        
        if(!$this->RequestHandler->isAjax()){
            $this->redirect(array('controller'=>'schools','action'=>'home'));
        }
        
        if($teacherId==NULL){
            $this->sendJson('false');
        }
        $this->Teacher->id=$teacherId;
        if(!($teacherData=$this->Teacher->read())){
            $this->sendJson('false');
        }
        $currentStatus=$teacherData['Teacher']['status'];
        $currentStatus==1?$newStatus=0:$newStatus=1;
        $isSaved=$this->Teacher->saveField('status',$newStatus);
        if($isSaved){
            $this->sendJson('true');
        }
        $this->sendJson('false');
    }
}

?>
