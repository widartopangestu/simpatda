<?php
/* @var $this SetoranPajakController */
/* @var $model SetoranPajak */


$this->breadcrumbs = array(
    Yii::t('trans', 'Setoran Pajak') => array('index'),
    Yii::t('trans', 'Manage'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Setoran Pajak');
$this->modulTitle = Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Setoran Pajak');
$this->menu = array(
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('setoranPajak.create')) ? true : false),
);
$pageSize = Yii::app()->user->getState('pageSize' . $model->tableName(), Yii::app()->params['defaultPageSize']);
?>

<div class="grid-view pull-right">
    <div class="filter-container">
        <?php
        echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList('pageSizeTop', $pageSize, Yii::app()->params['optionsPage'], array(
            'onchange' => '$.fn.yiiGridView.update(\'setoran-pajak-grid\',{ data:{pageSize: $(this).val() }})',
            'style' => 'width:70px;'
        ));
        ?>    </div>
</div>
<?php
$visible_view = (Yii::app()->util->is_authorized('setoranPajak.view')) ? 'true' : 'false';
$visible_update = (Yii::app()->util->is_authorized('setoranPajak.update')) ? 'true' : 'false';
//if ($visible_update === 'true') {
//    $visible_update = '($data->penetapan->jenis_surat_id != 3) ? true : false';
//}
$visible_delete = (Yii::app()->util->is_authorized('setoranPajak.delete')) ? 'true' : 'false';
//if ($visible_delete === 'true') {
//    $visible_delete = '($data->penetapan->jenis_surat_id != 3) ? true : false';
//}
$this->widget('yiiwheels.widgets.grid.WhGridView', array(
    'id' => 'setoran-pajak-grid',
    'dataProvider' => $model->search(),
    'responsiveTable' => true,
    'filter' => $model,
    'template' => '{items}{pager}{summary}',
    'columns' => array(
        array(
            'header' => 'No',
            'value' => '$this->grid->dataProvider->getPagination()->getOffset()+$row+1'
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
            'filter' => false, //$model->jenisSuratOptions,
        ),
        array(
            'name' => 'tanggal_bayar',
            'value' => 'date("d/m/Y",strtotime($data->tanggal_bayar))'
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
        'nama_penyetor',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'buttons' => array(
                'view' => array(
                    'visible' => $visible_view,
                ),
                'update' => array(
                    'visible' => $visible_update,
                ),
                'delete' => array(
                    'visible' => $visible_delete,
                ),
            ),
        ),
    ),
));
?>
<div class="grid-view">
    <div class="summary">
        <?php
        echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList('pageSize', $pageSize, Yii::app()->params['optionsPage'], array(
            'onchange' => '$.fn.yiiGridView.update(\'setoran-pajak-grid\',{ data:{pageSize: $(this).val() }})',
            'style' => 'width:70px;'
        ));
        ?>    </div>
</div>  
<script type="text/javascript">
    $('#pageSizeTop').change(function () {
        $('#pageSize').val($('#pageSizeTop').val());
    });

    $('#pageSize').change(function () {
        $('#pageSizeTop').val($('#pageSize').val());
    });
</script>