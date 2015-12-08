<?php
/* @var $this PemeriksaanController */
/* @var $model Pemeriksaan */


$this->breadcrumbs = array(
    Yii::t('trans', 'Laporan Hasil Pemeriksaan (LHP)') => array('index'),
    Yii::t('trans', 'Manage'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Laporan Hasil Pemeriksaan (LHP)');
$this->modulTitle = Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Laporan Hasil Pemeriksaan (LHP)');
$this->menu = array(
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('pemeriksaan.create')) ? true : false),
);
$pageSize = Yii::app()->user->getState('pageSize' . $model->tableName(), Yii::app()->params['defaultPageSize']);
?>

<div class="grid-view pull-right">
    <div class="filter-container">
        <?php
        echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList('pageSizeTop', $pageSize, Yii::app()->params['optionsPage'], array(
            'onchange' => '$.fn.yiiGridView.update(\'pemeriksaan-grid\',{ data:{pageSize: $(this).val() }})',
            'style' => 'width:70px;'
        ));
        ?>    </div>
</div>
<?php
$visible_view = (Yii::app()->util->is_authorized('pemeriksaan.view')) ? 'true' : 'false';
$visible_update = (Yii::app()->util->is_authorized('pemeriksaan.update')) ? 'true' : 'false';
$visible_delete = (Yii::app()->util->is_authorized('pemeriksaan.delete')) ? 'true' : 'false';
$this->widget('yiiwheels.widgets.grid.WhGridView', array(
    'id' => 'pemeriksaan-grid',
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
        'periode',
        array(
            'name' => 'tanggal',
            'value' => 'date("d/m/Y",strtotime($data->tanggal))',
            'filter' => false,
        ),
        array(
            'name' => 'npwpd',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->wajibpajak->npwpd)',
            'filter' => false,
        ),
        array(
            'name' => 'wp_search',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->wajibpajak->nama)',
        ),
        array(
            'name' => 'nilai_pajak',
            'type' => 'raw',
            'value' => 'number_format($data->nilai_pajak, Yii::app()->params[\'currency_precision\'])',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'buttons' => array(
                'view' => array(
                    'visible' => 'false',
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
            'onchange' => '$.fn.yiiGridView.update(\'pemeriksaan-grid\',{ data:{pageSize: $(this).val() }})',
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