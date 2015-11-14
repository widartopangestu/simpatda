<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Backup') => array('index'),
    Yii::t('trans', 'Upload Backup') . ' ' . UploadForm::label(2),
);
?><div class="widget ">

    <div class="widget-header">
        <i class="icon-upload"></i>
        <h3><?php echo Yii::t('trans', 'Upload Backup'); ?></h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">
        <div class="form">

            <?php
            $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
                'id' => 'install-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'enableAjaxValidation' => true,
                'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
            ));
            ?>

            <p class="help-block"><?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?></p>

            <?php echo $form->errorSummary($model); ?>

            <?php echo $form->fileFieldControlGroup($model, 'upload_file', array('span' => 2, 'maxlength' => 255)); ?>


            <div class="form-actions">
                <?php
                echo TbHtml::submitButton(Yii::t('trans', 'Save'), array(
                    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                    'size' => TbHtml::BUTTON_SIZE_DEFAULT,
                ));
                ?>
            </div>

            <?php $this->endWidget(); ?>

        </div><!-- form -->
    </div>
</div>