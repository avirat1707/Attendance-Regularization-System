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
        $status = 1;
        if(isset($cond['status']))
            $status = $cond['status'];
        
        $sql = "SELECT COUNT( * ) as cnt,TA.teacher_id,T.name 
                FROM  `teacherattendances` TA
                INNER JOIN teachers T ON ( T.id = TA.teacher_id ) 
                WHERE T.school_id = $school_id
                AND TA.present = $present
                AND T.status = $status
                AND TA.attendancedate BETWEEN 
                DATE_ADD( LAST_DAY( DATE_SUB( NOW( ) , INTERVAL 1 MONTH ) ) , INTERVAL 1 DAY ) AND LAST_DAY( NOW( ) ) 
                GROUP BY TA.teacher_id
                having cnt <= $grt_cnt and cnt >= $less_cnt ";
      return $this->query($sql);  
    }
    
    
    function monthWiseDetailAttendence($cond = array()){        
        $school_id = $cond['school_id'];
        $present = $cond['present'];
        $date = $cond['date'];
        $status = 1;
        if(isset($cond['status']))
            $status = $cond['status'];
        $teacherIds = implode(",",$cond['teacherIds']);
    
         $query = "SELECT TA.*,T.name,R.name 
                FROM  `teacherattendances` TA
                INNER JOIN teachers T ON ( T.id = TA.teacher_id )
                LEFT JOIN reasons R ON (TA.reason_id = R.id) 
                WHERE T.school_id = $school_id
                AND TA.present = $present
                AND T.status = $status
                AND TA.teacher_id IN ($teacherIds)
                AND TA.attendancedate BETWEEN 
                DATE_ADD( LAST_DAY( DATE_SUB( NOW( ) , INTERVAL 1 MONTH ) ) , INTERVAL 1 DAY ) AND LAST_DAY( NOW( ) ) ";
        return $this->query($query);
    }
    
    function detailAttendece($cond = array()){
        $school_id = $cond['school_id'];
        $present = $cond['present'];
        $monthYear = $cond['monthYear'];
        
        $sql = "SELECT TA.*,T.name,R.name 
                FROM  `teacherattendances` TA
                INNER JOIN teachers T ON ( TA.teacher_id = T.id ) 
                LEFT JOIN reasons R ON (TA.reason_id = R.id)
                WHERE T.school_id = $school_id
                AND TA.present = $present
                AND TA.attendancedate BETWEEN 
                DATE_ADD( LAST_DAY( DATE_SUB( NOW( ) , INTERVAL 1 MONTH ) ) , INTERVAL 1 DAY ) AND LAST_DAY( NOW( ) ) 
                ORDER BY TA.attendancedate ";
      return $this->query($sql);          
    }
    
    function dailyAttendence($cond = array()){
        $school_id = $cond['school_id'];
        $present = $cond['present'];
        $date = $cond['date'];
        
        $sql = "SELECT count(*) as count
                FROM  `teacherattendances` TA
                INNER JOIN teachers T ON ( TA.teacher_id = T.id ) 
                WHERE T.school_id = $school_id
                AND TA.present = $present
                AND TA.attendancedate ='$date' ";
        $count= $this->query($sql);
        if(!empty($count)){
            return $count[0][0]['count'];
        }else{
            return 0;
        }
    }
}
?>
