<?php

/* @var $this JenisSuratController */
/* @var $model JenisSurat */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Jenis Surat') => array('index'),
    $model->id,
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Jenis Surat');
$this->modulTitle = Yii::t('trans', 'View') . ' ' . Yii::t('trans', 'Jenis Surat') . ' #' . $model->name;
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('jenisSurat.index')) ? true : false),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('jenisSurat.create')) ? true : false),
    array('label' => Yii::t('trans', 'Update'), 'url' => array('update', 'id' => $model->id), 'icon' => 'pencil', 'visible' => (Yii::app()->util->is_authorized('jenisSurat.update')) ? true : false),
    array('label' => Yii::t('trans', 'Delete'), 'url' => '#', 'visible' => (Yii::app()->util->is_authorized('jenisSurat.delete')) ? true : false, 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('trans', 'Are you sure you want to delete this item?')), 'icon' => 'trash'),
);
?>
<?php

$this->widget('zii.widgets.CDetailView', array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data' => $model,
    'attributes' => array(
        'kode',
        'nama',
        'singkatan',
        'is_official',
        'is_self',
        array(
            'name' => 'created',
            'value' => $model->created !== NULL ? $model->created !== NULL ? date("d-M-Y H:i:s", strtotime($model->created)) : '' : '',
        ),
        array(
            'name' => 'updated',
            'value' => $model->updated !== NULL ? $model->updated !== NULL ? date("d-M-Y H:i:s", strtotime($model->updated)) : '' : '',
        ),
    ),
));
?>