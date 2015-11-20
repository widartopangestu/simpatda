<?php

/* @var $this GolonganController */
/* @var $model Golongan */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Golongan') => array('index'),
    $model->id => array('view', 'id' => $model->id),
    Yii::t('trans', 'Update'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Golongan');
$this->modulTitle = Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Golongan') . ' #' . $model->id;
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('golongan.index')) ? true : false),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('golongan.create')) ? true : false),
);
?>
<?php $this->renderPartial('_form', array('model' => $model)); ?> 