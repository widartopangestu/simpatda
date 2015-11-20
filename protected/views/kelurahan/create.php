<?php

/* @var $this KelurahanController */
/* @var $model Kelurahan */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Kelurahan') => array('index'),
    Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Kelurahan');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Kelurahan');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('kelurahan.index')) ? true : false),
);
?>
<?php $this->renderPartial('_form', array('model' => $model)); ?>   