<div id="divAddProblem">
    <?php
        echo $this->Form->create('Problem');        
        echo $this->Form->input('name',array('label'=>'Name'));
        echo $this->Form->input('problem_type',array('type'=>'select', 'options'=>array('block'=>'Block','district'=>'District'), 'label'=>'Level','default'=>'block'));
        echo $this->Form->input('description',array('label'=>'Description','type'=>'text'));        
        echo $this->Form->end(array('label'=>'Save','class'=>'jqueryuiButton','style'=>'margin-left:170px;'));
    ?>
</div>
