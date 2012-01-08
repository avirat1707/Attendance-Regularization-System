<?php

/**
 * Description of studentattendances_controller
 *
 * @author tirthbodawala
 */
class StudentattendancesController extends AppController{
    var $name="Studentattendances";
    
    function add($date=NULL,$standard_id=NULL,$section_id=NULL){
        $date=date('Y-m-d',strtotime($date));
        if($date==NULL||$standard_id==NULL||$section_id==NULL){
            $this->sendJson('false');
        }
        if(!empty($this->data)){
            foreach($this->data['Studentattendance'] as $attendance){
                $this->Studentattendance->id=$attendance['id'];
                $this->Studentattendance->saveField('student_id',$attendance['student_id']);
                $this->Studentattendance->saveField('present',$attendance['present']);
                $this->Studentattendance->saveField('attendancedate',$date);
            }
        }
        $students=$this->Studentattendance->Student->find('all',array('conditions'=>array('standard_id'=>$standard_id,'section_id'=>$section_id,'school_id'=>$this->Session->read('School.id')),'recursive'=>'-1'));
        $studentAttendance=array();
        $i=0;
        foreach($students as $student){
            $studentAttendance[$i]['Studentattendance']['student_id']=$student['Student']['id'];
            $studentAttendance[$i]['Studentattendance']['name']=$student['Student']['name'];
            $studentAttendance[$i]['Studentattendance']['generalregister']=$student['Student']['generalregister'];
            if($currentAttendance=$this->Studentattendance->find('first',array('conditions'=>array('attendancedate'=>$date,'student_id'=>$student['Student']['id']),'recursive'=>'-1'))){
                $studentAttendance[$i]['Studentattendance']['id']=$currentAttendance['Studentattendance']['id'];
                $studentAttendance[$i]['Studentattendance']['present']=$currentAttendance['Studentattendance']['present'];
            }else{
                $studentAttendance[$i]['Studentattendance']['id']="";
                $studentAttendance[$i]['Studentattendance']['present']='1';
            }
            $i++;
        }
        if(empty($studentAttendance)){
            $this->sendJson("false");
        }
        $this->set(compact('studentAttendance'));
    }
    
    function selectClassSection(){
        $sections=$this->Studentattendance->Student->Section->find('list');
        $standards=$this->Studentattendance->Student->Standard->find('list');
        $this->set(compact('sections','standards'));
    }
}

?>
