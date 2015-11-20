<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Profile') => array('profile'),
    Yii::t('trans', 'Change Password'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Change Password');
$this->modulTitle = Yii::t('trans', 'Change Password'); 
$this->menu = array(
    array('label' => Yii::t('trans', 'Profile'), 'url' => array('profile'), 'icon' => TbHtml::ICON_USER),
    array('label' => Yii::t('trans', 'Edit Profile'), 'url' => array('edit'), 'icon' => TbHtml::ICON_PENCIL),
    array('label' => Yii::t('trans', 'Change Photo'), 'url' => array('changePhoto'), 'icon' => TbHtml::ICON_PICTURE),
);
?>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'login-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block"><?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?></p>
<?php echo $form->errorSummary($model); ?>

<?php echo $form->passwordFieldControlGroup($model, 'oldPassword'); ?>
<?php echo $form->passwordFieldControlGroup($model, 'password'); ?>
<p class="hint">
    <?php echo Yii::t('trans', 'Minimal password length {lengt} symbols.', array('{lengt}' => 4)); ?>
</p>
<?php echo $form->passwordFieldControlGroup($model, 'repeatpassword'); ?>

<div class="form-actions">
    <?php echo TbHtml::submitButton(Yii::t('trans', 'Save'), array('class' => 'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>