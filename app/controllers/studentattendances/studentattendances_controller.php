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
                $this->Studentattendance->saveField('school_id',$this->Session->read('School.id'));
            }
        }
        $students=$this->Studentattendance->Student->find('all',array('conditions'=>array('standard_id'=>$standard_id,'section_id'=>$section_id,'school_id'=>$this->Session->read('School.id'),'status'=>1),'recursive'=>'-1'));
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
    
    function admin_StudentReport() {
        Configure::write('debug',0);
        
        App::import('Model','School');
        $schoolObj = new School;
        
        App::import('Model','Student');
        $studObj = new Student;
        
        $allSchools = $schoolObj->getAllSchools();
        
        foreach($allSchools as $key => $val) {
            $cond = array();
            $cond['school_id'] = $val['School']['id'];
            $cond['present'] = 0;
            $cond['less_cnt'] = 0;
            $cond['grt_cnt'] = 10;
            $cond['date'] = date('Y-m-d');
            
            $allSchools[$key]['totalStudents'] = $studObj->getStudentsByStatus('count',array('Student.school_id'=>$val['School']['id']));
            
            $day10Data  = $this->Studentattendance->monthWiseAttendence($cond);
            $day10Total = 0;
            
            if(!empty($day10Data)) {
                $day10Total = count($day10Data);
            }
            
            $allSchools[$key]['10days'] = $day10Total;
            
            $cond['less_cnt'] = 10;
            $cond['grt_cnt'] = 20;
            $day20Data = $this->Studentattendance->monthWiseAttendence($cond); 
            
            $day20Total = 0;
            
            if(!empty($day20Data)) {
                $day20Total = count($day20Data);
            }
            $allSchools[$key]['20days'] = $day20Total;
            
            $cond['less_cnt'] = 20;
            $cond['grt_cnt'] = 30;
            $day30Data = $this->Studentattendance->monthWiseAttendence($cond);
            
            $day30Total = 0;
            
            if(!empty($day30Data)) {
                $day30Total = count($day30Data);
            }
            $allSchools[$key]['30days'] = $day30Total;
            }
            $this->set('allSchools',$allSchools);
        }
        
     function admin_detailReport($school_id,$for_days=NULL){
        $cond = array();
        $cond['school_id'] = $school_id;
        $cond['present'] = 0;        
        $cond['monthYear'] = date('Y-m');
        $cond['date'] = date('Y-m-d');
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
        $studentData = $this->Studentattendance->monthWiseAttendence($cond);
        
        $tempArr = array();
        if(!empty($studentData)){
            foreach($studentData as $key => $val){
                $tempArr[] = $val['SA']['student_id'];
            }
        }
        $cond['studentIds'] = $tempArr;
            
        $detailReport = $this->Studentattendance->monthWiseDetailAttendence($cond);
        App::import('Model','School');
        $schoolObj = new School;
        $schoolCond = array();
        $schoolCond = array('School.id'=>$school_id);
        $schoolDetail = $schoolObj->getAllSchools('first',$schoolCond);
        $this->set(compact('schoolDetail'));
        $this->set('detailReport',$detailReport);
    } 
}
?>
