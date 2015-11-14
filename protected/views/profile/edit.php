<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Edit Profile');
$this->menu = array(
    array('label' => Yii::t('trans', 'Profile'), 'url' => array('profile'), 'icon' => TbHtml::ICON_USER),
    array('label' => Yii::t('trans', 'Edit Profile'), 'url' => array('edit'), 'icon' => TbHtml::ICON_PENCIL),
    array('label' => Yii::t('trans', 'Change Password'), 'url' => array('changepassword'), 'icon' => TbHtml::ICON_COG),
    array('label' => Yii::t('trans', 'Change Photo'), 'url' => array('changePhoto'), 'icon' => TbHtml::ICON_PICTURE),
);
?>
<div class="widget ">

    <div class="widget-header">
        <i class="icon-user"></i>
        <h3><?php echo Yii::t('trans', 'Edit Profile'); ?></h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
            'id' => 'login-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
//            'htmlOptions' => array('class' => 'form-horizontal')
        ));
        ?>

        <p class="help-block"><?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?></p>

        <?php // echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldControlGroup($model, 'email', array('span' => 5, 'maxlength' => 255)); ?>

        <?php echo $form->textFieldControlGroup($model, 'fullname', array('span' => 5, 'maxlength' => 45)); ?>

        <?php echo $form->textFieldControlGroup($model, 'phone_1', array('span' => 5, 'maxlength' => 45)); ?>

        <?php echo $form->textFieldControlGroup($model, 'phone_2', array('span' => 5, 'maxlength' => 45)); ?>

        <?php echo $form->textAreaControlGroup($model, 'address', array('span' => 5, 'maxlength' => 45)); ?>

        <div class="form-actions">
            <?php echo TbHtml::submitButton(Yii::t('trans', 'Save'), array('class' => 'btn btn-primary')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>