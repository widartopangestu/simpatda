<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Operation');
$this->breadcrumbs = array(
    Yii::t('trans', 'Operations') => array('admin'),
    Yii::t('trans', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('admin'), 'icon' => 'list-alt'),
);
?>

<div class="widget ">

    <div class="widget-header">
        <i class="icon-plus"></i>
        <h3><?php echo Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Operation'); ?></h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">
        <?php $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>