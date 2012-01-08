<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of student
 *
 * @author tirthbodawala
 */
class Student extends AppModel{
    var $name="Student";
    var $belongsTo=array(
        'Disability',
        'Caste',
        'Section',
        'Standard'
    );
    
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
        'standard_id'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            )
        ),
        'section_id'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            )
        ),
        'generalregister'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            ),
            'unique'=>array(
                'rule'=>'isUnique',
                'required'=>true,
                'message'=>'Arleady in use'
            )
        ),
        'disability_id'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            )
        ),
        'caste_id'=>array(
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
    
    
    function getAllStudnetCount($school_id) {
        $query = "SELECT count( * ) as count  , standard_id
                    FROM `students`
                    WHERE school_id = ".$school_id."
                    GROUP BY standard_id 
                    ORDER BY standard_id ASC";
        $total = $this->query($query);
        if(!empty($total))
               return $total;
        else
               return array(); 
    }
    

}

?>
