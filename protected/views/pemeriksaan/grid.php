<?php

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Browse') . ' ' . Yii::t('trans', 'Tagihan Pembelian');
echo '<br/>';
$this->modulTitle = Yii::t('trans', 'Tagihan Pembelian');
?>


<?php

$this->widget('yiiwheels.widgets.grid.WhGridView', array(
    'id' => 'setoran_-grid',
    'dataProvider' => $model->search(),
    'responsiveTable' => false,
    'filter' => $model,
    'template' => '{items}{pager}{summary}',
    'columns' => array(
        array(
            'header' => 'No',
            'value' => '$this->grid->dataProvider->getPagination()->getOffset()+$row+1'
        ),
        array(
            'class' => 'CCheckBoxColumn',
            'checkBoxHtmlOptions' => array(
                'name' => 'setoran_ids[]',
                'onclick' => 'parent.getValueSetoran($(this).val())'
            ),
            'selectableRows' => '1',
            'header' => Yii::t('trans', 'Pilih'),
//            'id' => 'someChecks', // need this id for use with $.fn.yiiGridView.getChecked(containerID,columnID)
            'value' => '$data->id',
            'checked' => 'Yii::app()->user->getState($data->id)', // we are using the user session variable to store the checked row values, also considering here that email_ids are unique for your app, it would be best to use any field that is unique in the table
        ),
        'nomor',
        array(
            'name' => 'periode',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->penetapan->spt->periode)',
            'filter' => false,
        ),
        array(
            'name' => 'kohir',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->penetapan->kohir)',
            'filter' => false,
        ),
        array(
            'name' => 'jenis_surat',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->namaJenisSurat)',
            'filter' => false,//$model->jenisSuratOptions,
        ),
        array(
            'name' => 'tanggal_bayar',
            'value' => 'date("d/m/Y",strtotime($data->tanggal_bayar))',
            'filter' => false,
        ),
        array(
            'name' => 'nama_rekening',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->penetapan->spt->kodeRekening->nama)',
            'filter' => false,
        ),
        array(
            'name' => 'npwpd',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->penetapan->spt->wajibpajak->npwpd)',
            'filter' => false,
        ),
        array(
            'name' => 'nama_wajib_pajak',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->penetapan->spt->wajibpajak->nama)',
            'filter' => false,
        ),
        array(
            'name' => 'via_bayar',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->viaBayarText)',
            'filter' => $model->viaBayarOptions,
        ),
    ),
));
?>