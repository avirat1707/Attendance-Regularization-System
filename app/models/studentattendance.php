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
}

?>
