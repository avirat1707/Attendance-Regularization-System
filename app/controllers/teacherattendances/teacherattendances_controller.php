<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of teacherattendance_controller
 *
 * @author tirthbodawala
 */
class TeacherattendancesController  extends AppController{
    var $name="Teacherattendances";
    
    function add($attendanceDate=NULL){
        $attendanceDate=date('Y-m-d',strtotime($attendanceDate));
        $this->set(compact('attendanceDate'));
        if($attendanceDate==NULL){
            $this->sendJson('false');
        }
        if(!empty($this->data)){
            foreach($this->data['Teacherattendance'] as $Teacherattendance){
                $this->Teacherattendance->id=$Teacherattendance['id'];
                $this->Teacherattendance->saveField('teacher_id',$Teacherattendance['teacher_id']);
                $this->Teacherattendance->saveField('attendancedate',$attendanceDate);
                $this->Teacherattendance->saveField('present',$Teacherattendance['present']);
            }
        }
        $teacher_list=$this->Teacherattendance->Teacher->find('all',array('fields'=>array('id','name','pcn'),'conditions'=>array('school_id'=>$this->Session->read('School.id'))));
        $teacherAttendance=array();
        $i=0;
        foreach($teacher_list as $teacher){
            $teacherAttendance[$i]['Teacherattendance']['name']=$teacher['Teacher']['name'];
            $teacherAttendance[$i]['Teacherattendance']['pcn']=$teacher['Teacher']['pcn'];
            $teacherAttendance[$i]['Teacherattendance']['teacher_id']=$teacher['Teacher']['id'];
            $present=$this->Teacherattendance->find('first',array('conditions'=>array('teacher_id'=>$teacher['Teacher']['id'],'attendancedate'=>$attendanceDate)));
            if(!empty($present)){
                $teacherAttendance[$i]['Teacherattendance']['present']=$present['Teacherattendance']['present'];
                $teacherAttendance[$i]['Teacherattendance']['id']=$present['Teacherattendance']['id'];
            }else{
                $teacherAttendance[$i]['Teacherattendance']['present']='1';
                $teacherAttendance[$i]['Teacherattendance']['id']="";
            }
            $i++;
        }
        $this->set(compact('teacherAttendance'));
    }
    
    function edit($attendanceDate=NULL){
        if($attendanceDate==NULL){
            $this->sendJson('false');
        }
        if(!empty($this->data)){
            foreach($this->data['Teacherattendance'] as $Teacherattendance){
                $this->Teacherattendance->id=$Teacherattendance['id'];
                $this->Teacherattendance->saveField('present',$Teacherattendance['present']);
            }
        }
        $this->paginate=array(
            'Teacherattendance'=>array(
                'conditions'=>array(
                    'attendancedate'=>$attendanceDate
                )
            )
        );
        $teacherAttendance=$this->paginate('Teacherattendance');
        $this->set(compact('teacherAttendance'));
    }
}

?>
