<div id="divHome">
    <div id="divLocations">
     <?php
        foreach($all_locations as $location){
            echo "<p>".$this->Html->link($location['Location']['location'],"#",array('class'=>'jqueryuiButton'))."</p>";
            
        }
     ?>  
    </div>
</div>
