<div class="left-green-part">
    <div class="left-text-area">  
        <a href="#"><?php echo $this->Html->image('class_room.jpg'); ?></a>
    </div>
</div>
<div class="right-gray-part">
    <div class="right-text-area">
        <h1>Welcome to my school e-school</h1>
        <p>
            E-School is an application to maintain all the data of teachers and students along with their
            attendance sheet. the director/administrator can monitor the schools and thus can maintain discipline in
            all orders. This application reduces paper work and maintains data with great care.
        </p>
    </div>
</div>
<div class="login-from">
    <div id="logincontainer">
        <div id="loginbox">
            <div id="loginheader">
                <?php echo $this->Html->image('cp_logo_login.png',array('alt'=>'')); ?>
            </div>
            <div id="innerlogin">
                    <?php
                        echo $this->Form->create('School');
                        echo $this->Form->input('loginid',array('label'=>false,'class'=>'logininput','placeholder'=>'Enter Username'));
                        echo $this->Form->input('passwd',array('label'=>false,'class'=>'logininput','placeholder'=>'Enter Password'));
                        echo $this->Form->end(array('label'=>'Login','class'=>'loginbtn'));
                        echo "<br />";
                        if(isset($loginError)){
                            echo '<div class="error-message" style="margin-left:5px !important;padding:0;color:RED">**Invalid Login-ID/Password</div>';
                            echo "<br />";
                        }
                    ?>
            </div>
        </div>
    </div>
</div>
<div class="right-gray-part">
    <div class="right-text-area">
        <h1>Important notices</h1>
        <ul class="clean-tip" style="padding-left:20px;line-height:20px;">
            <li>Badha chokrao maate canteen ma free coupons available che.</li>
            <li>Independance day na darek staff member na parivaar ne aamantran.</li>
            <li>Teachers maate leave system ma change thase.</li>
        </ul>
    </div>
</div>

<div id="divLogin" style="display:none" title="Attendance Regularization System">
    <?php
        echo $this->Form->create('School');
        echo $this->Form->input('loginid',array('label'=>'Login Id'));
        echo $this->Form->input('passwd',array('label'=>'Password'));
        echo $this->Form->end(array('label'=>'Login','class'=>'jqueryuiButton'));
        
    ?>
</div>
