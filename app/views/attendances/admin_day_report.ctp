<table class="commonTable">
    <thead>
        <tr>
            <th rowspan="2" class="first" style="width:75px;">Block Name</th>
            <th rowspan="2">School Name</th>
            <th rowspan="2">Dise Code</th>
            <th rowspan="2">Cluster</th>
            <th rowspan="2">Village</th>
            <th colspan="3" align="center">Teachers</th>
            <th colspan="3" align="center">Student total all std</th>
            <th rowspan="2">Other Activity</th>
        </tr>
        <tr>
            <th>present</th>
            <th>absent</th>
            <th>total</th>
            <th>present</th>
            <th>absent</th>
            <th>total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($allSchools as $key => $val) { ?>
        <tr>
            <td><?php echo $val['Block']['name']; ?></td>
            <td><?php echo $val['School']['name']; ?></td>
            <td><?php echo $val['School']['disecode']; ?></td>
            <td><?php echo $val['Cluster']['name']; ?></td>
            <td><?php echo $val['Village']['name']; ?></td>
            <td><?php echo $val['Teacher']['totalPresent']; ?></td>
            <td><?php echo $val['Teacher']['totalAbsent']; ?></td>
            <td><?php echo $val['Teacher']['totalPresent'] + $val['Teacher']['totalAbsent']; ?></td>            
            <td><?php echo $val['Student']['totalPresent']; ?></td>
            <td><?php echo $val['Student']['totalAbsent']; ?></td>
            <td><?php echo $val['Student']['totalPresent'] + $val['Student']['totalAbsent']; ?></td>
            <td>Other Activity</td>
        </tr>
        <?php } ?>
    </tbody>
</table>



