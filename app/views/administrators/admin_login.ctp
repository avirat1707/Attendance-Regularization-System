<div id="divLogin" style="display:none" title="Attendance Regularization System">
    <?php
        echo $this->Form->create('Administrator');
        echo $this->Form->input('username',array('label'=>'Login Id'));
        echo $this->Form->input('passwd',array('label'=>'Password'));
        echo $this->Form->end(array('label'=>'Login','class'=>'jqueryuiButton'));
        if(isset($loginError)){
            echo '<div class="error-message" style="margin-left:10px !important;padding:0">**Invalid Login-ID/Password</div>';
        }
    ?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#divLogin").dialog({
            modal:true,
            width:350,
            height:200,
            resizable:false,
            closeOnEscape:false
        });
        $(".ui-dialog-titlebar-close").addClass("hidden");
        $("#SchoolLoginid").focus();
    });
    
</script>
