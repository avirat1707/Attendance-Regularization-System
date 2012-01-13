<table id="tblManageStudent">
    <thead>
        <tr>
            <th class="thStudentName"><?php echo $this->Paginator->sort('Name','name')?></th>
            <th class="thStudentSex"><?php echo $this->Paginator->sort('Sex','sex')?></th>
            <th class="thStudentDOB"><?php echo $this->Paginator->sort('Date Of Birth','dob')?></th>
            <th class="thStudentGR"><?php echo $this->Paginator->sort('General Register','generalregister')?></th>
            <th class="thStudentSTD"><?php echo $this->Paginator->sort('Std','Standard.name')?></th>
            <th class="thStudentSection"><?php echo $this->Paginator->sort('Section','Section.name')?></th>
            <th class="thStudentCaste"><?php echo $this->Paginator->sort('Caste','Caste.name')?></th>
            <th class="thStudentDisability"><?php echo $this->Paginator->sort('Disability','Disability.name')?></th>
            <th class="thStudentStatus"><?php echo $this->Paginator->sort('Status','status')?></th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(!isset($studentData) || empty($studentData)){
                ?>
                    <tr>
                        <td colspan="10" align="center">No Records Found!</td>
                    </tr>
                <?php
            }else{
                foreach($studentData as $student):
                    if($student['Student']['status']=='1'){
                        $studentStatus='Active';
                        $studentStatusClass='green';
                    }else{
                        $studentStatus="Inactive";
                        $studentStatusClass='red';
                    }
                    strtolower($student['Student']['sex'])=='m'?$studentSex='Male':$studentSex='Female';
                    ?>
                        <tr>
                            <td class="tdStudentName" title="<?php echo $student['Student']['name']; ?>"><?php echo $this->Html->link($this->Html->image('edit.png').$this->Text->truncate($student['Student']['name'],30),"#",array('id'=>'hrefStudent-'.$student['Student']['id'],'escape'=>false)); ?></td>
                            <td class="tdStudentSex" title="<?php echo $studentSex; ?>"><?php echo $studentSex; ?></td>
                            <td class="tdStudentDOB" title="<?php echo date('d-m-Y',strtotime($student['Student']['dob'])); ?>"><?php echo date('d-m-Y',strtotime($student['Student']['dob'])); ?></td>
                            <td class="tdStudentGR" title="<?php echo $student['Student']['generalregister']; ?>"><?php echo $this->Text->truncate($student['Student']['generalregister'],15); ?></td>
                            <td class="tdStudentSTD" title="<?php echo $student['Standard']['name']; ?>"><?php echo $student['Standard']['name']; ?></td>
                            <td class="tdStudentSection" title="<?php echo $student['Section']['name']; ?>"><?php echo $student['Section']['name']; ?></td>
                            <td class="tdStudentCaste" title="<?php echo $student['Caste']['name']; ?>"><?php echo $this->Text->truncate($student['Caste']['name'],19); ?></td>
                            <td class="tdStudentDisability" title="<?php echo $student['Disability']['name']; ?>"><?php echo $this->Text->truncate($student['Disability']['name'],10); ?></td>
                            <td class="tdStudentStatus" title="<?php echo $studentStatus; ?>"><?php echo $this->Html->link($studentStatus,"#",array('id'=>'studentStatus-'.$student['Student']['id'],'class'=>$studentStatusClass,'onclick'=>'return toggleStudentStatus("'.$student['Student']['id'].'")')); ?></td>
                        </tr>
                    <?php
                endforeach;
                ?>
                    <tr>
                        <td colspan="10" style="text-align: center;border:0;">
                            <?php echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled')); ?>
                            <?php echo "&nbsp;&nbsp;".$this->Paginator->numbers()."&nbsp;&nbsp;"; ?>
                            <?php echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled')); ?>
                        </td>
                        
                    </tr>
                <?php
            }
            
        ?>
    </tbody>
</table>
<script type="text/javascript">
    $(document).ready(function(){
        $("#tblManageStudent a[href!='#']").live('click',function(e){
            var url=this;
            $("#tblManageStudent").block({
                message:'<h3>Loading...</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
            });
            $.ajax({
                url:url,
                cache:false,
                type:'GET',
                success:function(msg){
                    $("#tblManageStudent").html($(msg).html());
                    $("#tblManageStudent").unblock();
                },
                error:function(msg){
                    $("#tblManageStudent").unblock();
                }
            });
            e.preventDefault();
        });
    });
    function toggleStudentStatus(studentId){
        var url="<?php echo $this->Html->url(array('controller'=>'students','action'=>'toggleStatus')); ?>"+"/"+studentId;
        $currentStatus=$("#studentStatus-"+studentId).html();
        if($currentStatus=="Inactive"){
            $message="Are you sure you want to change the status of student as Active?";
        }else{
            $message="Are you sure you want to change the status of student as Inactive? Turning status of student to inactive will omit the student from attendance sheet.";
        }
        var div=$("<div>");
        div.attr({
            title:"Alert:"
        });
        div.html($message);
        div.dialog({
            resizable:false,
            modal:true,
            buttons:[
                {
                    text:"Yes",
                    click:function(){
                        var messageStatus=$currentStatus=="Inactive"?"Activating":"Inactivating";
                        $("#tblManageStudent").block({
                            message:'<h3>'+messageStatus+'...</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
                        });
                        $.ajax({
                            url:url,
                            cache:false,
                            async:true,
                            success:function(msg){
                                if(msg=="true"){
                                    $currentStatus=$("#studentStatus-"+studentId).html();
                                    if($currentStatus=="Active"){
                                        $newStatus="Inactive";
                                        $("#studentStatus-"+studentId).attr("class","red");
                                    }else{
                                        $newStatus="Active";
                                        $("#studentStatus-"+studentId).attr("class","green");
                                    }
                                    $("#studentStatus-"+studentId).html($newStatus);
                                    $("#tblManageStudent").unblock();
                                }
                            },
                            error:function(){
                                $("#tblManageStudent").unblock();
                            }
                        });
                        $(this).dialog("close");
                    }
                },
                {
                    text:"No",
                    click:function(){
                        $(this).dialog("close");
                    }
                }
            ]
        });
        
        return false;
    }
</script>
