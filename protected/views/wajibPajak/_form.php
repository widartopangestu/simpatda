<?php
/* @var $this WajibPajakController */
/* @var $model WajibPajak */
/* @var $form TbActiveForm */
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
    ));
    ?>

    <p class="help-block"><?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?></p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListControlGroup($model, 'jenis', $model->jenisOptions, array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'golongan', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'nomor', array('span' => 5, 'maxlength' => 7)); ?>

    <?php echo $form->textFieldControlGroup($model, 'nama', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textAreaControlGroup($model, 'alamat', array('rows' => 3, 'span' => 4)); ?>

    <?php echo $form->textFieldControlGroup($model, 'kabupaten', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->dropDownListControlGroup($model, 'kecamatan_id', $model->kecamatanOptions, array('span' => 5, 'empty' => Yii::t('trans', '- Pilih Kecamatan -'), 'ajax' => array(
            'type' => 'POST', 
            'url' => CController::createUrl('wajibPajak/dynamicKelurahan'), 
            'update' => '#WajibPajak_kelurahan_id',
    ))); ?>

    <?php echo $form->dropDownListControlGroup($model, 'kelurahan_id', array(), array('span' => 5, 'empty' => Yii::t('trans', '- Pilih Kelurahan -'))); ?>

    <?php echo $form->textFieldControlGroup($model, 'telepon', array('span' => 5, 'maxlength' => 20)); ?>

    <?php echo $form->dropDownListControlGroup($model, 'status', $model->statusOptions, array('span' => 5)); ?>

    <?php
    echo $form->datePickerControlGroup($model, 'tanggal_tutup', array('span' => 2, 'pluginOptions' => array(
            'format' => 'dd/mm/yyyy',
            'endDate' => date('d/m/Y'),
    )));
    ?>  

    <?php echo $form->textFieldControlGroup($model, 'kodepos', array('span' => 5, 'maxlength' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'id_jenis', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'id_nomor', array('span' => 5, 'maxlength' => 255)); ?>

    <?php
    echo $form->datePickerControlGroup($model, 'tanggal_lahir', array('span' => 2, 'pluginOptions' => array(
            'format' => 'dd/mm/yyyy',
            'endDate' => date('d/m/Y'),
    )));
    ?>  
    <?php echo $form->textFieldControlGroup($model, 'kk_nomor', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'kk_tanggal', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'pekerjaan', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textAreaControlGroup($model, 'alamat_pekerjaan', array('rows' => 3, 'span' => 4)); ?>

    <?php echo $form->textFieldControlGroup($model, 'bu_nama', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textAreaControlGroup($model, 'bu_alamat', array('rows' => 3, 'span' => 4)); ?>

    <?php echo $form->textFieldControlGroup($model, 'bu_kabupaten', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'bu_kecamatan', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'bu_kelurahan', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'bu_telepon', array('span' => 5, 'maxlength' => 20)); ?>

    <?php echo $form->textFieldControlGroup($model, 'bu_kodepos', array('span' => 5, 'maxlength' => 5)); ?>

    <?php echo $form->dropDownListControlGroup($model, 'bidang_usaha_id', $model->bidangUsahaOptions, array('span' => 5)); ?>

    <?php echo $form->dropDownListControlGroup($model, 'warga_negara', $model->wargaNegaraOptions, array('span' => 5)); ?>

    <div class="form-actions">
        <?php
        echo TbHtml::submitButton($model->isNewRecord ? Yii::t('trans', 'Create') : Yii::t('trans', 'Save'), array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->