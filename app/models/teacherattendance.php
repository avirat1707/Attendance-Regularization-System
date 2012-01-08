<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of teacherattendance
 *
 * @author tirthbodawala
 */
class Teacherattendance  extends AppModel{
    var $name="Teacherattendance";
    var $belongsTo=array(
        'Teacher'
    );
    
    function monthWiseAttendence($cond = array()){        
        $school_id = $cond['school_id'];
        $present = $cond['present'];
        $less_cnt = $cond['less_cnt'];
        $grt_cnt = $cond['grt_cnt'];
        $date = $cond['date'];
        
        $sql = "SELECT COUNT( * ) as cnt,TA.teacher_id 
                FROM  `teacherattendances` TA
                INNER JOIN teachers T ON ( T.id = TA.teacher_id ) 
                WHERE T.school_id = $school_id
                AND TA.present = $present
                AND TA.attendancedate BETWEEN 
                DATE_ADD( LAST_DAY( DATE_SUB( NOW( ) , INTERVAL 1 MONTH ) ) , INTERVAL 1 DAY ) AND LAST_DAY( NOW( ) ) 
                GROUP BY TA.teacher_id
                having cnt <= $grt_cnt and cnt > $less_cnt ";
      return $this->query($sql);  
    }
}
?>
