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
}

?>
