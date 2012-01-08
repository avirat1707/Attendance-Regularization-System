<div id="divSchoolHome">
    <div id="divSchoolMonitor">
        <div id="divLogout">
            <?php echo $this->Html->image('logout.png'); ?>
            <?php echo $this->Html->link('Logout',array('controller'=>'schools','action'=>'logout'),array('id'=>'hrefLogout')); ?>
        </div>
        <ul>
            <li><a href="#Attendance-Reports">General Report</a></li>
            <li><a href="#Manage-Teacher">Teachers Report</a></li>
            <li><a href="#Manage-Student">Students Report</a></li>
        </ul>
        <div id="Attendance-Reports">
            <div id="divAttendanceReportsTable">                
                
            </div>
             <div id="divLoadAttendance"></div>
        </div>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $("#divSchoolMonitor").tabs();
            
            $("#divAttendanceReportsTable").block({
                        message:'<h3>Loading all attendance data:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>',
                        css:{width:"auto",padding:"10px"}
                    });
                    $.ajax({
                        url:"<?php echo $this->Html->url(array('controller'=>'attendances','action'=>'generalReport')); ?>",
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
        });        
    </script>
        <div id="Manage-Teacher">
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
                            url:"<?php echo $this->Html->url(array('controller'=>'Teacherattendances','action'=>'report')); ?>",
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
    </div>
</div>
