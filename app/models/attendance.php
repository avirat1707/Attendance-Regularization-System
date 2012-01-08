<?php
/**
 * Description of attendance
 *
 * @author tirthbodawala
 */
class Attendance extends AppModel{
    var $name="Attendance";
    var $belongsTo=array(
        'Teacherattendance',
        'Studentattendance'
    );
}

?>
