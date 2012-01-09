<div id="divSchoolHome">
    <div id="divReportMonitor">
        <div id="divLogout">
            <?php echo $this->Html->image('logout.png'); ?>
            <?php echo $this->Html->link('Logout',array('controller'=>'schools','action'=>'logout'),array('id'=>'hrefLogout')); ?>
        </div>
        <ul>
            <li><a href="#General-Report">General Report</a></li>
            <li><a href="#Teacher-Report">Teachers Report</a></li>
            <li><a href="#Student-Report">Students Report</a></li>
        </ul>
        <div id="General-Report">
            <div id="divLoadGeneralReport"></div>
        </div>
    
        <script type="text/javascript">
            $(document).ready(function(){
                $("#divReportMonitor").tabs();

                $("#General-Report").block({
                            message:'<h3>Loading general report:</h3><h4>Please wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>',
                            css:{width:"auto",padding:"10px"}
                        });
                        $.ajax({
                            url:"<?php echo $this->Html->url(array('controller'=>'attendances','action'=>'generalReport')); ?>",
                            type:"GET",
                            cache:false,
                            success:function(msg){
                                $("#divLoadGeneralReport").html(msg);
                                $("#General-Report").unblock();
                            },
                            error:function(){
                                $("#General-Report").unblock();
                                $("#divLoadGeneralReport").html('<div class="error-message">Loading general report failed! Please try again</div>');
                            }
                        });
            });        
        </script>
        <div id="Teacher-Report">
            <div id="divLoadTeacherReport"></div>
            <script type="text/javascript">
                $(document).ready(function(){
                    /**
                     * Loading Teacher's Section
                     */
                    $("#Teacher-Report").block({
                        message:'<h3>Loading teacher report:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
                    });
                    $.ajax({
                        url:"<?php echo $this->Html->url(array('controller'=>'Teacherattendances','action'=>'report')); ?>",
                        type:"GET",
                        cache:false,
                        success:function(msg){
                            $("#divLoadTeacherReport").html(msg);
                            $("#Teacher-Report").unblock();
                        },
                        error:function(){
                            $("#Teacher-Report").html('<div class="error-message">Loading teacher report failed! Please try again</div>');
                        }
                    });
                });
            </script>
        </div>
        <div id="Student-Report">
            <div id="divLoadStudentReport"></div>
            <script type="text/javascript">
                $(document).ready(function(){
                    /**
                     * Loading Teacher's Section
                     */
                    $("#Student-Report").block({
                        message:'<h3>Loading student report:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
                    });
                    /*$.ajax({
                        url:"<?php //echo $this->Html->url(array('controller'=>'Teacherattendances','action'=>'report')); ?>",
                        type:"GET",
                        cache:false,
                        success:function(msg){
                            $("#divLoadTeacherReport").html(msg);
                            $("#Teacher-Report").unblock();
                        },
                        error:function(){
                            $("#Teacher-Report").html('<div class="error-message">Loading teacher report failed! Please try again</div>');
                        }
                    });
                    */
                });
            </script>
        </div>
    </div>
</div>
