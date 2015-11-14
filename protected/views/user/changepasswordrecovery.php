<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Change Password Recovery');
$this->breadcrumbs = array(
    Yii::t('trans', 'Profile') => array('/user/profile'),
    Yii::t('trans', 'Change Password'),
);
$this->title = Yii::t('trans', 'Change Password');
?>


<div class="account-container">
    <div class="content clearfix">  

        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'user-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        ));
        ?>
        <h1><?php echo Yii::t('trans', 'Change Password'); ?></h1>

        <p class="help-block"><?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?></p>
        <?php echo $form->errorSummary($model); ?>

        <p class="hint">
            <?php echo Yii::t('trans', 'Minimal password length {lengt} symbols.', array('{lengt}' => 4)); ?>
        </p>
        <div class="login-fields">
            <?php echo $form->passwordFieldControlGroup($model, 'password', array('placeholder' => 'Password', 'class' => 'login')); ?>
            <?php echo $form->passwordFieldControlGroup($model, 'repeatpassword', array('placeholder' => 'Repeat Password', 'class' => 'login')); ?>
        </div>
        <div class="login-actions">
            <?php
            echo TbHtml::submitButton(Yii::t('trans', Yii::t('trans', 'Save')), array('class' => 'button btn btn-success btn-large'));
            ?>
        </div>

        <?php $this->endWidget(); ?>

    </div> <!-- /content -->

</div> <!-- /account-container -->

<div class="login-extra">
    <?php echo TbHtml::link(Yii::t('trans', 'Forgot Password'), array('/user/recovery')) ?>
</div>