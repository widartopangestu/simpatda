<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Backup') => array('index'),
    Yii::t('trans', 'Restore Backup') . ' ' . UploadForm::label(2),
);
?>
<div class="widget ">

    <div class="widget-header">
        <i class="icon-refresh"></i>
        <h3><?php echo Yii::t('trans', 'Restore Backup'); ?></h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">
        <p class="alert alert-info">
            <?php
            if (isset($error))
                echo $error;
            else
                echo Yii::t('trans', 'Done');
            ?>
        </p>
    </div>
</div>