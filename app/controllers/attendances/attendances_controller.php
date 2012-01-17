<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of attendances_controller
 *
 * @author tirthbodawala
 */
class AttendancesController extends AppController{
    var $name="Attendances";
    function index(){
        
        $this->paginate=array(
            'recursive'=>-1,
            'order'=>array('Attendance.attendancedate'=>'desc'),
            'conditions'=>array('Attendance.school_id'=>$this->Session->read('School.id')),
            'limit'=>ATTENDANCE_PAGINATION_LIMIT
        );
        $attendanceData=$this->paginate();
        $this->set(compact('attendanceData',$attendanceData));
        App::import("Model","Section");
        $sections=$this->Attendance->Studentattendance->Student->Section->find('list');
        $standards=$this->Attendance->Studentattendance->Student->Standard->find('list');
        $this->set(compact('sections','standards'));
    }
    
    function studentAttendanceStatus($attendanceDate=NULL,$standard_id=NULL,$section_id=NULL){
        if($attendanceDate==NULL || $standard_id==NULL || $section_id==NULL){
            $this->sendJson("false");
        }
        $student_list=$this->Attendance->Studentattendance->Student->find(
            'list',
            array(
                'fields'=>array('id'),
                'conditions'=>array(
                    'standard_id'=>$standard_id,
                    'section_id'=>$section_id,
                    'school_id'=>$this->Session->read('School.id'))
            )
        );
        $student_count=$this->Attendance->Studentattendance->find('count',array('conditions'=>array('student_id'=>$student_list,'attendancedate'=>$attendanceDate)));
        $this->sendJson($student_count."");
    }
    
    function admin_generalReport() {
        //Configure::write('debug',0);    
        
        App::import('Model','School');
        $schoolObj = new School;
        
        App::import('Model','Teacher');
        $teacherObj = new Teacher;
        
        App::import('Model','Student');
        $studObj = new Student;
        
        $allSchools = $schoolObj->getAllSchools();
        
        foreach($allSchools as $key => $val) {
            $returnType = 'count';
            $cond = array();
            $cond = array('Teacher.sex' => 'M','school_id'=>$allSchools[$key]['School']['id']);
            $maleTeacherCount = $teacherObj->getTeachesByStatus($returnType,$cond);
            
            $cond = array();
            $cond = array('Teacher.sex' => 'F','school_id'=>$allSchools[$key]['School']['id']);
            $femaleTeacherCount = $teacherObj->getTeachesByStatus($returnType,$cond);           
            
            $allSchools[$key]['maleTeacherCount'] = $maleTeacherCount;
            $allSchools[$key]['femaleTeacherCount'] = $femaleTeacherCount;
            
            $allStudentCount = $studObj->getAllStudentCount($val['School']['id']);
           $allSchools[$key]['studentCount'] = $allStudentCount;
        }
        $this->set('allSchools',$allSchools);
    }
    
    function admin_dayReport(){
        App::import('Model','School');
        $schoolObj = new School;
        
        if(isset($this->params['url']['date']))
          $date = $this->params['url']['date'];
        else
            $date = date('Y-m-d');    
        
        App::import('Model','Teacherattendance');
        $teacherObj = new Teacherattendance;
        
        App::import('Model','Studentattendance');
        $studObj = new Studentattendance;
        
        $allSchools = $schoolObj->getAllSchools();
        
        foreach($allSchools as $key =>$val) {            
            $cond = array();
            $cond = array('school_id'=>$val['School']['id'],'present'=>1,'date'=>$date);
            
            $allSchools[$key]['Teacher']['totalPresent'] = $teacherObj->dailyAttendence($cond);
           $allSchools[$key]['Student']['totalPresent'] = $studObj->dailyAttendence($cond);
 
            $cond = array();
            $cond = array('school_id'=>$val['School']['id'],'present'=>0,'date'=>$date);
            
           $allSchools[$key]['Teacher']['totalAbsent'] = $teacherObj->dailyAttendence($cond);
           $allSchools[$key]['Student']['totalAbsent'] = $studObj->dailyAttendence($cond);
            $this->set('allSchools',$allSchools);            
            
        }
    }
}

?>
