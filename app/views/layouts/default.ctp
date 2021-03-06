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
        echo $this->Html->css('homestyle');
        echo $this->Html->css('style');
        echo $this->Html->css('jqueryui.custom');
    ?>
    <?php echo $this->Html->script('jquery.min'); ?>
    <?php echo $this->Html->script('jqueryui.custom.min'); ?>
    <?php echo $this->Html->script('jquery.liveready'); ?>
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
    <?php echo $this->element('sql_dump'); ?>
    <?php echo $scripts_for_layout;?>
    <?php echo $this->Html->script('myscript'); ?>
</body>
</html>