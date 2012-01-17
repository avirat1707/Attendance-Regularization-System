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
    
    
    function getAllStudentCount($school_id){
        $total=$this->find(
            'all',
            array(
                'fields'=>array('COUNT(*) as count','standard_id'),
                'conditions'=>array(
                    'school_id'=>$school_id,
                ),
                'group'=>array(
                    'standard_id'
                ),
                'order'=>array(
                    'standard_id'=>'ASC'
                )
            )
        );
        if(!empty($total)){
            return $total;
        }else{
            return array();
        }
    }
    
    function getStudentsByStatus($returnType,$cond) {        
        return $this->find($returnType,array('conditions'=>$cond));
    }
    function leftStudents($cond) {
        $sql = "SELECT ST.* FROM students ST INNER JOIN schools S ON (ST.school_id = S.id)
                WHERE ST.status = 0 and S.id = {$cond['school_id']} AND
                DATE_FORMAT(ST.modified,'%Y-%m') = DATE_FORMAT(NOW(),'".$cond['monthYear']."')";
        return $this->query($sql);
    }
}

?>
