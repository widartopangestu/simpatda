<?php

/* @var $this KodeRekeningController */
/* @var $model KodeRekening */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Kode Rekenings') => array('index'),
    $model->id => array('view', 'id' => $model->id),
    Yii::t('trans', 'Update'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Kode Rekenings');
$this->modulTitle = Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Kode Rekening') . ' #' . $model->id;
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('kodeRekening.index')) ? true : false),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('kodeRekening.create')) ? true : false),
    array('label' => Yii::t('trans', 'View'), 'url' => array('view', 'id' => $model->id), 'icon' => 'eye-open', 'visible' => (Yii::app()->util->is_authorized('kodeRekening.view')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>