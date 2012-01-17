<?php
//pr($this->Paginator);
//die;
?>
<table id="tblAttendance">
    <thead>
        <tr>
            <th class="thAttendanceDate"><?php echo $this->Paginator->sort('Attendance Date','attendancedate')?></th>
            <th class="thTeacherAttendance"><?php echo 'Teacher Attendance';?></th>
            <th class="thStudentAttendance"><?php echo 'Student Attendance';?></th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(count($attendanceData)==0){
                ?>
                    <tr>
                        <td colspan="<?php echo count($sections)+2; ?>">No Records Found</td>
                    </tr>
                <?php
            }else{
                foreach($attendanceData as $attendance){
                    ?>
                        <tr>
                            <td class="tdAttendanceDate"><?php echo date('d-m-Y',strtotime($attendance['Attendance']['attendancedate'])); ?></td>
                            <td class="tdTeacherAttendance">
                                <?php 
                                    if($attendance['Attendance']['teacherattendance_id']){
                                        echo $this->Html->link(
                                            "<span class='green'>Report Present".$this->Html->image('edit.png')."</span>",
                                            "#",
                                            array(
                                                'escape'=>false,
                                                'class'=>'hrefEditTeacherAttendance',
                                                'forDate'=>date('Y-m-d',strtotime($attendance['Attendance']['attendancedate']))
                                            )
                                        );
                                    }else{
                                        echo $this->Html->link(
                                            "<span class='red'>Report Not Present".$this->Html->image('add.png')."</span>",
                                            "#",
                                            array(
                                                'escape'=>false,
                                                'class'=>'hrefAddTeacherAttendance',
                                                'forDate'=>date('Y-m-d',strtotime($attendance['Attendance']['attendancedate']))
                                            )
                                        );
                                    }
                                ?>
                            </td>
                            <td class="tdStudentAttendance">
                                <div class="divStudentReport" forDate="<?php echo date('Y-m-d',strtotime($attendance['Attendance']['attendancedate'])); ?>">
                                    <?php
                                        echo $this->Form->select('standard_id',$standards,null,array('empty'=>'Select STD','class'=>'selSelectSTD','id'=>null));
                                        echo $this->Form->select('section_id',$sections,null,array('empty'=>'Select Section','style'=>'margin-left:10px;','class'=>'selSelectSection','disabled'=>'disabled','id'=>null));
                                    ?>
                                </div>
                                <div class="divStudentReport" style="margin-left:10px;" reportForDate="<?php echo date('Y-m-d',strtotime($attendance['Attendance']['attendancedate'])); ?>"><span style="font-size: 11px;color:#666">Select STD and Section</span></div>
                            </td>
                        </tr>
                    <?php
                }
                ?>
                    <tr>
                        <td colspan="3" style="text-align: center;border:0;">
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
        /**
         * Edit Teacher Attendance
         */
        $(".hrefEditTeacherAttendance").unbind();
        $(".hrefEditTeacherAttendance").live('click',function(e){
            $("#tblAttendance").block({
                message:'<h3>Loading...</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>',
                css:{width:"auto",padding:"10px",marginTop:'180px'}
            });
            var attendanceDate=$(this).attr('forDate');
            $.ajax({
                url:"<?php echo $this->Html->url(array('controller'=>'teacherattendances','action'=>'add'));?>"+"/"+attendanceDate,
                cache:false,
                type:"GET",
                success:function(msg){
                    if(msg==false){
                        e.preventDefault();
                    }else{
                        var divModalEditTeacherAttendance=$('<div>');
                        divModalEditTeacherAttendance.attr({
                            id:'divModalEditTeacherAttendance',
                            title:'Edit Teacher Attendance - '+attendanceDate
                        });
                        divModalEditTeacherAttendance.html(msg);
                        divModalEditTeacherAttendance.dialog({
                            modal:true,
                            width:'350',
                            resizable:false,
                            close:function(){
                                $("#divModalEditTeacherAttendance").remove();
                            }
                        });
                        $("#TeacherattendanceAddForm").unbind();
                        $("#TeacherattendanceAddForm").on('submit',function(){
                           $("#divModalEditTeacherAttendance").parent().block({
                               message:'<h3>Saving Attendance Data:</h3><?php echo $this->Html->image("ajaxConfig.gif"); ?>',
                               css:{width:"auto",padding:"20px"}
                           });
                            var url= $(this).attr('action');
                           $.ajax({
                               url:url,
                               type:"POST",
                               data:$(this).serialize(),
                               success:function(msg){
                                   if(msg!=false){
                                       $("#divModalEditTeacherAttendance").parent().unblock();
                                       $("#divModalEditTeacherAttendance").remove();
                                   }
                               },
                               error:function(msg){
                                   $("#divModalEditTeacherAttendance").parent().unblock();
                               }
                           });
                           return false;
                        });
                    }
                    $("#tblAttendance").unblock();
                },
                error:function(msg){
                    $("#tblAttendance").unblock();
                }
            });
            e.preventDefault();
        });
        
        /**
         *  Add Teacher's Attendance Report
         */
          
        $(".hrefAddTeacherAttendance").unbind();
        $(".hrefAddTeacherAttendance").live('click',function(e){
            var currentSelect=$(this);
            $("#tblAttendance").block({
                message:'<h3>Loading...</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>',
                css:{width:"auto",padding:"10px",marginTop:'180px'}
            });
            var attendanceDate=$(this).attr('forDate');
            $.ajax({
                url:"<?php echo $this->Html->url(array('controller'=>'teacherattendances','action'=>'add'));?>"+"/"+attendanceDate,
                cache:false,
                type:"GET",
                success:function(msg){
                    if(msg==false){
                        e.preventDefault();
                    }else{
                        var divModalAddTeacherAttendance=$('<div>');
                        divModalAddTeacherAttendance.attr({
                            id:'divModalAddTeacherAttendance',
                            title:'Add Teacher Attendance - '+attendanceDate
                        });
                        divModalAddTeacherAttendance.html(msg);
                        divModalAddTeacherAttendance.dialog({
                            modal:true,
                            width:'350',
                            resizable:false,
                            close:function(){
                                $("#divModalAddTeacherAttendance").remove();
                            }
                        });
                        $("#TeacherattendanceAddForm").unbind();
                        $("#TeacherattendanceAddForm").on('submit',function(){
                           $("#divModalAddTeacherAttendance").parent().block({
                               message:'<h3>Saving Attendance Data:</h3><?php echo $this->Html->image("ajaxConfig.gif"); ?>',
                               css:{width:"auto",padding:"20px"}
                           });
                           var url= $(this).attr('action');
                           $.ajax({
                               url:url,
                               type:"POST",
                               data:$(this).serialize(),
                               success:function(msg){
                                   if(msg!=false){
                                       // Do Something Here
                                       currentSelect.attr({
                                           id:"hrefEditTeacherAttendance"
                                       });
                                       currentSelect.html("<span class='green'>Report Present"+'<?php echo $this->Html->image('edit.png');?>'+"</span>");
                                       $("#divModalAddTeacherAttendance").parent().unblock();
                                       $("#divModalAddTeacherAttendance").remove();
                                   }
                               },
                               error:function(msg){
                                   $("#divModalAddTeacherAttendance").parent().unblock();
                               }
                           });
                           return false;
                        });
                    }
                    $("#tblAttendance").unblock();
                },
                error:function(msg){
                    $("#tblAttendance").unblock();
                }
            });
            e.preventDefault();
        });
        /*                              
         * Add/Edit Student Attendance
         */
        $(".hrefAddStudentAttendance,.hrefEditStudentAttendance").unbind();
        $(".hrefAddStudentAttendance,.hrefEditStudentAttendance").live('click',function(e){
            var parent=$(this).parent().parent();
            var currentSelect=$(this);
            $("#tblAttendance").block({
                message:'<h3>Loading...</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>',
                css:{width:"auto",padding:"10px",marginTop:'180px'}
            });
            var attendanceDate=$(this).parent().parent().find(".divStudentReport").attr("forDate");
            var standard_id=parent.find(".selSelectSTD").val();
            var section_id=parent.find(".selSelectSection").val();
            $.ajax({
                url:"<?php echo $this->Html->url(array('controller'=>'studentattendances','action'=>'add'));?>"+"/"+attendanceDate+"/"+standard_id+"/"+section_id,
                cache:false,
                type:"GET",
                success:function(msg){
                    if(msg=="false"){
                        var divModalAddStudentAttendance=$('<div>');
                        divModalAddStudentAttendance.attr({
                            id:'divModalAddStudentAttendance',
                            title:'Add Student Attendance - '+attendanceDate
                        });
                        divModalAddStudentAttendance.html("There are no students in this section");
                        divModalAddStudentAttendance.dialog({
                            modal:true,
                            width:'auto',
                            height:'auto',
                            resizable:false,
                            close:function(){
                                $("#divModalAddStudentAttendance").remove();
                            }
                        });
                        e.preventDefault();
                    }else{
                        /** SELECT STD AND SECTION **/
                        var divModalAddStudentAttendance=$('<div>');
                        divModalAddStudentAttendance.attr({
                            id:'divModalAddStudentAttendance',
                            title:'Add Student Attendance - '+attendanceDate
                        });
                        divModalAddStudentAttendance.html(msg);
                        divModalAddStudentAttendance.dialog({
                            modal:true,
                            width:'600',
                            resizable:false,
                            close:function(){
                                $("#divModalAddStudentAttendance").remove();
                            }
                        });
                        $("#StudentattendanceAddForm").on('submit',function(){
                           $("#divModalAddStudentAttendance").parent().block({
                               message:'<h3>Saving Attendance Data:</h3><?php echo $this->Html->image("ajaxConfig.gif"); ?>',
                               css:{width:"auto",padding:"20px"}
                           });
                            var url= $(this).attr('action');
                           $.ajax({
                               url:url,
                               type:"POST",
                               data:$(this).serialize(),
                               success:function(msg){
                                   if(msg!="false"){
                                       currentSelect.attr({
                                           id:"hrefEditStudentAttendance"
                                       });
                                       currentSelect.html("<span class='green'>Report Present"+'<?php echo $this->Html->image('edit.png');?>'+"</span>");
                                       $("#divModalAddStudentAttendance").parent().unblock();
                                       $("#divModalAddStudentAttendance").remove();
                                   }
                               },
                               error:function(msg){
                                   divModalAddStudentAttendance.parent().unblock();
                                   $("#divModalAddStudentAttendance").parent().unblock();
                               }
                           });
                           return false;
                        });
                    }
                    $("#tblAttendance").unblock();
                },
                error:function(msg){
                    $("#tblAttendance").unblock();
                }
            });
            e.preventDefault();
        });
        
        /**
        *   Table Pagination Ajax Working 
        */
        $("#tblAttendance a[href!='#']").live('click',function(e){
            var url=this;
            $("#tblAttendance").block({
                message:'<h3>Loading...</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>',
                css:{width:"auto",padding:"10px"}
            });
            $.ajax({
                url:url,
                cache:false,
                type:'GET',
                success:function(msg){
                    $("#tblAttendance").html($(msg).html());
                    $("#tblAttendsnce").unblock();
                },
                error:function(msg){
                    $("#tblAttendance").unblock();
                }
            });
            e.preventDefault();
        });
        /**
        *   On Change Of Standard and Section
        */
        $(".selSelectSTD").on('change',function(){
            var parent=$(this).parent().parent();
            parent.find(".selSelectSection").val("");
            parent.find('div[reportForDate*=]').html('<span style="font-size: 11px;color:#666">Select STD and Section</span>');
            if($(this).val()==""){
                parent.find(".selSelectSection").attr({'disabled':'disabled'})
                parent.find('div[reportForDate*=]').html('<span style="font-size: 11px;color:#666">Select STD and Section</span>');
                
            }else{
                parent.find(".selSelectSection").attr({'disabled':false});
            }
            
        });
        $(".selSelectSection").on('change',function(){
            var parent=$(this).parent().parent();
            if($(this).val()==""){
                parent.find('div[reportForDate*=]').html('<span style="font-size: 11px;color:#666">Select STD and Section</span>');
            }else{
                var attendanceDate=$(this).parent().attr("forDate");
                var sectionId=$(this).val();
                var standardId=parent.find(".selSelectSTD").val();
                parent.find('div[reportForDate*=]').html('<?php echo $this->Html->image('load.gif')?>');
                $.ajax({
                    url:"<?php echo $this->Html->url(array('controller'=>'attendances','action'=>'studentAttendanceStatus'));?>"+"/"+attendanceDate+"/"+standardId+"/"+sectionId,
                    cache:false,
                    type:"GET",
                    success:function(msg){
                        if(msg=='false'){
                            return false;
                        }else{
                            if(msg=="0"){
                                var report='<?php 
                                               echo $this->Html->link(
                                                       "<span class=\"red\">Report Not Present".$this->Html->image('add.png')."</span>",
                                                       "#",
                                                       array(
                                                           'escape'=>false,
                                                           'class'=>'hrefAddStudentAttendance',
                                                           'div'=>false
                                                       )
                                                   );
                                           ?>';
                                parent.find('div[reportForDate*=]').html(report);
                            }else{
                                var report='<?php 
                                               echo $this->Html->link(
                                                       "<span class=\"green\">Report Present".$this->Html->image('edit.png')."</span>",
                                                       "#",
                                                       array(
                                                           'escape'=>false,
                                                           'class'=>'hrefAddStudentAttendance',
                                                           'div'=>false
                                                       )
                                                   );
                                           ?>';
                                parent.find('div[reportForDate*=]').html(report);
                            }
                        }
                    }
                });
            }
            
        });
        
    });
</script>