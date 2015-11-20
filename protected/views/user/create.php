<?php

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'User');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'User');
$this->breadcrumbs = array(
    Yii::t('trans', 'Create'),
);
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt'),
);
?>
<?php $this->renderPartial('_form', array('model' => $model)); ?>