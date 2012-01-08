<table cellpadding="0" cellspacing="2" border="1">
    <tr>
            <td>block name</td>
            <td>school name</td>
            <td>dise code</td>
            <td>cluster</td>
            <td>village</td>
            <td>total teachers</td>
            <td align="center">Absent
                <br>
                <table>
                    <tr>
                        <td width="33%" align="center">1 to 10 days</td>
                        <td width="33%" align="center">11 to 20 days</td>
                        <td width="33%" align="center">21 to 30 days</td>
                    </tr>
                </table>
            </td>
            <td align="center">total absent teachers</td>
    </tr>
    <?php foreach($allSchools as $key => $val) {  ?>
    <tr>
        <td></td>
        <td><?php echo $val['School']['name']; ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td align="center"><?php echo $val['totalTeachers']; ?></td>
        <td>
            <table width="100%">
                <tr>
                    <td width="33%" align="center"><?php echo $val['10days']; ?></td>
                    <td width="33%" align="center"><?php echo $val['20days']; ?></td>
                    <td width="33%" align="center"><?php echo $val['30days']; ?></td>
                </tr>
            </table>
        </td>
        <td align="center"><?php echo ($val['10days'] + $val['20days'] + $val['30days']); ?></td>
        
    </tr>
    <?php } ?>
</table>
<?php pr($allSchools); ?>