<?php
/* @var $this WajibPajakController */
/* @var $model WajibPajak */


$this->breadcrumbs=array(
	Yii::t('trans', 'Wajib Pajak')=>array('index'),
	Yii::t('trans', 'Manage'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Wajib Pajak');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Create'), 'url'=>array('create'), 'icon'=>'file', 'visible' => (Yii::app()->util->is_authorized('wajibPajak.create')) ? true : false),
);
$pageSize = Yii::app()->user->getState('pageSize' . $model->tableName(), Yii::app()->params['defaultPageSize']); ?>

<div class="widget ">
    <div class="widget-header">
        <i class="icon-list-alt"></i>
        <h3><?php echo Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Wajib Pajak'); ?></h3>
    </div> <!-- /widget-header -->
    <div class="widget-content">
        <div class="grid-view pull-right">
            <div class="filter-container">
        <?php
                echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList('pageSizeTop', $pageSize, Yii::app()->params['optionsPage'], array(
                    'onchange' => '$.fn.yiiGridView.update(\'wajib-pajak-grid\',{ data:{pageSize: $(this).val() }})',
                    'style' => 'width:70px;'
                ));        
        ?>            </div>
        </div>
<?php 
        $visible_view = (Yii::app()->util->is_authorized('wajibPajak.view')) ? 'true' : 'false';
        $visible_update = (Yii::app()->util->is_authorized('wajibPajak.update')) ? 'true' : 'false';
        $visible_delete = (Yii::app()->util->is_authorized('wajibPajak.delete')) ? 'true' : 'false';
        $this->widget('yiiwheels.widgets.grid.WhGridView',array(
	'id'=>'wajib-pajak-grid',
	'dataProvider'=>$model->search(),
        'responsiveTable' => true,
	'filter'=>$model,
        'template'=>'{items}{pager}{summary}', 
	'columns'=>array(
                array(
                    'header' => 'No',
                    'value' => '$this->grid->dataProvider->getPagination()->getOffset()+$row+1'
                ),
		'jenis',
		'golongan',
		'nomor',
		'nama',
		'alamat',
		/*
		'kabupaten',
		'kecamatan',
		'kelurahan',
		'telepon',
		'status',
		'tanggal_tutup',
		'kodepos',
		'id_jenis',
		'id_nomor',
		'tanggal_lahir',
		'kk_nomor',
		'kk_tanggal',
		'pekerjaan',
		'alamat_pekerjaan',
		'bu_nama',
		'bu_alamat',
		'bu_kabupaten',
		'bu_kecamatan',
		'bu_kelurahan',
		'bu_telepon',
		'bu_kodepos',
		'kelurahan_id',
		'kecamatan_id',
		'bidang_usaha_id',
		'warga_negara',
                array(
                    'filter' => false,
                    'name' => 'created',
                    'value' => '$data->created !== NULL ? date("d-M-Y H:i:s", strtotime($data->created)) : \'\'',
                ),
                array(
                    'filter' => false,
                    'name' => 'updated',
                    'value' => '$data->updated !== NULL ? date("d-M-Y H:i:s", strtotime($data->updated)) : \'\'',
                ),
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
                    'onchange' => '$.fn.yiiGridView.update(\'wajib-pajak-grid\',{ data:{pageSize: $(this).val() }})',
                    'style' => 'width:70px;'
                ));        
        ?>            </div>
        </div>  
    </div>
</div>
<script type="text/javascript">    
    $('#pageSizeTop').change(function() {
        $('#pageSize').val($('#pageSizeTop').val());
    });

    $('#pageSize').change(function() {
        $('#pageSizeTop').val($('#pageSize').val());
    });
</script>