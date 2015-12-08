<?php

/* @var $this SetoranBankController */
/* @var $model SetoranBank */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Setoran Bank') => array('index'),
    $model->id,
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Setoran Bank');
$this->modulTitle = Yii::t('trans', 'View') . ' ' . Yii::t('trans', 'Setoran Bank') . ' #' . $model->id;
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('setoranBank.index')) ? true : false),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('setoranBank.create')) ? true : false),
    array('label' => Yii::t('trans', 'Update'), 'url' => array('update', 'id' => $model->id), 'icon' => 'pencil', 'visible' => (Yii::app()->util->is_authorized('setoranBank.update')) ? true : false),
    array('label' => Yii::t('trans', 'Delete'), 'url' => '#', 'visible' => (Yii::app()->util->is_authorized('setoranBank.delete')) ? true : false, 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('trans', 'Are you sure you want to delete this item?')), 'icon' => 'trash'),
);
?>

<?php

$this->widget('zii.widgets.CDetailView', array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'tanggal',
            'value' => date("d/m/Y", strtotime($model->tanggal))
        ),
        'nomor',
    ),
));

$criteria = new CDbCriteria();
$criteria->condition = "t.id IN (SELECT setoran_pajak_id FROM setoran_bank_item WHERE setoran_bank_id=$model->id)";
$this->widget('yiiwheels.widgets.grid.WhGridView', array(
    'id' => 'order-pembelian-item-grid',
    'dataProvider' => new CArrayDataProvider(SetoranPajak::model()->findAll($criteria), array(
        'pagination' => false,
            )),
    'template' => '{items}{pager}{summary}',
    'columns' => array(
        array(
            'header' => 'No',
            'value' => '$row+1'
        ),
        array(
            'header' => SetoranPajak::model()->getAttributeLabel('nomor'),
            'type' => 'raw',
            'value' => 'CHtml::encode($data->nomor)',
        ),
        array(
            'header' => SetoranPajak::model()->getAttributeLabel('periode'),
            'type' => 'raw',
            'value' => 'CHtml::encode($data->penetapan->spt->periode)',
        ),
        array(
            'header' => SetoranPajak::model()->getAttributeLabel('kohir'),
            'type' => 'raw',
            'value' => 'CHtml::encode($data->penetapan->kohir)',
        ),
        array(
            'header' => SetoranPajak::model()->getAttributeLabel('jenis_surat'),
            'type' => 'raw',
            'value' => 'CHtml::encode($data->namaJenisSurat)',
        ),
        array(
            'header' => SetoranPajak::model()->getAttributeLabel('tanggal_bayar'),
            'value' => 'date("d/m/Y",strtotime($data->tanggal_bayar))'
        ),
        array(
            'header' => SetoranPajak::model()->getAttributeLabel('nama_rekening'),
            'type' => 'raw',
            'value' => 'CHtml::encode($data->penetapan->spt->kodeRekening->nama)',
        ),
        array(
            'header' => SetoranPajak::model()->getAttributeLabel('npwpd'),
            'type' => 'raw',
            'value' => 'CHtml::encode($data->penetapan->spt->wajibpajak->npwpd)',
        ),
        array(
            'header' => SetoranPajak::model()->getAttributeLabel('nama_wajib_pajak'),
            'type' => 'raw',
            'value' => 'CHtml::encode($data->penetapan->spt->wajibpajak->nama)',
        ),
        array(
            'header' => SetoranPajak::model()->getAttributeLabel('via_bayar'),
            'type' => 'raw',
            'value' => 'CHtml::encode($data->viaBayarText)',
        ),
        array(
            'header' => SetoranPajak::model()->getAttributeLabel('jumlah_bayar'),
            'name' => 'jumlah_bayar',
            'type' => 'raw',
            'value' => 'number_format($data->jumlah_bayar, Yii::app()->params[\'currency_precision\'])',
        ),
    ),
));
?>