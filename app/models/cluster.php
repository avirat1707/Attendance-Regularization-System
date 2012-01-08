<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cluster
 *
 * @author tirthbodawala
 */
class Cluster extends AppModel{
    var $name="Cluster";
    var $belongsTo=array(
        'Block'
    );
    var $hasMany=array(
        "Village"
    );
}

?>
