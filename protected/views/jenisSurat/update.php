<?php

/* @var $this JenisSuratController */
/* @var $model JenisSurat */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Jenis Surat') => array('index'),
    $model->id => array('view', 'id' => $model->id),
    Yii::t('trans', 'Update'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Jenis Surat');
$this->modulTitle = Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Jenis Surat') . ' #' . $model->id;
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('jenisSurat.index')) ? true : false),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('jenisSurat.create')) ? true : false),
    array('label' => Yii::t('trans', 'View'), 'url' => array('view', 'id' => $model->id), 'icon' => 'eye-open', 'visible' => (Yii::app()->util->is_authorized('jenisSurat.view')) ? true : false),
);
?>
<?php $this->renderPartial('_form', array('model' => $model)); ?> 