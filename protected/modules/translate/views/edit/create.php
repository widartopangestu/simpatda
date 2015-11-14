<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Translate');
$this->breadcrumbs = array(
    Yii::t('trans', 'Translate') => array('index'),
    Yii::t('trans', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('translate.edit.index')) ? true : false),
);
?>
<div class="widget ">

    <div class="widget-header">
        <i class="icon-plus"></i>
        <h3><?php echo Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Translate'); ?></h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">
        <?php $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>