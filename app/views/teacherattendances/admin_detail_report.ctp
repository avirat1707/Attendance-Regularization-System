<table class="commonTable">
    <thead>
        <tr>
            <th class="first">Block name</th>
            <th>School name</th>
            <th>Dise code</th>
            <th>Cluster</th>
            <th>Village</th>
            <th>Teachers name</th>
            <th>Absent day</th>
            <th class="last">Reason</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($detailReport as $key => $val) { ?>
        <tr>
            <td><?php echo $schoolDetail['Block']['name']; ?></td>
            <td><?php echo $schoolDetail['School']['name']; ?></td>
            <td><?php echo $schoolDetail['School']['disecode']; ?></td>
            <td><?php echo $schoolDetail['Cluster']['name']; ?></td>
            <td><?php echo $schoolDetail['Village']['name']; ?></td>
            <td><?php echo $val['T']['name']; ?></td>
            <td><?php echo date('d-m-Y',strtotime($val['TA']['attendancedate'])); ?></td>
            <td><?php
                    if($val['TA']['reason_id'] == 2)
                           echo $val['TA']['reason']; 
                    else
                            echo $val['R']['name'];
            ?></td>
        </tr>
        <?php } ?>
    </tbody>
    
</table>
