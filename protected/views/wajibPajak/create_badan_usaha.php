<?php
/* @var $this WajibPajakController */
/* @var $model WajibPajak */
?>

<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Wajib Pajak') => array('index'),
    Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Wajib Pajak') . ' ' . Yii::t('trans', 'Badan Usaha');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Wajib Pajak') . ' ' . Yii::t('trans', 'Badan Usaha');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('wajibPajak.index')) ? true : false),
);
?>
<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
        'id' => 'wajib-pajak-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'form-horizontal'),
    ));
    ?>

    <p class="help-block"><?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?></p>

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <div class="span5">
            <?php echo $form->dropDownListControlGroup($model, 'jenis', $model->jenisOptions, array('span' => 2)); ?>

            <?php echo $form->textFieldControlGroup($model, 'nomor', array('span' => 4, 'maxlength' => 7)); ?>

            <?php echo $form->textFieldControlGroup($model, 'nama', array('span' => 4, 'maxlength' => 255)); ?>

            <?php echo $form->textAreaControlGroup($model, 'alamat', array('rows' => 3, 'span' => 4)); ?>

            <?php echo $form->textFieldControlGroup($model, 'kabupaten', array('span' => 4, 'maxlength' => 255)); ?>

            <?php
            echo $form->dropDownListControlGroup($model, 'kecamatan_id', $model->kecamatanOptions, array('span' => 3, 'empty' => Yii::t('trans', '- Pilih Kecamatan -'), 'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('wajibPajak/dynamicKelurahan'),
                    'update' => '#WajibPajak_kelurahan_id',
            )));
            ?>

            <?php echo $form->dropDownListControlGroup($model, 'kelurahan_id', $model->kelurahanOptions, array('span' => 3, 'empty' => Yii::t('trans', '- Pilih Kelurahan -'))); ?>

            <?php echo $form->textFieldControlGroup($model, 'telepon', array('span' => 2, 'maxlength' => 20)); ?>

            <?php echo $form->textFieldControlGroup($model, 'kodepos', array('span' => 1, 'maxlength' => 5)); ?>

            <?php echo $form->dropDownListControlGroup($model, 'warga_negara', $model->wargaNegaraOptions, array('span' => 2)); ?>

            <?php echo $form->dropDownListControlGroup($model, 'id_jenis', $model->idJenisOptions, array('span' => 1)); ?>

            <?php echo $form->textFieldControlGroup($model, 'id_nomor', array('span' => 3, 'maxlength' => 255)); ?>

            <?php
            echo $form->datePickerControlGroup($model, 'tanggal_lahir', array('span' => 2, 'pluginOptions' => array(
                    'format' => 'dd/mm/yyyy',
                    'endDate' => date('d/m/Y'),
            )));
            ?>  
        </div>
        <div class="span5">
            <?php echo $form->textFieldControlGroup($model, 'kk_nomor', array('span' => 4, 'maxlength' => 255)); ?>

            <?php
            echo $form->datePickerControlGroup($model, 'kk_tanggal', array('span' => 2, 'pluginOptions' => array(
                    'format' => 'dd/mm/yyyy',
                    'endDate' => date('d/m/Y'),
            )));
            ?>  

            <?php echo $form->textFieldControlGroup($model, 'pekerjaan', array('span' => 4, 'maxlength' => 255)); ?>

            <?php echo $form->textAreaControlGroup($model, 'alamat_pekerjaan', array('rows' => 3, 'span' => 4)); ?>

            <?php echo $form->dropDownListControlGroup($model, 'bidang_usaha_id', $model->bidangUsahaOptions, array('span' => 3, 'empty' => Yii::t('trans', '- Pilih Bidang Usaha -'))); ?>

            <?php echo $form->textFieldControlGroup($model, 'bu_nama', array('span' => 4, 'maxlength' => 255)); ?>

            <?php echo $form->textAreaControlGroup($model, 'bu_alamat', array('rows' => 3, 'span' => 4)); ?>

            <?php echo $form->textFieldControlGroup($model, 'bu_kabupaten', array('span' => 4, 'maxlength' => 255)); ?>

            <?php echo $form->textFieldControlGroup($model, 'bu_kecamatan', array('span' => 4, 'maxlength' => 255)); ?>

            <?php echo $form->textFieldControlGroup($model, 'bu_kelurahan', array('span' => 4, 'maxlength' => 255)); ?>

            <?php echo $form->textFieldControlGroup($model, 'bu_telepon', array('span' => 4, 'maxlength' => 20)); ?>

            <?php echo $form->textFieldControlGroup($model, 'bu_kodepos', array('span' => 4, 'maxlength' => 5)); ?>
        </div>
    </div>
    <div class="form-actions">
        <?php
        echo TbHtml::submitButton($model->isNewRecord ? Yii::t('trans', 'Create') : Yii::t('trans', 'Save'), array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_DEFAULT,
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->