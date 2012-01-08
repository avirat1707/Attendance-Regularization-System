<?php
    echo $this->Form->create('Teacherattendance',array('url'=>array('controller'=>'teacherattendances','action'=>'add',$attendanceDate)));
?>
<table id="tblEditTeacherAttendance">
    <thead>
        <tr>
            <th class="thTeacherAttendanceName"><?php echo 'Teacher Name';?></th>
            <th class="thTeacherAttendancePAN"><?php echo 'PAN No.';?></th>
            <th class="thTeacherAttendancePresent"><?php echo 'Present'; ?></th>
            <th class="thTeacherAttendanceAbsent"><?php echo 'Absent';?></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i=0;
            foreach($teacherAttendance as $attendance){
                ?>
                    <tr>
                        <td class="tdTeacherAttendanceName"><?php echo $attendance['Teacherattendance']['name']; ?></td>
                        <td class="tdTeacherAttendancePAN"><?php echo $attendance['Teacherattendance']['pcn']?></td>
                        <td class="tdTeacherAttendancePresent">
                            <?php
                                echo '<input type="hidden" style="display:none" name="data[Teacherattendance]['.$i.'][id]" value="'.$attendance['Teacherattendance']['id'].'" />';
                                echo '<input type="hidden" style="display:none" name="data[Teacherattendance]['.$i.'][teacher_id]" value="'.$attendance['Teacherattendance']['teacher_id'].'" />';
                                if($attendance['Teacherattendance']['present']==1){
                                    $isPresent=true;
                                    $isAbsent=false;
                                }else{
                                    $isPresent=false;
                                    $isAbsent=true;
                                }
                                
                                echo "<input type='radio' name='data[Teacherattendance][".$i."][present]' ".($isPresent==true?"checked='checked'":NULL)." value='1' />";
                            ?>
                        </td>
                        <td class="tdTeacherAttendanceAbsent">
                            <?php
                                echo "<input type='radio' name='data[Teacherattendance][".$i."][present]' ".($isAbsent==true?"checked='checked'":NULL)." value='0' />";
                            ?>
                        </td>
                    </tr>
                <?php
                $i++;
                
            }
        ?>
    </tbody>
</table>
<?php
    echo $this->Form->end(array('label'=>'Save Attendance','class'=>'jqueryuiButton'));
?>