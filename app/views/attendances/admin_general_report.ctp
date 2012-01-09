<table id="tblGeneralReport">
    <thead>
        <tr>
            <th>Block Name</th>
            <th>School Name</th>
            <th>Dise Code</th>
            <th>Cluster</th>
            <th>Village</th>
            <th>Category</th>
            <th align="center">Teachers
                <br />
                <table>
                    <tr>
                        <td width="33%">Male</td>
                        <td width="33%">Female</td>
                        <td width="33%">Total</td>

                    </tr>
                </table>
            </th>
            <th align="center">Entolment
                <br />
                <table>
                    <tr>
                        <td  width="12%">Std -1</td>
                        <td  width="12%">Std -2</td>
                        <td  width="12%">Std -3</td>
                        <td  width="12%">Std -4</td>
                        <td  width="12%">Std -5</td>
                        <td  width="12%">Std -6</td>
                        <td  width="12%">Std -7</td>
                        <td  width="12%">Std -8</td>
                    </tr>
                </table>
            </th>
            <th>total</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($allSchools as $key => $val) { ?>
            <tr>
            <td><?php echo $val['Block']['name']; ?></td>
            <td><?php echo $val['School']['name']; ?></td>
            <td></td>
            <td><?php echo $val['Cluster']['name']; ?></td>
            <td><?php echo $val['Village']['name']; ?></td>
            <td></td>
            <td aling="center">
                <table width="100%">
                    <tr>
                        <td width="33%" align="center"><?php echo $val['maleTeacherCount']; ?></td>
                        <td width="33%" align="center"><?php echo $val['femaleTeacherCount']; ?></td>
                        <td width="33%" align="center"><?php echo ($val['maleTeacherCount'] + $val['femaleTeacherCount']); ?></td>
                    </tr>
                </table>    
            </td>
            <td align="center">
                <table width="100%">
                    <tr>
                       <?php 
                       $total = 0;
                        for($i =1 ; $i <= 8; $i++) {
                            echo '<td width="12%" align="center">';
                          foreach($val['studentCount'] as $k => $v) { 
                              if(isset($v['students']['standard_id'])) {
                                  if($v['students']['standard_id'] == $i) {
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
                    </tr>
                </table>
            </td>
            <td align="center"><?php echo $total; ?></td>    
            </tr>
            <?php } 
        ?>
    </tbody>
</table>