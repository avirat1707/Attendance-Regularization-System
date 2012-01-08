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
            'Attendance'=>array(
                'recursive'=>-1,
                'group'=>array('attendancedate'),
                'order'=>array('attendancedate'=>'desc'),
                'limit'=>ATTENDANCE_PAGINATION_LIMIT
            )
        );
        $attendanceData=$this->paginate();
        $this->set(compact('attendanceData'));
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
}

?>
