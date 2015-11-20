<?php

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'User');
$this->modulTitle = Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'User') . ' ' . $model->id;
$this->breadcrumbs = array(
    $model->username => array('view', 'id' => $model->id),
    Yii::t('trans', 'Update'),
);

$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt'),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file'),
    array('label' => Yii::t('trans', 'View'), 'url' => array('view', 'id' => $model->id), 'icon' => 'eye-open'),
);
?>
<?php $this->renderPartial('_form', array('model' => $model)); ?>