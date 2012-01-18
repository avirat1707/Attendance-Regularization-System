<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of attendances_controller
 *
 * @author tirthbodawala
 */
class ProblemsController extends AppController{
    var $name="Problems";
    
    function add(){
        if(!empty($this->data)){                        
            $this->data['Problem']['school_id'] = $this->Session->read('School.id');
            $this->data['Problem']['date'] = date('Y-m-d');
            $this->Problem->save($this->data);            
        }
        
        $cond = array();
        $cond= array('Problem.school_id'=>$this->Session->read('School.id'));        
        $this->data['list'] = $this->Problem->getProblems('all',$cond);
    }
    
    function admin_report($date = ''){
        $cond = array();
        if(!empty($date))
            $cond = array('Problem.date'=>$date);
        
        if(!empty($this->data)) {
            if($this->data['Problem']['problem_type'] != 'all'){
             $cond = array_merge($cond,array('Problem.problem_type'=>$this->data['Problem']['problem_type']));   
             
            }
        }
        $extra = array();
        $extra = array('recursive'=>2);
        $this->data['list'] = $this->Problem->getProblems('all',$cond,$extra);
    }
}

?>
