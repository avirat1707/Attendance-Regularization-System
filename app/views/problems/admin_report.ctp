<?php echo $this->Form->create('Problem'); ?>
<table cellpadding="0" cellspacing="2" border="1">
    <thead>
    <th>#</th>
    <th>Block name</th>
    <th>Diescode</th>
    <th>School name</th>    
    <th>Village</th>
    <th>Problem</th>
    <th>
        <?php 
            echo $this->Form->input('problem_type',array('type'=>'select', 'options'=>array('all'=>'All','block'=>'Block','district'=>'District'), 'label'=>'Level','default'=>'all','onchange'=>'document.forms[0].submit();'));
        ?>
        
    </th>
    <th>Date</th>    
    </thead>
<?php if(!empty($this->data['list'])){ 
    foreach($this->data['list'] as $key => $val) { ?>
    <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $val['School']['Block']['name'] ?></td>
        <td><?php echo $val['School']['disecode'] ?></td>
        <td><?php echo $val['School']['name'] ?></td>        
        <td><?php echo $val['School']['Village']['name'] ?></td>        
        <td><?php echo $val['Problem']['name']; ?></td>
        <td><?php echo $val['Problem']['problem_type']; ?></td>
        <td><?php echo date('d-m-Y',strtotime($val['Problem']['date'])); ?></td>        
    </tr>    
    <?php
         
    } ?>

<?php    
 
    }else {
        echo '<tr><td align="center" colspan="8"><font color="red">No records found.</font></td></tr>';
    }
echo $this->Form->end();
?>
</table>