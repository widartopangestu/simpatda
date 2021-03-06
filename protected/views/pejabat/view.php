<?php

/* @var $this PejabatController */
/* @var $model Pejabat */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Pejabat') => array('index'),
    $model->id,
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Pejabat');
$this->modulTitle = Yii::t('trans', 'View') . ' ' . Yii::t('trans', 'Pejabat') . ' #' . $model->id;
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('pejabat.index')) ? true : false),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('pejabat.create')) ? true : false),
    array('label' => Yii::t('trans', 'Update'), 'url' => array('update', 'id' => $model->id), 'icon' => 'pencil', 'visible' => (Yii::app()->util->is_authorized('pejabat.update')) ? true : false),
    array('label' => Yii::t('trans', 'Delete'), 'url' => '#', 'visible' => (Yii::app()->util->is_authorized('pejabat.delete')) ? true : false, 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('trans', 'Are you sure you want to delete this item?')), 'icon' => 'trash'),
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
        'nip',
        array(
            'name' => 'status',
            'type' => 'raw',
            'value' => CHtml::encode($model->statusText),
        ),
        array(
            'name' => 'golongan_id',
            'type' => 'raw',
            'value' => $model->namaGolongan,
        ),
        array(
            'name' => 'jabatan_id',
            'type' => 'raw',
            'value' => $model->namaJabatan,
        ),
        array(
            'name' => 'pangkat_id',
            'type' => 'raw',
            'value' => $model->namaPangkat,
        ),
//        array(
//            'name' => 'created',
//            'value' => $model->created !== NULL ? date("d-M-Y H:i:s", strtotime($model->created)) : '',
//        ),
//        array(
//            'name' => 'updated',
//            'value' => $model->updated !== NULL ? date("d-M-Y H:i:s", strtotime($model->updated)) : '',
//        ),
    ),
));
?>