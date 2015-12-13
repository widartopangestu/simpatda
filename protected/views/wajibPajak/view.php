<?php
/* @var $this WajibPajakController */
/* @var $model WajibPajak */
?>

<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Wajib Pajak') => array('index'),
    $model->npwpd,
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Wajib Pajak');
$this->modulTitle = Yii::t('trans', 'View') . ' ' . Yii::t('trans', 'Wajib Pajak') . ' #' . $model->npwpd;
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index', 'type' => $model->golongan), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('wajibPajak.index')) ? true : false),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create', 'type' => $model->golongan), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('wajibPajak.create')) ? true : false),
    array('label' => Yii::t('trans', 'Update'), 'url' => array('update', 'id' => $model->id), 'icon' => 'pencil', 'visible' => (Yii::app()->util->is_authorized('wajibPajak.update')) ? true : false),
    array('label' => Yii::t('trans', 'Delete'), 'url' => '#', 'visible' => (Yii::app()->util->is_authorized('wajibPajak.delete')) ? true : false, 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('trans', 'Are you sure you want to delete this item?')), 'icon' => 'trash'),
);
?>
<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab"><?php echo Yii::t('trans', 'Data Pribadi'); ?></a></li>
        <?php if ($model->golongan == 2) : ?>
            <li><a href="#tab2" data-toggle="tab"><?php echo Yii::t('trans', 'Badan Usaha'); ?></a></li>
        <?php endif; ?>
        <li><a href="#tab3" data-toggle="tab"><?php echo Yii::t('trans', 'Lain-Lain'); ?></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <?php
            $this->widget('zii.widgets.CDetailView', array(
                'htmlOptions' => array(
                    'class' => 'table table-striped table-condensed table-hover',
                ),
                'data' => $model,
                'attributes' => array(
                    array(
                        'label' => 'NPWPWD',
                        'name' => 'npwpd',
                        'type' => 'raw',
                        'value' => CHtml::encode($model->npwpd),
                    ),
                    array(
                        'name' => 'jenis',
                        'type' => 'raw',
                        'value' => CHtml::encode($model->jenisText),
                    ),
                    array(
                        'name' => 'golongan',
                        'type' => 'raw',
                        'value' => CHtml::encode($model->golonganText),
                    ),
                    'nomor',
                    'nama',
                    'alamat',
                    'kabupaten',
//                    array(
//                        'name' => 'kecamatan_id',
//                        'type' => 'raw',
//                        'value' => $model->namaKecamatan,
//                    ),
                    'kecamatan',
//                    array(
//                        'name' => 'kelurahan_id',
//                        'type' => 'raw',
//                        'value' => $model->namaKelurahan,
//                    ),
                    'kelurahan',
                    'kodepos',
                    'telepon',
                    'warga_negara',
                    array(
                        'name' => 'status',
                        'type' => 'raw',
                        'value' => CHtml::encode($model->statusText),
                    ),
                    array(
                        'name' => 'tanggal_tutup',
                        'type' => 'raw',
                        'value' => date('d-m-Y', strtotime($model->tanggal_tutup)),
                        'visible' => $model->tanggal_tutup !== NULL
                    ),
                    array(
                        'name' => 'tanggal_tutup',
                        'type' => 'raw',
                        'value' => date('d-m-Y', strtotime($model->tanggal_tutup)),
                        'visible' => $model->tanggal_tutup !== NULL
                    ),
                    array(
                        'name' => 'nomer_berita_acara',
                        'type' => 'raw',
                        'value' => CHtml::encode($model->nomer_berita_acara),
                        'visible' => $model->tanggal_tutup !== NULL
                    ),
                    array(
                        'name' => 'isi_berita_acara',
                        'type' => 'raw',
                        'value' => CHtml::encode($model->isi_berita_acara),
                        'visible' => $model->tanggal_tutup !== NULL
                    ),
                ),
            ));
            ?>
        </div>
        <?php if ($model->golongan == 2) : ?>
            <div class="tab-pane" id="tab2">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'htmlOptions' => array(
                        'class' => 'table table-striped table-condensed table-hover',
                    ),
                    'data' => $model,
                    'attributes' => array(
                        array(
                            'name' => 'bidang_usaha_id',
                            'type' => 'raw',
                            'value' => $model->namaBidangUsaha,
                        ),
                        'bu_nama',
                        'bu_alamat',
                        'bu_kabupaten',
                        'bu_kecamatan',
                        'bu_kelurahan',
                        'bu_telepon',
                        'bu_kodepos'
                    )
                ));
                ?>
            </div>
        <?php endif; ?>
        <div class="tab-pane" id="tab3">
            <?php
            $this->widget('zii.widgets.CDetailView', array(
                'htmlOptions' => array(
                    'class' => 'table table-striped table-condensed table-hover',
                ),
                'data' => $model,
                'attributes' => array(
                    array(
                        'label' => 'Nomor ' . $model->idJenisText,
                        'name' => 'id_nomor',
                        'type' => 'raw',
                        'value' => CHtml::encode($model->id_nomor),
                    ),
                    array(
                        'name' => 'tanggal_lahir',
                        'type' => 'raw',
                        'value' => date('d-m-Y', strtotime($model->tanggal_lahir)),
                    ),
                    'kk_nomor',
                    array(
                        'name' => 'kk_tanggal',
                        'type' => 'raw',
                        'value' => date('d-m-Y', strtotime($model->kk_tanggal)),
                    ),
                    'pekerjaan',
                    'alamat_pekerjaan',
//        array(
//            'name' => 'created',
//            'value' => $model->created !== NULL ? date("d-M-Y H:i:s", strtotime($model->created)) : '',
//        ),
//        array(
//            'name' => 'updated',
//            'value' => $model->updated !== NULL ? date("d-M-Y H:i:s", strtotime($model->updated)) : '',
//        ),
                )
            ));
            ?>
        </div>
    </div>
</div>