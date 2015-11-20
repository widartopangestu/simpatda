<?php
/* @var $this JenisSuratController */
/* @var $model JenisSurat */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
        'id' => 'jenis-surat-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,'htmlOptions' => array('class' => 'form-horizontal'),
    ));
    ?>

    <p class="help-block"><?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?></p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'kode', array('span' => 4, 'maxlength' => 1)); ?>

    <?php echo $form->textFieldControlGroup($model, 'nama', array('span' => 4, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'singkatan', array('span' => 4, 'maxlength' => 20)); ?>

    <?php echo $form->checkBoxControlGroup($model, 'is_official'); ?>

    <?php echo $form->checkBoxControlGroup($model, 'is_self'); ?>

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