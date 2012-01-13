<div id="divSchoolHome">
    <div id="divSchoolMonitor">
        <div id="divLogout">
            <?php echo $this->Html->image('logout.png'); ?>
            <?php echo $this->Html->link('Logout',array('controller'=>'schools','action'=>'logout'),array('id'=>'hrefLogout')); ?>
        </div>
        <ul>
            <li><a href="#Attendance-Reports">Attendance Report</a></li>
            <li><a href="#Manage-Teacher">Manage Teachers</a></li>
            <li><a href="#Manage-Student">Manage Students</a></li>
        </ul>
        <div id="Attendance-Reports">
            <div id="divAttendanceReportsTable">
                <p>
                    <?php
                        echo $this->Html->link('Add Teacher Attendance','#',array('class'=>'jqueryuiButton','id'=>'btnAddTeacherAttendance'));
                        echo $this->Html->link('Add Student Attendance','#',array('class'=>'jqueryuiButton','id'=>'btnAddStudentAttendance','style'=>'margin-left:10px;'));
                    ?>
                </p>
                <div id="divLoadAttendance"></div>
            </div>
            <script type="text/javascript">
                $(document).ready(function(){
                    /**
                     * Loading Attendance Section
                     */
                    $("#divAttendanceReportsTable").block({
                        message:'<h3>Loading all attendance data:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>',
                        css:{width:"auto",padding:"10px"}
                    });
                    $.ajax({
                        url:"<?php echo $this->Html->url(array('controller'=>'attendances','action'=>'index')); ?>",
                        type:"GET",
                        cache:false,
                        success:function(msg){
                            $("#divLoadAttendance").html(msg);
                            $("#divAttendanceReportsTable").unblock();
                        },
                        error:function(){
                            $("#divAttendanceReportsTable").unblock();
                            $("#divAttendanceReportsTable").html('<div class="error-message">Loading Attendance data failed! Please Try again</div>');
                        }
                    });
                    
                    /**
                     * Add Teacher's Attendance
                     */
                    $("#btnAddTeacherAttendance").on('click',function(e){
                        var divAddTeacherAttendance=$("<div>");
                        divAddTeacherAttendance.attr({
                            'id':'divAddTeacherAttendance',
                            'title':'Add Teacher Attendance - Select Date'
                        });
                        divAddTeacherAttendance.html('<p><div class="input text"><label for="txtAddTAD">Attendance Date</label><input readonly="readonly" type="text" id="txtAddTAD" name="txtAddTAD" /></div></p><button id="btnContinue" class="jqueryuiButton">Continue</button></div>');
                        divAddTeacherAttendance.dialog({
                            modal:true,
                            width:'auto',
                            resizable:false,
                            close:function(){
                                $("#divAddTeacherAttendance").remove();
                            }
                        });
                        $("#txtAddTAD").datepicker({
                            dateFormat:"dd-mm-yy",
                            changeMonth:true,
                            changeYear:true
                        });
                        $(".jqueryuiButton").button();
                        $("#divAddTeacherAttendance").find('.jqueryuiButton').focus();
                        $("#divAddTeacherAttendance").find('#btnContinue').on('click',function(e){
                            if($("#txtAddTAD").val()==""){
                                $("#txtAddTAD").attr({
                                    'style':'outline:1px solid RED'
                                });
                                $("#txtAddTAD").focus();
                                e.preventDefault();
                            }else{
                                var attendanceDate=$("#txtAddTAD").val();
                                divAddTeacherAttendance.parent().block({
                                    message:'<h3>Saving Attendance Data:</h3><?php echo $this->Html->image("ajaxConfig.gif"); ?>',
                                    css:{width:"auto",padding:"20px"}
                                });
                                $.ajax({
                                    url:"<?php echo $this->Html->url(array('controller'=>'teacherattendances','action'=>'add'));?>"+"/"+attendanceDate,
                                    cache:false,
                                    type:"GET",
                                    success:function(msg){
                                        if(msg==false){
                                            e.preventDefault();
                                        }else{
                                            divAddTeacherAttendance.parent().unblock();
                                            divAddTeacherAttendance.attr({
                                                title:'Add Teacher Attendance - '+attendanceDate
                                            });
                                            divAddTeacherAttendance.html(msg);
                                            divAddTeacherAttendance.dialog({
                                                modal:true,
                                                width:'350',
                                                resizable:false,
                                                close:function(){
                                                    $("#divAddTeacherAttendance").remove();
                                                }
                                            });
                                            $("#TeacherattendanceAddForm").on('submit',function(){
                                               $("#divAddTeacherAttendance").parent().block({
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
                                                           $("#divAttendanceReportsTable").block({
                                                                message:'<h3>Loading all attendance data:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>',
                                                                css:{width:"auto",padding:"10px"}
                                                            });
                                                            $.ajax({
                                                                url:"<?php echo $this->Html->url(array('controller'=>'attendances','action'=>'index')); ?>",
                                                                type:"GET",
                                                                cache:false,
                                                                success:function(msg){
                                                                    $("#divLoadAttendance").html(msg);
                                                                    $("#divAttendanceReportsTable").unblock();
                                                                },
                                                                error:function(){
                                                                    $("#divAttendanceReportsTable").unblock();
                                                                    $("#divAttendanceReportsTable").html('<div class="error-message">Loading Attendance data failed! Please Try again</div>');
                                                                }
                                                            });
                                                           $("#divAddTeacherAttendance").parent().unblock();
                                                           $("#divAddTeacherAttendance").remove();
                                                       }
                                                   },
                                                   error:function(msg){
                                                       $("#divAddTeacherAttendance").parent().unblock();
                                                   }
                                               });
                                               return false;
                                            });
                                        }
                                        $("#divAddTeacherAttendance").parent().unblock();
                                    },
                                    error:function(msg){
                                        $("#divAddTeacherAttendance").parent().unblock();
                                    }
                                });
                            }
                        });
                        e.preventDefault();
                    });
                    
                    /**
                     *  Loading Students Add Data
                     */
                    $("#btnAddStudentAttendance").on('click',function(){
                        $("#Attendance-Reports").block();
                        $.ajax({
                            url:"<?php echo $this->Html->url(array('controller'=>'studentattendances','action'=>'selectClassSection')); ?>",
                            cache:false,
                            type:"GET",
                            success:function(msg){
                                var divAddStudentAttendance=$("<div>");
                                divAddStudentAttendance.attr({
                                    'id':"divAddStudentAttendance",
                                    'title':"Add Student Attendance"
                                });

                                divAddStudentAttendance.dialog({
                                    modal:true,
                                    width:'auto',
                                    resizable:false,
                                    close:function(){
                                        $("#divAddStudentAttendance").remove();
                                    }
                                });
                                $("#Attendance-Reports").unblock();
                                divAddStudentAttendance.html(msg);
                                $("#txtFrmStudentAttendanceDate").datepicker({
                                    dateFormat:"dd-mm-yy",
                                    changeMonth:true,
                                    changeYear:true
                                });
                                $("#btnSelectClassSectionContinue").on('click',function(e){
                                    if($("#txtFrmStudentAttendanceDate").val()==""){
                                        $("#txtFrmStudentAttendanceDate").attr({
                                           'style':'outline: 1px solid RED' 
                                        });
                                    }else{
                                        var attendanceDate=$("#txtFrmStudentAttendanceDate").val();
                                        var standard_id=$("#selFrmStudentStandard").val();
                                        var section_id=$("#selFrmStudentSection").val();
                                        $.ajax({
                                            url:"<?php echo $this->Html->url(array('controller'=>'studentattendances','action'=>'add'));?>"+"/"+attendanceDate+"/"+standard_id+"/"+section_id,
                                            cache:false,
                                            type:"GET",
                                            success:function(msg){
                                                if(msg=="false"){
                                                    divAddStudentAttendance.html("There are no students in this section");
                                                    divAddStudentAttendance.dialog({
                                                        modal:true,
                                                        width:'auto',
                                                        height:'auto',
                                                        resizable:false,
                                                        close:function(){
                                                            $("#divAddStudentAttendance").remove();
                                                        }
                                                    });
                                                    e.preventDefault();
                                                }else{
                                                    $("#divAddStudentAttendance").html(msg);
                                                    $("#StudentattendanceAddForm").unbind();
                                                    $("#StudentattendanceAddForm").on('submit',function(){
                                                       $("#divAddStudentAttendance").parent().block({
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
                                                                   $("#divAttendanceReportsTable").block({
                                                                        message:'<h3>Loading all attendance data:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>',
                                                                        css:{width:"auto",padding:"10px"}
                                                                    });
                                                                    $.ajax({
                                                                        url:"<?php echo $this->Html->url(array('controller'=>'attendances','action'=>'index')); ?>",
                                                                        type:"GET",
                                                                        cache:false,
                                                                        success:function(msg){
                                                                            $("#divLoadAttendance").html(msg);
                                                                            $("#divAttendanceReportsTable").unblock();
                                                                        },
                                                                        error:function(){
                                                                            $("#divAttendanceReportsTable").unblock();
                                                                            $("#divAttendanceReportsTable").html('<div class="error-message">Loading Attendance data failed! Please Try again</div>');
                                                                        }
                                                                    });
                                                                   $("#divAddStudentAttendance").parent().unblock();
                                                                   $("#divAddStudentAttendance").remove();
                                                               }
                                                           },
                                                           error:function(msg){
                                                               divModalAddStudentAttendance.parent().unblock();
                                                               $("#divAddStudentAttendance").parent().unblock();
                                                           }
                                                       });
                                                       return false;
                                                    });
                                                }
                                            },
                                            error:function(msg){
                                                
                                            }
                                        })
                                    }
                                    
                                });
                            },
                            error:function(){
                                $("#Attendance-Reports").unblock();
                            }
                        });
                    });
                });
                
            </script>
        </div>
        <div id="Manage-Teacher">
            <p>
                <?php
                    echo $this->Html->link('Add Teacher','#',array('class'=>'jqueryuiButton','id'=>'btnAddTeacher'));
                ?>
            </p>
            <p>
                <ul>
                    <li>Click the titles in table for sorting the data accordingly.</li>
                    <li>Click on the teacher's name to edit the teacher's details.</li>
                </ul>
            </p>
            <div id="divLoadTeachers"></div>
            <script type="text/javascript">
                $(document).ready(function(){
                    /**
                     * Loading Teacher's Section
                     */
                    $("#Manage-Teacher").block({
                        message:'<h3>Loading all teacher data:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
                    });
                    $.ajax({
                        url:"<?php echo $this->Html->url(array('controller'=>'teachers','action'=>'paginatedview')); ?>",
                        type:"GET",
                        cache:false,
                        success:function(msg){
                            $("#divLoadTeachers").html(msg);
                            $("#Manage-Teacher").unblock();
                        },
                        error:function(){
                            $("#Manage-Teacher").html('<div class="error-message">Loading teacher data failed! Please Try again</div>');
                        }
                    });
                });
                
            </script>
        </div>
        <div id="Manage-Student">
            <p>
                <?php
                    echo $this->Html->link('Add Student','#',array('class'=>'jqueryuiButton','id'=>'btnAddStudent'));
                ?>
            </p>
            <p>
                <ul>
                    <li>Click the titles in table for sorting the data accordingly.</li>
                    <li>Click on the student's name to edit the student's details.</li>
                </ul>
            </p>
            <div id="divLoadStudents"></div>
            <script type="text/javascript">
                $(document).ready(function(){
                    /**
                     * Loading Teacher's Section
                     */
                    $("#Manage-Student").block({
                        message:'<h3>Loading all students data:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
                    });
                    $.ajax({
                        url:"<?php echo $this->Html->url(array('controller'=>'students','action'=>'paginatedview')); ?>",
                        type:"GET",
                        cache:false,
                        success:function(msg){
                            $("#divLoadStudents").html(msg);
                            $("#Manage-Student").unblock();
                        },
                        error:function(){
                            $("#Manage-Student").html('<div class="error-message">Loading students data failed! Please Try again</div>');
                        }
                    });
                });
                
            </script>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#divSchoolMonitor").tabs();
            
            /**
             * Load Functionality for Teacher's Data
             */
            $("#btnAddTeacher").on('click',addTeacher);
            
            $('.tdTeacherName a').live('click',function(e){
                var teacherId=$(this).attr("id");
                teacherId=teacherId.split('-');
                teacherId=teacherId[1];
                editTeacher(teacherId);
                return false;
            });
            
            /**
             * Loading Functionality for Student's Data
             */
            $("#btnAddStudent").on('click',addStudent);
            
            $('.tdStudentName a').live('click',function(e){
                var studentId=$(this).attr("id");
                studentId=studentId.split('-');
                studentId=studentId[1];
                editStudent(studentId);
                return false;
            });
        });
        
        /*
        *   Functions for handling the Teacher's Portion
        */
       
       /**
        * When Add Teacher Button is clicked
        */
        function addTeacher(){
            var divManageTeacher=$("<div>");
            divManageTeacher.attr({
                'title':'Add New Teacher',
                'id':'divModalAddTeacher'
            });
            $("#Manage-Teacher").block({
                message:'<h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
            });
            $.ajax({
                url:"<?php echo $this->Html->url(array('controller'=>'teachers','action'=>'add')); ?>",
                cache:false,
                type:"GET",
                success:function(msg){
                    divManageTeacher.html(msg);
                    divManageTeacher.dialog({
                        modal:true,
                        width:'500',
                        resizable:false,
                        close:function(){
                            $("#divModalAddTeacher").remove();
                        }
                    });
                    $("#Manage-Teacher").unblock();
                },
                error:function(){
                    alert("Form Load Failed!");
                    $("#Manage-Teacher").unblock();
                }
            });
            return false;
        }
        /**
         * Function when A New Teacher is Added  - The Pagination list is also 
         * Reloaded
         */
        $('#TeacherAddForm').live('submit',function(){
            $("#divModalAddTeacher").block({
                message:'<h3>Saving Teacher\'s Data:</h3><?php echo $this->Html->image("ajaxConfig.gif"); ?>',
                css:{width:"auto",padding:"20px"}
            });
            var url= $(this).attr('action');
            $.ajax({
                url:url,
                type:'POST',
                cache:false,
                data:$(this).serialize(),
                success:function(msg){
                    if(msg=="true"){
                        $("#divModalAddTeacher").remove();
                        $("#Manage-Teacher").block({
                            message:'<h3>Loading new teacher\'s data:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
                        });
                        $.ajax({
                            url:"<?php echo $this->Html->url(array('controller'=>'teachers','action'=>'paginatedview')); ?>",
                            type:"GET",
                            cache:false,
                            success:function(msg){
                                $("#divLoadTeachers").html(msg);
                                $("#Manage-Teacher").unblock();
                            },
                            error:function(){
                                $("#Manage-Teacher").html('<div class="error-message">Loading teacher data failed! Please Try again</div>');
                            }
                        });
                    }else{
                        $("#divModalAddTeacher").html(msg);
                    }
                    $("#divModalAddTeacher").unblock();

                },
                error:function(){
                    $("#divModalAddTeacher").unblock();
                }
            });
            return false;
        });
        
        
        /**
        * When Add Teacher Button is clicked
        */
        function editTeacher(teacherId){
            var divManageTeacher=$("<div>");
            divManageTeacher.attr({
                'title':'Add New Teacher',
                'id':'divModalEditTeacher'
            });
            $("#Manage-Teacher").block({
                message:'<h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
            });
            $.ajax({
                url:"<?php echo $this->Html->url(array('controller'=>'teachers','action'=>'edit')); ?>"+"/"+teacherId,
                cache:false,
                type:"GET",
                success:function(msg){
                    divManageTeacher.html(msg);
                    divManageTeacher.dialog({
                        modal:true,
                        width:'500',
                        resizable:false,
                        close:function(){
                            $("#divModalEditTeacher").remove();
                        }
                    });
                    $("#Manage-Teacher").unblock();
                },
                error:function(){
                    alert("Form Load Failed!");
                    $("#Manage-Teacher").unblock();
                }
            });
            return false;
        }
        /**
         * Function when A Teacher is Edited  - Also The Pagination list is also 
         * Reloaded
         */
        $('#TeacherEditForm').live('submit',function(){
            $("#divModalEditTeacher").block({
                message:'<h3>Editing Teacher\'s Data:</h3><?php echo $this->Html->image("ajaxConfig.gif"); ?>',
                css:{width:"auto",padding:"20px"}
            });
            var url= $(this).attr('action');
            $.ajax({
                url:url,
                type:'POST',
                cache:false,
                data:$(this).serialize(),
                success:function(msg){
                    if(msg=="true"){
                        $("#divModalEditTeacher").remove();
                        $("#Manage-Teacher").block({
                            message:'<h3>Loading new teacher\'s data:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
                        });
                        $.ajax({
                            url:"<?php echo $this->Html->url(array('controller'=>'teachers','action'=>'paginatedview')); ?>",
                            type:"GET",
                            cache:false,
                            success:function(msg){
                                $("#divLoadTeachers").html(msg);
                                $("#Manage-Teacher").unblock();
                            },
                            error:function(){
                                $("#Manage-Teacher").html('<div class="error-message">Loading teacher data failed! Please Try again</div>');
                            }
                        });
                    }else{
                        $("#divModalEditTeacher").html(msg);
                    }
                    $("#divModalEditTeacher").unblock();

                },
                error:function(){
                    $("#divModalEditTeacher").unblock();
                }
            });
            return false;
        });
        
        /*
        *  When Add Student Button is clicked
        */
        function addStudent(){
            var divManageStudent=$("<div>");
            divManageStudent.attr({
                'title':'Add New Student',
                'id':'divModalAddStudent'
            });
            $("#Manage-Student").block({
                message:'<h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
            });
            $.ajax({
                url:"<?php echo $this->Html->url(array('controller'=>'students','action'=>'add')); ?>",
                cache:false,
                type:"GET",
                success:function(msg){
                    divManageStudent.html(msg);
                    divManageStudent.dialog({
                        modal:true,
                        width:'500',
                        resizable:false,
                        close:function(){
                            $("#divModalAddStudent").remove();
                        }
                    });
                    $("#Manage-Student").unblock();
                },
                error:function(){
                    alert("Form Load Failed!");
                    $("#Manage-Student").unblock();
                }
            });
            return false;
        }
        /**
         * Function when A New Student Form is Submitted  - The Pagination list is also 
         * Reloaded
         */
        $('#StudentAddForm').live('submit',function(){
            $("#divModalAddStudent").block({
                message:'<h3>Saving Student\'s Data:</h3><?php echo $this->Html->image("ajaxConfig.gif"); ?>',
                css:{width:"auto",padding:"20px"}
            });
            var url= $(this).attr('action');
            $.ajax({
                url:url,
                type:'POST',
                cache:false,
                data:$(this).serialize(),
                success:function(msg){
                    if(msg=="true"){
                        $("#divModalAddStudent").remove();
                        $("#Manage-Student").block({
                            message:'<h3>Loading new student\'s data:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
                        });
                        $.ajax({
                            url:"<?php echo $this->Html->url(array('controller'=>'students','action'=>'paginatedview')); ?>",
                            type:"GET",
                            cache:false,
                            success:function(msg){
                                $("#divLoadStudents").html(msg);
                                $("#Manage-Student").unblock();
                            },
                            error:function(){
                                $("#Manage-Student").html('<div class="error-message">Loading Students data failed! Please Try again</div>');
                            }
                        });
                    }else{
                        $("#divModalAddStudent").html(msg);
                    }
                    $("#divModalAddStudent").unblock();

                },
                error:function(){
                    $("#divModalAddStudent").unblock();
                }
            });
            return false;
        });
        /**
        * When Student-Name is clicked
        */
        function editStudent(studentId){
            var divManageStudent=$("<div>");
            divManageStudent.attr({
                'title':'Add New Student',
                'id':'divModalEditStudent'
            });
            $("#Manage-Student").block({
                message:'<h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
            });
            $.ajax({
                url:"<?php echo $this->Html->url(array('controller'=>'students','action'=>'edit')); ?>"+"/"+studentId,
                cache:false,
                type:"GET",
                success:function(msg){
                    divManageStudent.html(msg);
                    divManageStudent.dialog({
                        modal:true,
                        width:'500',
                        resizable:false,
                        close:function(){
                            $("#divModalEditStudent").remove();
                        }
                    });
                    $("#Manage-Student").unblock();
                },
                error:function(){
                    alert("Form Load Failed!");
                    $("#Manage-Student").unblock();
                }
            });
            return false;
        }
        /**
         * Function when A Student is Edited  - Also The Pagination list is also 
         * Reloaded
         */
        $('#StudentEditForm').live('submit',function(){
            $("#divModalEditStudent").block({
                message:'<h3>Editing Student\'s Data:</h3><?php echo $this->Html->image("ajaxConfig.gif"); ?>',
                css:{width:"auto",padding:"20px"}
            });
            var url= $(this).attr('action');
            $.ajax({
                url:url,
                type:'POST',
                cache:false,
                data:$(this).serialize(),
                success:function(msg){
                    if(msg=="true"){
                        $("#divModalEditStudent").remove();
                        $("#Manage-Student").block({
                            message:'<h3>Loading new student\'s data:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
                        });
                        $.ajax({
                            url:"<?php echo $this->Html->url(array('controller'=>'students','action'=>'paginatedview')); ?>",
                            type:"GET",
                            cache:false,
                            success:function(msg){
                                $("#divLoadStudents").html(msg);
                                $("#Manage-Student").unblock();
                            },
                            error:function(){
                                $("#Manage-Student").html('<div class="error-message">Loading student data failed! Please Try again</div>');
                            }
                        });
                    }else{
                        $("#divModalEditStudent").html(msg);
                    }
                    $("#divModalEditStudent").unblock();

                },
                error:function(){
                    $("#divModalEditStudent").unblock();
                }
            });
            return false;
        });
    </script>
</div>
