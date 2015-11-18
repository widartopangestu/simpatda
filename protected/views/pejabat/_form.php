<?php
/* @var $this PejabatController */
/* @var $model Pejabat */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
        'id' => 'pejabat-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="help-block"><?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?></p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'kode', array('span' => 5, 'maxlength' => 2)); ?>

    <?php echo $form->textFieldControlGroup($model, 'nama', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'nip', array('span' => 5, 'maxlength' => 30)); ?>

    <?php echo $form->checkBoxControlGroup($model, 'status'); ?>

    <?php echo $form->textFieldControlGroup($model, 'golongan_id', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'jabatan_id', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'pangkat_id', array('span' => 5)); ?>

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