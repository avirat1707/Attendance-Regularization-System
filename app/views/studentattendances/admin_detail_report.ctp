<table class="commonTable">
    <thead>
        <tr>
            <th class="first">Block name</th>
            <th>School name</th>
            <th>Dise code</th>
            <th>Cluster</th>
            <th>Village</th>
            <th>Stundent Name</th>
            <th>Absent Day</th>
            <th class="last">Reason</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($detailReport as $key => $val) { ?>
        <tr>
            <td><?php ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo $val['S']['name']; ?></td>
            <td><?php echo date('d-m-Y',strtotime($val['SA']['attendancedate'])); ?></td>
            <td>
                <?php
                    if($val['SA']['reason_id'] == 2)
                       echo $val['SA']['reason']; 
                    else
                        echo $val['R']['name'];
                ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>