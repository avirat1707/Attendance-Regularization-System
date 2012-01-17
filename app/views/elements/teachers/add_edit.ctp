<div id="divAddTeacher">
    <?php
        echo $this->Form->create('Teacher');
        echo $this->Form->input('id');
        echo $this->Form->input('name',array('label'=>'Name'));
        echo $this->Form->input('sex',array('type'=>'select', 'options'=>array('M'=>'Male','F'=>'Female'), 'label'=>'Sex','default'=>'M'));
        echo $this->Form->input('dob',array('label'=>'Date Of Birth','type'=>'text','readonly'=>'readonly'));
        echo $this->Form->input('pcn',array('label'=>'Pan Card Number'));
        echo $this->Form->input('dojp',array('label'=>'Date Of Joining Profession','type'=>'text','readonly'=>'readonly'));
        echo $this->Form->input('dojs',array('label'=>'Date Of Joining School','type'=>'text','readonly'=>'readonly'));
        echo $this->Form->input('standard_id',array('options'=>$Standard,'label'=>'Standard'));
        echo $this->Form->input('eq',array('label'=>'Educational Qualification'));
        echo $this->Form->input('jobtype_id',array('options'=>$jobtype,'label'=>'Job Type'));
        echo $this->Form->input('caste_id',array('options'=>$caste,'label'=>'Caste'));
        echo $this->Form->input('teachercategory_id',array('options'=>$Teachercategory,'label'=>'Category'));
        echo "<div class='input'><label>Active</label><input type='radio' value='1' name='data[Teacher][status]' ".(strtolower($this->action)=="add"?"checked='checked'":($this->data['Teacher']['status']==1?"checked='checked'":NULL))." /></div>";
        echo "<div class='input'><label>Inactive</label><input type='radio' value='0' name='data[Teacher][status]' ".(strtolower($this->action)=="edit"?($this->data['Teacher']['status']==0?"checked='checked'":NULL):NULL)."/></div>";
        echo $this->Form->end(array('label'=>'Save','class'=>'jqueryuiButton','style'=>'margin-left:170px;'));
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#TeacherDob , #TeacherDojp ,#TeacherDojs").datepicker({
                dateFormat:"dd-mm-yy",
                changeMonth:true,
                changeYear:true
            });
        });
    </script>
</div>
