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
        'Category'
    );
}

?>
