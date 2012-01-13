<table id="tblGeneralReport" class="commonTable">
    <thead>
        <tr>
            <th rowspan="2" class="first">Block Name</th>
            <th rowspan="2">School Name</th>
            <th rowspan="2">Dise Code</th>
            <th rowspan="2">Cluster</th>
            <th rowspan="2">Village</th>
            <th colspan="3" align="center">Teachers</th>
            <th colspan="8" align="center">Enrollment</th>
            <th rowspan="2" class="last">total</th>
        </tr>
        <tr>
            <th>M</th>
            <th>F</th>
            <th>Total</th>
            <th>S-1</th>
            <th>S-2</th>
            <th>S-3</th>
            <th>S-4</th>
            <th>S-5</th>
            <th>S-6</th>
            <th>S-7</th>
            <th>S-8</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($allSchools as $key => $val) { ?>
            <tr>
            <td><?php echo $val['Block']['name']; ?></td>
            <td><?php echo $val['School']['name']; ?></td>
            <td><?php echo $val['School']['disecode']; ?></td>
            <td><?php echo $val['Cluster']['name']; ?></td>
            <td><?php echo $val['Village']['name']; ?></td>
            <td><?php echo $val['maleTeacherCount']; ?></td>
            <td><?php echo $val['femaleTeacherCount']; ?></td>
            <td><?php echo ($val['maleTeacherCount'] + $val['femaleTeacherCount']); ?></td>
            <?php 
                $total = 0;
                for($i =1 ; $i <= 8; $i++) {
                    echo '<td>';
                  foreach($val['studentCount'] as $k => $v) { 
                      if(isset($v['Student']['standard_id'])) {
                          if($v['Student']['standard_id'] == $i) {
                            echo $v[0]['count'];  
                            $total += $v[0]['count'];
                            break;
                          }else
                             echo 0;   
                      }  
                    }
                    echo '</td>';
                }
            ?>
            <td align="center"><?php echo $total; ?></td>    
            </tr>
            <?php } 
        ?>
    </tbody>
</table>