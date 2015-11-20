<?php
/* @var $this OperationController */
/* @var $model Operation */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'operation-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,'htmlOptions' => array('class' => 'form-horizontal'),
    ));
    ?>

    <p class="help-block"><?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?></p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'name', array('span' => 5, 'maxlength' => 255)); ?>
    <?php echo $form->textFieldControlGroup($model, 'description', array('span' => 5, 'maxlength' => 255)); ?>
    <?php echo $form->textFieldControlGroup($model, 'nama_modul', array('span' => 2, 'maxlength' => 20)); ?>
    <?php echo $form->dropdownListControlGroup($model, 'grup', $model->grupOptions, array('span' => 2, 'empty' => '')); ?>
    <?php echo $form->textFieldControlGroup($model, 'urutan_ke', array('span' => 1)); ?>
    <?php echo $form->checkBoxControlGroup($model, 'tampilkan_dirole', array('span' => 1)); ?>

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