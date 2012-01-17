<table id="tblManageSchool" class="commonTable">
    <thead>
        <tr>
            <th class="thSchoolName first"><?php echo $this->Paginator->sort('Name','School.name')?></th>
            <th class="thSchoolBlockName"><?php echo $this->Paginator->sort('Block','Block.name')?></th>
            <th class="thSchoolClusterName"><?php echo $this->Paginator->sort('Cluster','Cluster.name')?></th>
            <th class="thSchoolDiseCode"><?php echo $this->Paginator->sort('Dise Code','School.disecode')?></th>
            <th class="thSchoolStatus last"><?php echo $this->Paginator->sort('Status','School.status')?></th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(!isset($schoolData) || empty($schoolData)){
                ?>
                    <tr>
                        <td colspan="10" align="center">No Schools Found!</td>
                    </tr>
                <?php
            }else{
                foreach($schoolData as $school):
                    if($school['School']['status']=='1'){
                        $schoolStatus='Active';
                        $schoolStatusClass='green';
                    }else{
                        $schoolStatus="Inactive";
                        $schoolStatusClass='red';
                    }
                    ?>
                        <tr>
                            <td class="tdSchoolName" title="<?php echo $school['School']['name']; ?>"><?php echo $this->Html->link($this->Html->image('edit.png').$this->Text->truncate($school['School']['name'],40),"#",array('id'=>'hrefSchool-'.$school['School']['id'],'escape'=>false)); ?></td>
                            <td class="tdSchoolBlockName" title="<?php echo $school['Block']['name']; ?>"><?php echo $school['Block']['name']; ?></td>
                            <td class="tdSchoolClusterName" title="<?php echo $school['Cluster']['name']; ?>"><?php echo $school['Cluster']['name']; ?></td>
                            <td class="tdDiseCode" title="<?php echo $school['School']['disecode']; ?>"><?php echo $this->Text->truncate($school['School']['disecode'],15); ?></td>
                            <td class="tdStatus" title="<?php echo $schoolStatus; ?>"><?php echo $schoolStatus; ?></td>
                        </tr>
                    <?php
                endforeach;
                ?>
                    <tr>
                        <td colspan="12" style="text-align: center;border:0;">
                            <?php echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled')); ?>
                            <?php echo "&nbsp;&nbsp;".$this->Paginator->numbers()."&nbsp;&nbsp;"; ?>
                            <?php echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled')); ?>
                        </td>
                        
                    </tr>
                    
                <?php
            }
            
        ?>
    </tbody>
</table>