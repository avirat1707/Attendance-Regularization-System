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
                $this->Teacherattendance->saveField('school_id',$this->Session->read('School.id'));
            }
        }
        $teacher_list=$this->Teacherattendance->Teacher->find('all',array('fields'=>array('id','name','pcn'),'conditions'=>array('school_id'=>$this->Session->read('School.id'),'status'=>1)));
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
    
    function admin_report(){
        Configure::write('debug',0);
        
        App::import('Model','School');
        $schoolObj = new School;
        
        App::import('Model','Teacher');
        $teacherObj = new Teacher;
        
        $allSchools = $schoolObj->getAllSchools();
        
        foreach($allSchools as $key => $val) {
            $cond = array();
            $cond['school_id'] = $val['School']['id'];
            $cond['present'] = 0;
            $cond['less_cnt'] = 0;
            $cond['grt_cnt'] = 10;
            $cond['date'] = date('Y-m-d');
            
            $allSchools[$key]['totalTeachers'] = $teacherObj->getTeachesByStatus('count',array('Teacher.school_id'=>$val['School']['id']));
            
            $day10Data  = $this->Teacherattendance->monthWiseAttendence($cond);
            $day10Total = 0;
            
            if(!empty($day10Data)) {
                $day10Total = count($day10Data);
            }
            
            $allSchools[$key]['10days'] = $day10Total;
            
            $cond['less_cnt'] = 10;
            $cond['grt_cnt'] = 20;
            $day20Data = $this->Teacherattendance->monthWiseAttendence($cond); 
            
            $day20Total = 0;
            
            if(!empty($day20Data)) {
                $day20Total = count($day20Data);
            }
            $allSchools[$key]['20days'] = $day20Total;
            
            $cond['less_cnt'] = 20;
            $cond['grt_cnt'] = 30;
            $day30Data = $this->Teacherattendance->monthWiseAttendence($cond);
            
            $day30Total = 0;
            
            if(!empty($day30Data)) {
                $day30Total = count($day30Data);
            }
            $allSchools[$key]['30days'] = $day30Total;
        }
        $this->set('allSchools',$allSchools);
    }
    
    function admin_detailReport($school_id,$for_days){
        $cond = array();
        $cond['school_id'] = $school_id;
        $cond['present'] = 0;        
        $cond['monthYear'] = date('Y-m');
        $cond['date'] = date('Y-m-d');
        
        App::import('Model','School');
        $schoolObj = new School;
        $schoolCond = array();
        $schoolCond = array('School.id'=>$school_id);
        $schoolDetail = $schoolObj->getAllSchools('first',$schoolCond);
        
        $this->set('schoolDetail',$schoolDetail);
        
        if($for_days == 10){
            $cond['less_cnt'] = 0;
            $cond['grt_cnt'] = 10;
            
        }
        
        if($for_days == 20){
            $cond['less_cnt'] = 11;
            $cond['grt_cnt'] = 20;
            
        }
        
        if($for_days == 30){
            $cond['less_cnt'] = 21;
            $cond['grt_cnt'] = 31;
            
        }
        
        $teacherData = $this->Teacherattendance->monthWiseAttendence($cond);
        
        $tempArr = array();
        if(!empty($teacherData)){
            foreach($teacherData as $key => $val){
                $tempArr[] = $val['TA']['teacher_id'];
            }
        }
        $cond['teacherIds'] = $tempArr;
            
        $detailReport = $this->Teacherattendance->monthWiseDetailAttendence($cond);
        $this->set('detailReport',$detailReport);
    }
}

?>
