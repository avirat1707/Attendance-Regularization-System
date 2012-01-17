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
            <li><a href="#Daily-Report">Daily Report</a></li>
            <li><a href="#Left-Report">Left Report</a></li>
            <li><a href="#Manage-School">Manage Schools</a></li>
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
        <div id="divLoadStudents"></div>
            <script type="text/javascript">
                $(document).ready(function(){
                    /**
                     * Loading Teacher's Section
                     */
                    $("#Student-Report").block({
                        message:'<h3>Loading all teacher data:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
                    });
                    $.ajax({
                        url:"<?php echo $this->Html->url(array('controller'=>'Studentattendances','action'=>'studentReport')); ?>",
                        type:"GET",
                        cache:false,
                        success:function(msg){
                            $("#divLoadStudents").html(msg);
                            $("#Student-Report").unblock();
                        },
                        error:function(){
                            $("#Student-Report").html('<div class="error-message">Loading teacher data failed! Please Try again</div>');
                        }
                    });
                });

            </script>
        </div>
        <div id="Daily-Report">
            <div id="divLoadDailyReport"></div>
            <script type="text/javascript">
                $(document).ready(function(){
                    /**
                     * Loading Teacher's Section
                     */
                    $("#Daily-Report").block({
                        message:'<h3>Loading today\'s daily report:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
                    });
                    $.ajax({
                        url:"<?php echo $this->Html->url(array('controller'=>'attendances','action'=>'dayReport')); ?>",
                        type:"GET",
                        cache:false,
                        success:function(msg){
                            $("#divLoadDailyReport").html(msg);
                            $("#Daily-Report").unblock();
                        },
                        error:function(){
                            $("#Daily-Report").html('<div class="error-message">Loading daily report failed! Please Try again</div>');
                        }
                    });
                });

            </script>
        </div>
        <div id="Left-Report">
            <div id="divLoadStudentLeft"></div>
            <script type="text/javascript">
                $(document).ready(function(){
                    /**
                     * Loading Teacher's Section
                     */
                    $("#Left-Report").block({
                        message:'<h3>Loading report:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
                    });
                    $.ajax({
                        url:"<?php echo $this->Html->url(array('controller'=>'students','action'=>'studentLeft')); ?>",
                        type:"GET",
                        cache:false,
                        success:function(msg){
                            $("#divLoadStudentLeft").html(msg);
                            $("#Left-Report").unblock();
                        },
                        error:function(){
                            $("#Left-Report").html('<div class="error-message">Loading report failed! Please Try again</div>');
                        }
                    });
                });

            </script>
        </div>
        <div id="Manage-School">
            <div id="divManageSchoolTable">
                <p>
                    <?php
                        echo $this->Html->link('Add School','#',array('class'=>'jqueryuiButton','id'=>'btnAddSchool'));
                    ?>
                </p>
                <div id="divLoadSchool"></div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        /**
                         * Loading Schools's Section
                         */
                        $("#Manage-School").block({
                            message:'<h3>Loading School:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
                        });
                        $.ajax({
                            url:"<?php echo $this->Html->url(array('prefix'=>'admin','controller'=>'Schools','action'=>'admin_paginatedview')); ?>",
                            type:"GET",
                            cache:false,
                            success:function(msg){
                                $("#divLoadSchool").html(msg);
                                $("#Manage-School").unblock();
                            },
                            error:function(){
                                $("#Manage-School").html('<div class="error-message">Loading schools failed! Please try again</div>');
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#btnAddSchool").on('click',addSchool);
    });
    function addSchool(){
        var divManageSchool=$("<div>");
        divManageSchool.attr({
            'title':'Add New School',
            'id':'divModalAddSchool'
        });
        $("#Manage-School").block({
            message:'<h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
        });
        $.ajax({
            url:"<?php echo $this->Html->url(array('prefix'=>'admin','controller'=>'schools','action'=>'admin_add')); ?>",
            cache:false,
            type:"GET",
            success:function(msg){
                divManageSchool.html(msg);
                divManageSchool.dialog({
                    modal:true,
                    width:'500',
                    resizable:false,
                    close:function(){
                        $("#divModalAddSchool").remove();
                    }
                });
                $("#SchoolAdminAddForm").on('submit',function(){
                    
                });
                $("#Manage-School").unblock();
            },
            error:function(){
                alert("Form Load Failed!");
                $("#Manage-School").unblock();
            }
        });
        return false;
    }
</script>
    
