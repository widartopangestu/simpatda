<?php
/* @var $this PenetapanController */
/* @var $model Penetapan */


$this->breadcrumbs = array(
    Yii::t('trans', 'Penetapan') => array('index'),
    Yii::t('trans', 'Manage'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Penetapan');
$this->modulTitle = Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Penetapan');
$this->menu = array(
    array('label' => Yii::t('trans', 'Penetapan Pajak'), 'url' => array('pajak'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('penetapan.pajak')) ? true : false),
    array('label' => Yii::t('trans', 'Penetapan Sanksi/Bunga'), 'url' => array('sanksi'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('penetapan.sanksi')) ? true : false),
);
$pageSize = Yii::app()->user->getState('pageSize' . $model->tableName(), Yii::app()->params['defaultPageSize']);
?>

<div class="grid-view pull-right">
    <div class="filter-container">
        <?php
        echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList('pageSizeTop', $pageSize, Yii::app()->params['optionsPage'], array(
            'onchange' => '$.fn.yiiGridView.update(\'penetapan-grid\',{ data:{pageSize: $(this).val() }})',
            'style' => 'width:70px;'
        ));
        ?>    </div>
</div>
<?php
$visible_view = (Yii::app()->util->is_authorized('penetapan.view')) ? 'true' : 'false';
$visible_update = (Yii::app()->util->is_authorized('penetapan.update')) ? 'true' : 'false';
$visible_delete = (Yii::app()->util->is_authorized('penetapan.delete')) ? 'true' : 'false';
$this->widget('yiiwheels.widgets.grid.WhGridView', array(
    'id' => 'penetapan-grid',
    'dataProvider' => $model->search(),
    'responsiveTable' => true,
    'filter' => $model,
    'template' => '{items}{pager}{summary}',
    'columns' => array(
        array(
            'header' => 'No',
            'value' => '$this->grid->dataProvider->getPagination()->getOffset()+$row+1'
        ),
        'kohir',
        array(
            'name' => 'periode',
            'type' => 'raw',
            'value' => 'CHtml::encode(!empty($data->spt_id) ? $data->spt->periode : $data->pemeriksaan->periode)',
            'filter' => false,
        ),
        array(
            'name' => 'no_sptpd_/_lhp',
            'type' => 'raw',
            'value' => 'CHtml::encode(!empty($data->spt_id) ? $data->spt->nomor : $data->pemeriksaan->nomor)',
            'filter' => false,
        ),
        array(
            'name' => 'tanggal_penetapan',
            'value' => 'date("d/m/Y",strtotime($data->tanggal_penetapan))',
            'filter' => false,
        ),
        array(
            'name' => 'jenis_surat_id',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->namaJenisSurat)',
            'filter' => $model->jenisSuratOptions,
        ),
        array(
            'name' => 'tanggal_jatuh_tempo',
            'value' => 'date("d/m/Y",strtotime($data->tanggal_jatuh_tempo))',
            'filter' => false,
        ),
        array(
            'name' => 'nama_rekening',
            'type' => 'raw',
            'value' => 'CHtml::encode(!empty($data->spt_id) ? $data->spt->kodeRekening->nama :  $data->pemeriksaan->kodeRekening->nama)',
            'filter' => false,
        ),
        array(
            'name' => 'npwpd',
            'type' => 'raw',
            'value' => 'CHtml::encode(!empty($data->spt_id) ? $data->spt->wajibpajak->npwpd : $data->pemeriksaan->wajibpajak->npwpd)',
            'filter' => false,
        ),
        array(
            'name' => 'nama_wajib_pajak',
            'type' => 'raw',
            'value' => 'CHtml::encode(!empty($data->spt_id) ? $data->spt->wajibpajak->nama : $data->pemeriksaan->wajibpajak->nama)',
            'filter' => false,
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'buttons' => array(
                'view' => array(
                    'visible' => 'false',
                ),
                'update' => array(
                    'visible' => 'false',
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
            'onchange' => '$.fn.yiiGridView.update(\'penetapan-grid\',{ data:{pageSize: $(this).val() }})',
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