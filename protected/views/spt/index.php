<?php
/* @var $this SptController */
/* @var $model Spt */


$this->breadcrumbs = array(
    Yii::t('trans', 'SPTPD') => array('index'),
    Yii::t('trans', 'Manage'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'SPTPD') . ' ' . $model->getJenisPajakText($jenis);
$this->modulTitle = Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'SPTPD') . ' ' . $model->getJenisPajakText($jenis);
$this->menu = array(
    array('label' => Yii::t('trans', 'Create'), 'url' => array('menu'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('spt.createHotel') || Yii::app()->util->is_authorized('spt.createRestoran') || Yii::app()->util->is_authorized('spt.createHiburan') || Yii::app()->util->is_authorized('spt.createReklame') || Yii::app()->util->is_authorized('spt.createElectric') || Yii::app()->util->is_authorized('spt.createGalian') || Yii::app()->util->is_authorized('spt.createAir') || Yii::app()->util->is_authorized('spt.createWalet') || Yii::app()->util->is_authorized('spt.createRetribusi') || Yii::app()->util->is_authorized('spt.createBphtb') || Yii::app()->util->is_authorized('spt.createReklameBaru')) ? true : false),
);
$pageSize = Yii::app()->user->getState('pageSize' . $model->tableName(), Yii::app()->params['defaultPageSize']);
?>

<div class="grid-view pull-right">
    <div class="filter-container">
        <?php
        echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList('pageSizeTop', $pageSize, Yii::app()->params['optionsPage'], array(
            'onchange' => '$.fn.yiiGridView.update(\'spt-grid\',{ data:{pageSize: $(this).val() }})',
            'style' => 'width:70px;'
        ));
        ?>    </div>
</div>
<?php
switch ($jenis) {
    case Spt::JENIS_PAJAK_HOTEL:
        $url = 'updateHotel';
        break;
    case Spt::JENIS_PAJAK_RESTORAN:
        $url = 'updateRestoran';
        break;
    case Spt::JENIS_PAJAK_HIBURAN:
        $url = 'updateHiburan';
        break;
    case Spt::JENIS_PAJAK_REKLAME:
        $url = 'updateReklame';
        break;
    case Spt::JENIS_PAJAK_ELECTRIC:
        $url = 'updateElectric';
        break;
    case Spt::JENIS_PAJAK_AIR:
        $url = 'updateAir';
        break;
    case Spt::JENIS_PAJAK_WALET:
        $url = 'updateWalet';
        break;
    case Spt::JENIS_PAJAK_GALIAN:
        $url = 'updateGalian';
        break;
    case Spt::JENIS_PAJAK_RETRIBUSI:
        $url = 'updateRetribusi';
        break;
    case Spt::JENIS_PAJAK_BPHTB:
        $url = 'updateBphtb';
        break;
}
$visible_update = (Yii::app()->util->is_authorized('spt.' . $url)) ? 'true' : 'false';
$visible_delete = (Yii::app()->util->is_authorized('spt.delete')) ? 'true' : 'false';
$this->widget('yiiwheels.widgets.grid.WhGridView', array(
    'id' => 'spt-grid',
    'dataProvider' => $model->search(),
    'responsiveTable' => true,
    'filter' => $model,
    'template' => '{items}{pager}{summary}',
    'columns' => array(
        array(
            'header' => 'No',
            'value' => '$this->grid->dataProvider->getPagination()->getOffset()+$row+1'
        ),
//        array(
//            'name' => 'jenis_pajak',
//            'type' => 'raw',
//            'value' => 'CHtml::encode($data->jenisPajakText)',
//            'filter' => $model->jenisPajakOptions,
//        ),
        array(
            'name' => 'jenis_pemungutan',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->jenisPemungutanText)',
            'filter' => $model->jenisPemungutanOptions,
        ),
        'periode',
        'nomor',
        array(
            'name' => 'npwpd',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->wajibPajak->npwpd)',
            'filter' => false,
        ),
        array(
            'name' => 'wajib_pajak_id',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->wajibPajak->nama)',
            'filter' => false,
        ),
        /*
          'periode_awal',
          'periode_akhir',
          'pajak',
          'nilai',
          'tarif_dasar',
          'tarif_persen',
          'tanggal_proses',
          'tanggal_entry',
          'uraian',
          'kode_rekening_id',
          'jenis_surat_id',
          'updated',
          'created',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{update} {delete}',
            'buttons' => array(
                'update' => array(
                    'url' => 'Spt::model()->getUpdateLink($data->jenis_pajak, $data->id)',
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
            'onchange' => '$.fn.yiiGridView.update(\'spt-grid\',{ data:{pageSize: $(this).val() }})',
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