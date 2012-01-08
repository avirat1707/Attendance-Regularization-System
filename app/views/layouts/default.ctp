<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php __('Attendance Regularizarion System: '); ?>
        <?php echo $title_for_layout; ?>
    </title>
    <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('style');
        echo $this->Html->css('jqueryui.custom');
    ?>
    <?php echo $this->Html->script('jquery.min'); ?>
    <?php echo $this->Html->script('jqueryui.custom.min'); ?>
    <?php echo $this->Html->script('jquery.liveready'); ?>
    <?php echo $this->Html->script("jquery.blockUI"); ?>
</head>
<body>
    <div id="wrapper">
        <div id="divHeader">
            <?php echo $this->Html->image("logo_hindi.png",array('style'=>'width:300px;'));?>
            <h3>E-School</h3>
        </div>
        <div id="content">
            <?php echo $this->Session->flash(); ?>
            <?php echo $content_for_layout; ?>
        </div>
    </div>
    <?php echo $this->element('sql_dump'); ?>
    <?php echo $scripts_for_layout;?>
    <?php echo $this->Html->script('myscript'); ?>
</body>
</html>