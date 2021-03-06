<table class="commonTable">
    <thead>
        <tr>
            <th rowspan="2" class="first" style="width:75px">Block name</th>
            <th rowspan="2">School name</th>
            <th rowspan="2">Dise code</th>
            <th rowspan="2">Cluster</th>
            <th rowspan="2">Village</th>
            <th rowspan="2">Total teachers</th>
            <th colspan="3">Absent</th>
            <th rowspan="2" class="last">Total absent teachers</th>
        </tr>
        <tr>
            <th>1 to 10 days</th>
            <th>11 to 20 days</th>
            <th>21 to 30 days</th>
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
            <td><?php echo $val['totalTeachers']; ?></td>    
            <td schoolId="<?php echo $val['School']['id']; ?>" days="10" class="teacherDetailedReport"><?php echo $val['10days']; ?></td>
            <td schoolId="<?php echo $val['School']['id']; ?>" days="20" class="teacherDetailedReport"><?php echo $val['20days']; ?></td>
            <td schoolId="<?php echo $val['School']['id']; ?>" days="30" class="teacherDetailedReport"><?php echo $val['30days']; ?></td>
            <td><?php echo ($val['10days'] + $val['20days'] + $val['30days']); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<script language="javascript">
    $(document).ready(function(){
        $(".teacherDetailedReport").on("click",function(){
            if($(this).text()=="0"){
                return false;
            }
            var days=$(this).attr("days");
            var schoolId=$(this).attr("schoolId");
            var parentTable=$(this).parent().parent().parent();
            parentTable.block({
                message:'<h3>Loading Teacher\'s Daily Report:</h3><h4>Please Wait...</h4><?php echo $this->Html->image("ajaxLoad.gif"); ?>'
            });
            $.ajax({
                url:"<?php echo $this->Html->url(array('controller'=>'Teacherattendances','action'=>'detailReport')); ?>/"+schoolId+"/"+days,
                type:"GET",
                cache:false,
                success:function(msg){
                    var divAdminTeacherReport=$("<div>");
                    divAdminTeacherReport.attr({
                        'title':'Teacher Detailed Report -'+days+' days',
                        'id':'divAdminTeacherReport'
                    });
                    divAdminTeacherReport.html(msg);
                    divAdminTeacherReport.dialog({
                        modal:true,
                        width:'800',
                        resizable:false,
                        close:function(){
                            $("#divAdminTeacherReport").remove();
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