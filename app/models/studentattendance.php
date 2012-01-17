<?php


/**
 * Description of studentattendance
 *
 * @author tirthbodawala
 */
class Studentattendance extends AppModel{
    var $name="Studentattendance";
    var $belongsTo=array(
        'Student'
    );
    
    
    
   function monthWiseAttendence($cond = array()){
        $school_id = $cond['school_id'];
        $present = $cond['present'];
        $less_cnt = $cond['less_cnt'];
        $grt_cnt = $cond['grt_cnt'];
        $date = $cond['date'];
        $status = 1;
        if(isset($cond['status'])){
            $status = $cond['status'];
        }
        $query = "SELECT count( * ) cnt, SA.student_id
                    FROM `studentattendances` SA
                    INNER JOIN students S ON ( SA.student_id = S.id )
                    WHERE S.school_id = $school_id
                    AND S.status = $status
                    AND SA.present = $present
                    AND SA.attendancedate
                    BETWEEN DATE_ADD( LAST_DAY( DATE_SUB( NOW( ) , INTERVAL 1 MONTH ) ) , INTERVAL 1 DAY )
                    AND LAST_DAY( NOW( ) )
                    GROUP BY SA.student_id
                    HAVING cnt <= $grt_cnt
                    AND cnt >= $less_cnt";
        return $this->query($query);
    }
    
    
    function monthWiseDetailAttendence($cond = array()){        
        $school_id = $cond['school_id'];
        $present = $cond['present'];
        $less_cnt = $cond['less_cnt'];
        $grt_cnt = $cond['grt_cnt'];
        $date = $cond['date'];
        $status = 1;
        if(isset($cond['status']))
            $status = $cond['status'];
        $studentIds = implode(",",$cond['studentIds']);
    
        $query = "SELECT  SA.*,S.name,R.name
                    FROM `studentattendances` SA
                    INNER JOIN students S ON ( SA.student_id = S.id )
                    LEFT JOIN reasons R ON (SA.reason_id = R.id)
                    WHERE S.school_id = $school_id
                    AND S.status = $status
                    AND SA.present = $present
                    AND SA.student_id IN ($studentIds)
                    AND SA.attendancedate
                    BETWEEN DATE_ADD( LAST_DAY( DATE_SUB( NOW( ) , INTERVAL 1 MONTH ) ) , INTERVAL 1 DAY )
                    AND LAST_DAY( NOW( ) )";
        return $this->query($query);
    }
    
    
    function detailAttendece($cond = array()){
        $school_id = $cond['school_id'];
        $present = $cond['present'];
        $monthYear = $cond['monthYear'];

        $sql = "SELECT SA.*,S.name,R.name 
                FROM  `studentattendances` SA
                INNER JOIN students S ON ( SA.student_id = S.id ) 
                LEFT JOIN reasons R ON (SA.reason_id = R.id)
                WHERE S.school_id = $school_id
                AND SA.present = $present
                AND SA.attendancedate BETWEEN 
                DATE_ADD( LAST_DAY( DATE_SUB( NOW( ) , INTERVAL 1 MONTH ) ) , INTERVAL 1 DAY ) AND LAST_DAY( NOW( ) ) 
                ORDER BY SA.attendancedate ";
          return $this->query($sql);  
    }
    
    function dailyAttendence($cond = array()){
        $school_id = $cond['school_id'];
        $present = $cond['present'];
        $date = $cond['date'];

        $sql = "SELECT count(*) as count 
                FROM  `studentattendances` SA
                INNER JOIN students S ON ( SA.student_id = S.id )                 
                WHERE S.school_id = $school_id
                AND SA.present = $present
                AND SA.attendancedate = '$date' ";
        $count= $this->query($sql);
        if(!empty($count)){
            return $count[0][0]['count'];
        }else{
            return 0;
        }
        
    }
}    
    
?>
