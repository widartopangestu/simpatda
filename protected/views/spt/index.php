<?php
/* @var $this SptController */
/* @var $model Spt */


$this->breadcrumbs=array(
	Yii::t('trans', 'Spts')=>array('index'),
	Yii::t('trans', 'Manage'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Spts');
$this->modulTitle = Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Spt');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Create'), 'url'=>array('create'), 'icon'=>'file', 'visible' => (Yii::app()->util->is_authorized('spt.create')) ? true : false),
);
$pageSize = Yii::app()->user->getState('pageSize' . $model->tableName(), Yii::app()->params['defaultPageSize']); ?>

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
$visible_view = (Yii::app()->util->is_authorized('spt.view')) ? 'true' : 'false';
$visible_update = (Yii::app()->util->is_authorized('spt.update')) ? 'true' : 'false';
$visible_delete = (Yii::app()->util->is_authorized('spt.delete')) ? 'true' : 'false';
$this->widget('yiiwheels.widgets.grid.WhGridView',array(
'id'=>'spt-grid',
'dataProvider'=>$model->search(),
'responsiveTable' => true,
'filter'=>$model,
'template'=>'{items}{pager}{summary}', 
'columns'=>array(
        array(
            'header' => 'No',
            'value' => '$this->grid->dataProvider->getPagination()->getOffset()+$row+1'
        ),
		'id',
		'periode',
		'nomor',
		'periode_awal',
		'periode_akhir',
		'pajak',
		/*
		'nilai',
		'jenis_pemungutan',
		'tarif_dasar',
		'tarif_persen',
		'tanggal_proses',
		'tanggal_entry',
		'uraian',
		'jenis_pajak',
		'wajib_pajak_id',
		'kode_rekening_id',
		'jenis_surat_id',
		'updated',
		'created',
		*/
        array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
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
)); ?>
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
    $('#pageSizeTop').change(function() {
        $('#pageSize').val($('#pageSizeTop').val());
    });

    $('#pageSize').change(function() {
        $('#pageSizeTop').val($('#pageSize').val());
    });
</script>