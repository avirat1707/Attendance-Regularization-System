<?php

/**
 * Description of school
 *
 * @author tirthbodawala
 */
class School extends AppModel {
    var $name='School';
    var $belongsTo=array(
        'Block',
        'Cluster',
        'Village',
       /* 'Category' */
    );
    
    var $validate=array(
        'name'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            ),
            'Unique'=>array(
                'rule'=>'isUnique',
                'required'=>true,
                'message'=>'School Already Exists'
            )
        ),
        'disecode'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            ),
            'Unique'=>array(
                'rule'=>'isUnique',
                'required'=>true,
                'message'=>'Dise Code Already Already In Use'
            )
        ),
    );
    function getAllSchools($returnType = 'all',$cond = array()){
        if(empty ($cond))
            return $this->find($returnType);
        else{
           
            return $this->find($returnType,array('conditions'=>$cond));
        }
    }
}

?>
