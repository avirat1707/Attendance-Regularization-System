<div id="divAddSchool">
    <?php
        echo $this->Form->create('School');
        echo $this->Form->input('id');
        echo $this->Form->input('name',array('label'=>'Name'));
        echo $this->Form->input('address',array('label'=>'Address','type'=>'textarea','rows'=>3,'cols'=>17,'style'=>'resize:none'));
        echo $this->Form->input('Block.name',array('label'=>'Block'));
        echo $this->Form->input('Cluster.name',array('label'=>'Cluster'));
        echo $this->Form->input('Village.name',array('label'=>'Village'));
        echo $this->Form->input('disecode',array('label'=>'Dise Code'));
        if(strtolower($this->action)=="admin_add"){
            $style="style='display:none'";
        }else{
            $style="";
        }
        echo "<div ".$style.">";
        echo "  <div class='input'><label>Active</label><input type='radio' value='1' name='data[School][status]' ".(strtolower($this->action)=="admin_add"?"checked='checked'":($this->data['School']['status']==1?"checked='checked'":NULL))." /></div>";
        echo "  <div class='input'><label>Inactive</label><input type='radio' value='0' name='data[Status][status]' ".(strtolower($this->action)=="admin_edit"?($this->data['School']['status']==0?"checked='checked'":NULL):NULL)."/></div>";
        echo "</div>";
        echo $this->Form->end(array('label'=>'Save','class'=>'jqueryuiButton','style'=>'margin-left:170px;'));
    ?>
</div>
