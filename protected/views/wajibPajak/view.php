<?php
/* @var $this WajibPajakController */
/* @var $model WajibPajak */
?>

<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Wajib Pajak') => array('index'),
    $model->id,
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Wajib Pajak');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('wajibPajak.index')) ? true : false),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('wajibPajak.create')) ? true : false),
    array('label' => Yii::t('trans', 'Update'), 'url' => array('update', 'id' => $model->id), 'icon' => 'pencil', 'visible' => (Yii::app()->util->is_authorized('wajibPajak.update')) ? true : false),
    array('label' => Yii::t('trans', 'Delete'), 'url' => '#', 'visible' => (Yii::app()->util->is_authorized('wajibPajak.delete')) ? true : false, 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('trans', 'Are you sure you want to delete this item?')), 'icon' => 'trash'),
);
?>

<div class="widget ">
    <div class="widget-header">
        <i class="icon-eye-open"></i>
        <h3><?php echo Yii::t('trans', 'View') . ' ' . Yii::t('trans', 'Wajib Pajak'); ?>  #<?php echo $model->id; ?></h3>
    </div> <!-- /widget-header -->
    <div class="widget-content">
        <?php
        $this->widget('zii.widgets.CDetailView', array(
            'htmlOptions' => array(
                'class' => 'table table-striped table-condensed table-hover',
            ),
            'data' => $model,
            'attributes' => array(
                'jenis',
                'golongan',
                'nomor',
                'nama',
                'alamat',
                'kabupaten',
                array(
                    'name' => 'kelurahan_id',
                    'type' => 'raw',
                    'value' => $model->namaKelurahan,
                ),
                array(
                    'name' => 'kecamatan_id',
                    'type' => 'raw',
                    'value' => $model->namaKecamatan,
                ),
//                'kecamatan',
//                'kelurahan',
                'telepon',
                array(
                    'name' => 'status',
                    'type' => 'raw',
                    'value' => CHtml::encode($model->statusText),
                ),
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
                array(
                    'name' => 'bidang_usaha_id',
                    'type' => 'raw',
                    'value' => $model->namaBidangUsaha,
                ),
                'warga_negara',
                array(
                    'name' => 'created',
                    'value' => $model->created !== NULL ? date("d-M-Y H:i:s", strtotime($model->created)) : '',
                ),
                array(
                    'name' => 'updated',
                    'value' => $model->updated !== NULL ? date("d-M-Y H:i:s", strtotime($model->updated)) : '',
                ),
            ),
        ));
        ?>
    </div>
</div>