<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
        'id' => 'message-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="help-block"><?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?></p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model, 'id'); ?>
    <?php echo $form->hiddenField($model, 'language'); ?>
    <?php echo $form->textFieldControlGroup($model->source, 'category', array('disabled' => 'disabled', 'span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model->source, 'message', array('disabled' => 'disabled', 'span' => 5)); ?>

    <?php echo $form->textAreaControlGroup($model, 'translation', array('rows' => 2, 'cols' => 80, 'span' => 5)); ?>
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