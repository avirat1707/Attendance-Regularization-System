<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of util
 *
 * @author tirthbodawala
 */
class UtilHelper extends Helper {
    function shortStr($string,$limit=NULL,$more=false){
        if($limit==NULL){
            return $string;
        }
        if(strlen($string)<=$limit){
            return $string;
        }
        $newString=substr($string, 0,$limit-3);
        $newString .="...";
        return $newString;
        
    }
}

?>
