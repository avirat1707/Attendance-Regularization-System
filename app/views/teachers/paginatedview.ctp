<table id="tblManageTeacher">
    <thead>
        <tr>
            <th class="thTeacherName"><?php echo $this->Paginator->sort('Name','name')?></th>
            <th class="thTeacherSex"><?php echo $this->Paginator->sort('Sex','sex')?></th>
            <th class="thTeacherDOB"><?php echo $this->Paginator->sort('Date Of Birth','dob')?></th>
            <th class="thTeacherPCN"><?php echo $this->Paginator->sort('Pan Card No.','pcn')?></th>
            <th class="thTeacherDOJP"><?php echo $this->Paginator->sort('Date Of Joining Profession','dojp')?></th>
            <th class="thTeacherDOJS"><?php echo $this->Paginator->sort('Date Of Joining School','dojs')?></th>
            <th class="thTeacherSTD"><?php echo $this->Paginator->sort('Std.','std')?></th>
            <th class="thTeacherEQ"><?php echo $this->Paginator->sort('Educational Qualification','eq')?></th>
            <th class="thTeacherJobType"><?php echo $this->Paginator->sort('Job Type','Jobtype.name')?></th>
            <th class="thTeacherStatus"><?php echo $this->Paginator->sort('Status','status')?></th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(!isset($teacherData) || empty($teacherData)){
                ?>
                    <tr>
                        <td colspan="10" align="center">No Records Found!</td>
                    </tr>
                <?php
            }else{
                foreach($teacherData as $teacher):
                    if($teacher['Teacher']['status']=='1'){
                        $teacherStatus='Active';
                        $teacherStatusClass='green';
                    }else{
                        $teacherStatus="Inactive";
                        $teacherStatusClass='red';
                    }
                    strtolower($teacher['Teacher']['sex'])=='m'?$teacherSex='Male':$teacherSex='Female';
                    ?>
                        <tr>
                            <td class="tdTeacherName" title="<?php echo $teacher['Teacher']['name']; ?>"><?php echo $this->Html->link($this->Html->image('edit.png').$this->Text->truncate($teacher['Teacher']['name'],10),"#",array('id'=>'hrefTeacher-'.$teacher['Teacher']['id'],'escape'=>false)); ?></td>
                            <td class="tdTeacherSex" title="<?php echo $teacherSex; ?>"><?php echo $teacherSex; ?></td>
                            <td class="tdTeacherDOB" title="<?php echo date('d-m-Y',strtotime($teacher['Teacher']['dob'])); ?>"><?php echo date('d-m-Y',strtotime($teacher['Teacher']['dob'])); ?></td>
                            <td class="tdTeacherPCN" title="<?php echo $teacher['Teacher']['pcn']; ?>"><?php echo $this->Text->truncate($teacher['Teacher']['pcn'],15); ?></td>
                            <td class="tdTeacherDOJP" title="<?php echo date('d-m-Y',strtotime($teacher['Teacher']['dojp'])); ?>"><?php echo date('d-m-Y',strtotime($teacher['Teacher']['dojp'])); ?></td>
                            <td class="tdTeacherDOJS" title="<?php echo date('d-m-Y',strtotime($teacher['Teacher']['dojs'])); ?>"><?php echo date('d-m-Y',strtotime($teacher['Teacher']['dojs'])); ?></td>
                            <td class="tdTeacherSTD" title="<?php echo $teacher['Teacher']['std']; ?>"><?php echo $teacher['Teacher']['std']; ?></td>
                            <td class="tdTeacherEQ" title="<?php echo $teacher['Teacher']['eq']; ?>"><?php echo $this->Text->truncate($teacher['Teacher']['eq'],10); ?></td>
                            <td class="tdTeacherJobType" title="<?php echo $teacher['Jobtype']['name']; ?>"><?php echo $this->Text->truncate($teacher['Jobtype']['name'],10); ?></td>
                            <td class="tdTeacherStatus" title="<?php echo $teacherStatus; ?>"><?php echo $this->Html->link($teacherStatus,"#",array('id'=>'teacherStatus-'.$teacher['Teacher']['id'],'class'=>$teacherStatusClass,'onclick'=>'return toggleTeacherStatus("'.$teacher['Teacher']['id'].'")')); ?></td>
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
        $("#tblManageTeacher a[href!='#']").live('click',function(e){
            var url=this;
            $("#tblManageTeacher").block({
                message:'<h3>Loading...</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
            });
            $.ajax({
                url:url,
                cache:false,
                type:'GET',
                success:function(msg){
                    $("#tblManageTeacher").html($(msg).html());
                    $("#tblManageTeacher").unblock();
                },
                error:function(msg){
                    $("#tblManageTeacher").unblock();
                }
            });
            e.preventDefault();
        });
    });
    function toggleTeacherStatus(teacherId){
        var url="<?php echo $this->Html->url(array('controller'=>'teachers','action'=>'toggleStatus')); ?>"+"/"+teacherId;
        $currentStatus=$("#teacherStatus-"+teacherId).html();
        if($currentStatus=="Inactive"){
            $message="Are you sure you want to change the status of teacher as Active?";
        }else{
            $message="Are you sure you want to change the status of teacher as Inactive? Turning status of teacher to inactive will omit the teacher from attendance sheet.";
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
                        $("#tblManageTeacher").block({
                            message:'<h3>'+messageStatus+'...</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
                        });
                        $.ajax({
                            url:url,
                            cache:false,
                            async:true,
                            success:function(msg){
                                if(msg=="true"){
                                    $currentStatus=$("#teacherStatus-"+teacherId).html();
                                    if($currentStatus=="Active"){
                                        $newStatus="Inactive";
                                        $("#teacherStatus-"+teacherId).attr("class","red");
                                    }else{
                                        $newStatus="Active";
                                        $("#teacherStatus-"+teacherId).attr("class","green");
                                    }
                                    $("#teacherStatus-"+teacherId).html($newStatus);
                                    $("#tblManageTeacher").unblock();
                                }
                            },
                            error:function(){
                                $("#tblManageTeacher").unblock();
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
