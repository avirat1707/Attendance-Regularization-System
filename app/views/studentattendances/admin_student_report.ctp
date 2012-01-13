<table class="commonTable">
    <thead>
        <tr>
            <th class="first" rowspan="2" style="width:75px">Block Name</th>
            <th rowspan="2">School Name</th>
            <th rowspan="2">Dise code</th>
            <th rowspan="2">Cluster</th>
            <th rowspan="2">Village</th>
            <th rowspan="2">Total Students</th>
            <th colspan="3" align="center">Absent</th>
            <th class="last" rowspan="2">Total Absent Students</th>
        </tr>
        <tr>
            <th>1 to 10 Days</th>
            <th>11 to 20 Days</th>
            <th>21 to 30 Days</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($allSchools as $key => $val) {  ?>
        <tr>
            <td><?php echo $val['Block']['name']; ?></td>
            <td><?php echo $val['School']['name']; ?></td>
            <td><?php echo $val['School']['disecode']; ?></td>
            <td><?php echo $val['Cluster']['name']; ?></td>
            <td><?php echo $val['Village']['name']; ?></td>
            <td><?php echo $val['totalStudents']; ?></td>
            <td schoolId="<?php echo $val['School']['id']; ?>" days="10" class="studentDetailedReport"><?php echo $val['10days']; ?></td>
            <td schoolId="<?php echo $val['School']['id']; ?>" days="20" class="studentDetailedReport"><?php echo $val['20days']; ?></td>
            <td schoolId="<?php echo $val['School']['id']; ?>" days="30" class="studentDetailedReport"><?php echo $val['30days']; ?></td>
            <td><?php echo ($val['10days'] + $val['20days'] + $val['30days']); ?></td>

        </tr>
        <?php } ?>
    </tbody>
</table>
<script language="javascript">
    $(document).ready(function(){
        $(".studentDetailedReport").on("click",function(){
            if($(this).text()=="0"){
                return false;
            }
            var days=$(this).attr("days");
            var schoolId=$(this).attr("schoolId");
            var parentTable=$(this).parent().parent().parent();
            parentTable.block({
                message:'<h3>Loading teacher report:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
            });
            $.ajax({
                url:"<?php echo $this->Html->url(array('controller'=>'Studentattendances','action'=>'detailReport')); ?>/"+schoolId+"/"+days,
                type:"GET",
                cache:false,
                success:function(msg){
                    var divAdminStudentReport=$("<div>");
                    divAdminStudentReport.attr({
                        'title':'Student Detailed Report -'+days+' days',
                        'id':'divAdminStudentReport'
                    });
                    divAdminStudentReport.html(msg);
                    divAdminStudentReport.dialog({
                        modal:true,
                        width:'800',
                        resizable:false,
                        close:function(){
                            $("#divAdminStudentReport").remove();
                        }
                    });
                    parentTable.unblock();
                },
                error:function(){
                    parentTable.html('<div class="error-message">Loading teacher report failed! Please try again</div>');
                }
            });
        });
    });
</script>