<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of block
 *
 * @author tirthbodawala
 */
class Block extends AppModel{
    var $name="Block";
    var $hasMany=array(
        'Cluster'
    );
}

?>
