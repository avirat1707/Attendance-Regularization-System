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
class Problem extends AppModel {
    
    var $name = 'Problem';
    
    var $belongsTo = array('School'); 
    
    var $validate=array(
        'name'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            )
        ),
        'problem_type'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            )
        ),
        'description'=>array(
            'Required'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'The above field is required'
            )
        )
    );
    
    function getProblems($returnType = 'first',$cond = array(),$extra = array()){
        $order = 'Problem.created,Problem.id Desc';        
        $recursive = '-1';
        
        if(isset($extra['recursive']))
               $recursive = $extra['recursive']; 
        return $this->find($returnType,array('conditions'=>$cond,'order'=>$order,'recursive'=>$recursive));
    }
}  
?>
