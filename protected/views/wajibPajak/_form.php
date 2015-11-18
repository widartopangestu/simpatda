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

    <?php echo $form->textFieldControlGroup($model, 'jenis', array('span' => 5, 'maxlength' => 1)); ?>

    <?php echo $form->textFieldControlGroup($model, 'golongan', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'nomor', array('span' => 5, 'maxlength' => 7)); ?>

    <?php echo $form->textFieldControlGroup($model, 'nama', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textAreaControlGroup($model, 'alamat', array('rows' => 6, 'span' => 8)); ?>

    <?php echo $form->textFieldControlGroup($model, 'kabupaten', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'kecamatan', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'kelurahan', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'telepon', array('span' => 5, 'maxlength' => 20)); ?>

    <?php echo $form->checkBoxControlGroup($model, 'status'); ?>

    <?php echo $form->textFieldControlGroup($model, 'tanggal_tutup', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'kodepos', array('span' => 5, 'maxlength' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'id_jenis', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'id_nomor', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'tanggal_lahir', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'kk_nomor', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'kk_tanggal', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'pekerjaan', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textAreaControlGroup($model, 'alamat_pekerjaan', array('rows' => 6, 'span' => 8)); ?>

    <?php echo $form->textFieldControlGroup($model, 'bu_nama', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textAreaControlGroup($model, 'bu_alamat', array('rows' => 6, 'span' => 8)); ?>

    <?php echo $form->textFieldControlGroup($model, 'bu_kabupaten', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'bu_kecamatan', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'bu_kelurahan', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'bu_telepon', array('span' => 5, 'maxlength' => 20)); ?>

    <?php echo $form->textFieldControlGroup($model, 'bu_kodepos', array('span' => 5, 'maxlength' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'kelurahan_id', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'kecamatan_id', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'bidang_usaha_id', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'warga_negara', array('span' => 5, 'maxlength' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'created', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'updated', array('span' => 5)); ?>

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