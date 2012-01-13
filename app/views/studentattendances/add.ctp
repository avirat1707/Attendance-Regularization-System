<?php
    echo $this->Form->create('Studentattendance',array('url'=>array('controller'=>'studentattendances','action'=>'add',$this->params['pass'][0],$this->params['pass'][1],$this->params['pass'][2])));
?>
<table id="tblAddStudentAttendance">
    <thead>
        <tr>
            <th class="thStudentAttendanceName"><?php echo 'Student Name'; ?></th>
            <th class="thStudentAttendancePAN"><?php echo 'General Register'; ?></th>
            <th class="thStudentAttendancePresent"><?php echo 'Present'; ?></th>
            <th class="thStudentAttendanceAbsent"><?php echo 'Absent'; ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i=0;
            foreach($studentAttendance as $attendance){
                ?>
                    <tr>
                        <td class="tdStudentAttendanceName"><?php echo $attendance['Studentattendance']['name']; ?></td>
                        <td class="tdStudentAttendanceGR"><?php echo $attendance['Studentattendance']['generalregister']?></td>
                        <td class="tdStudentAttendancePresent">
                            <?php
                                echo '<input type="hidden" style="display:none" name="data[Studentattendance]['.$i.'][id]" value="'.$attendance['Studentattendance']['id'].'" />';
                                echo '<input type="hidden" style="display:none" name="data[Studentattendance]['.$i.'][student_id]" value="'.$attendance['Studentattendance']['student_id'].'" />';
                                if($attendance['Studentattendance']['present']==1){
                                    $isPresent=true;
                                    $isAbsent=false;
                                }else{
                                    $isPresent=false;
                                    $isAbsent=true;
                                }
                                echo "<input type='radio' name='data[Studentattendance][".$i."][present]' ".($isPresent==true?"checked='checked'":NULL)." value='1' />";
                            ?>
                        </td>
                        <td class="tdStudentAttendanceAbsent">
                            <?php
                                echo "<input type='radio' name='data[Studentattendance][".$i."][present]' ".($isAbsent==true?"checked='checked'":NULL)." value='0' />";
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
