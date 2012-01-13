<div id="divSelectClassSection">
    <p>
        <label for="txtFrmStudentAttendanceDate">Attendance Date</label>
        <?php
            echo $this->Form->input('section_id',array('type'=>'text','id'=>'txtFrmStudentAttendanceDate','readonly'=>'readonly','label'=>false,'div'=>false));
        ?>
    </p>
    <p>
        <label for="txtStudentStd">Select Standard</label>
        <?php
            echo $this->Form->input('standard_id',array('type'=>'select','options'=>$standards,'id'=>'selFrmStudentStandard','label'=>false,'div'=>false));
        ?>
    </p>
    <p>  
        <label for="selStudentSection">Select Section</label>
        <?php
            echo $this->Form->input('section_id',array('type'=>'select','options'=>$sections,'id'=>'selFrmStudentSection','label'=>false,'div'=>false));
        ?>
    </p>
    <p>
        <?php
            echo $this->Form->button('Continue',array('class'=>'jqueryuiButton','id'=>'btnSelectClassSectionContinue'));
        ?>
    </p>
</div>