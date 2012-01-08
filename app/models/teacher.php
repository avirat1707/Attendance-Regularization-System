<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of teacher
 *
 * @author tirthbodawala
 */
class Teacher extends AppModel {
    var $name='Teacher';
    var $belongsTo=array('Jobtype');
    var $validate=array(
        'name'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            )
        ),
        'sex'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            )
        ),
        'dob'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            ),
            'Date'=>array(
                'rule'=>'date',
                'required'=>true,
                'message'=>'Invalid Date'
            )
        ),
        'pcn'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            ),
            'unique'=>array(
                'rule'=>'isUnique',
                'required'=>true,
                'message'=>'Already in use'
            )
        ),
        'dojp'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            ),
            'Date'=>array(
                'rule'=>'date',
                'required'=>true,
                'message'=>'Invalid Date'
            )
        ),
        'dojs'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            ),
            'Date'=>array(
                'rule'=>'date',
                'required'=>true,
                'message'=>'Invalid Date'
            )
        ),
        'std'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            )
        ),
        'jobtype_id'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            )
        ),
        'eq'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            )
        ),
        'status'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            )
        )
    );
}

?>
