<table class="commonTable">
    <thead>
        <tr>
            <th class="first">Block name</th>
            <th>School Name</th>
            <th>Dise Code</th>
            <th>Cluster</th>
            <th>Village</th>        
            <th align="center">Reduction Student Name</th>
            <th>Std</th>
            <th class="last">Left Reason</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($allSchools as $key => $val) {
                    foreach($val['students'] as $k => $v) {
            ?>
        <tr>
            <td><?php echo $val['Block']['name']; ?></td>
            <td><?php echo $val['School']['name']; ?></td>
            <td><?php echo $val['School']['disecode']; ?></td>
            <td><?php echo $val['Cluster']['name']; ?></td>
            <td><?php echo $val['Village']['name']; ?></td>
            <td><?php echo $v['ST']['name']; ?></td>
            <td><?php echo $v['ST']['standard_id']; ?></td>
            <td><?php echo $v['ST']['inactivereason']; ?></td>
        </tr>
        <?php } } ?>
    </tbody>
</table>