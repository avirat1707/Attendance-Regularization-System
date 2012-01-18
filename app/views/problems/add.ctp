<?php echo $this->element('problems/add'); ?>
<?php 
    if(!empty($this->data['list'])){
 ?>
<table cellpadding="0" cellspacing="2" border="1">
    <thead>
    <th>#</th>
    <th>Date</th>
    <th>Name</th>
    <th>Description</th>
    </thead>
    <?php foreach($this->data['list'] as $key => $val) { ?>
    <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo date('d-m-Y',strtotime($val['Problem']['date'])); ?></td>
        <td><?php echo $val['Problem']['name']; ?></td>
        <td><?php echo $val['Problem']['description']; ?></td>
    </tr>    
    <?php } ?>
</table>
<?php        
    }
?>