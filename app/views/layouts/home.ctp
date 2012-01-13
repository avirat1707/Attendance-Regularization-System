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
        echo $this->Html->css('jqueryui.custom');
        echo $this->Html->css('homestyle');
    ?>
    <?php echo $this->Html->script('jquery.min'); ?>
    <?php echo $this->Html->script('jqueryui.custom.min'); ?>
    <?php echo $this->Html->script("jquery.blockUI"); ?>
    <?php echo $this->Html->script("jquery.text-effects"); ?>
</head>
<body>
    <div id="wrapper">
        <?php echo $this->element('layouts/logo_and_news'); ?>
        <div id="content">
            <?php echo $this->Session->flash(); ?>
            <?php echo $content_for_layout; ?>
        </div>
    </div>
    <div id="footer" class="nor-text" style="text-align:center">Copyright © 2012. All Right Researved.</div>
    <?php echo $this->element('sql_dump'); ?>
    <?php echo $scripts_for_layout;?>
    <?php echo $this->Html->script('myscript'); ?>
</body>
</html>