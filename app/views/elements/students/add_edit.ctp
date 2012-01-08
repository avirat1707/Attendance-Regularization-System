<div id="divAddStudent">
    <?php
        echo $this->Form->create('Student');
        echo $this->Form->input('id');
        echo $this->Form->input('name',array('label'=>'Name'));
        echo $this->Form->input('sex',array('type'=>'select', 'options'=>array('M'=>'Male','F'=>'Female'), 'label'=>'Sex','default'=>'M'));
        echo $this->Form->input('dob',array('label'=>'Date Of Birth','type'=>'text','readonly'=>'readonly'));
        echo $this->Form->input('generalregister',array('label'=>'General Register'));
        echo $this->Form->input('standard_id',array('options'=>$standard,'label'=>'Standard'));
        echo $this->Form->input('section_id',array('options'=>$section,'label'=>'Section'));
        echo $this->Form->input('caste_id',array('options'=>$caste,'label'=>'Caste'));
        echo $this->Form->input('disability_id',array('options'=>$disability,'label'=>'Disability'));
        echo "<div class='input'><label>Active</label><input type='radio' value='1' name='data[Student][status]' ".(strtolower($this->action)=="add"?"checked='checked'":($this->data['Student']['status']==1?"checked='checked'":NULL))." /></div>";
        echo "<div class='input'><label>Inactive</label><input type='radio' value='0' name='data[Student][status]' ".(strtolower($this->action)=="edit"?($this->data['Student']['status']==0?"checked='checked'":NULL):NULL)."/></div>";
        echo $this->Form->end(array('label'=>'Save','class'=>'jqueryuiButton','style'=>'margin-left:170px;'));
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#StudentDob").datepicker({
                dateFormat:"dd-mm-yy",
                changeMonth:true,
                changeYear:true
            });
        });
    </script>
</div>