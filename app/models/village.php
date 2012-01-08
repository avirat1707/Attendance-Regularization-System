<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of village
 *
 * @author tirthbodawala
 */
class Village extends AppModel{
    var $name="Village";
    var $belongsTo=array(
        "Cluster"
    );
}

?>
