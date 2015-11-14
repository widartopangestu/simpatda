<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Registration');
?>


<div class="account-container register">

    <div class="content clearfix">

        <?php if (Yii::app()->user->hasFlash('registration')): ?>
            <div class="success">
                <?php echo Yii::app()->user->getFlash('registration'); ?>
            </div>
        <?php else: ?>

            <?php
            $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
                'id' => 'user-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'enableAjaxValidation' => false,
            ));
            ?>

            <h1><?php echo Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Account'); ?></h1>
            <?php echo $form->errorSummary($model); ?>
            <div class="login-fields">
                <p class="help-block"><?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?></p>


                <?php echo $form->textFieldControlGroup($model, 'username', array('span' => 5, 'maxlength' => 255, 'placeholder' => Yii::t('trans', 'Username'), 'class' => 'login')); ?>

                <?php echo $form->passwordFieldControlGroup($model, 'password', array('span' => 5, 'maxlength' => 255, 'autocomplete' => 'off', 'placeholder' => Yii::t('trans', 'Password'), 'class' => 'login')); ?>

                <?php echo $form->passwordFieldControlGroup($model, 'repeatpassword', array('span' => 5, 'maxlength' => 255, 'placeholder' => Yii::t('trans', 'Repeat Password'), 'class' => 'login')); ?>

                <?php echo $form->textFieldControlGroup($model, 'email', array('span' => 3, 'maxlength' => 255, 'placeholder' => Yii::t('trans', 'Email'), 'class' => 'login')); ?>

                <?php $this->widget('CCaptcha'); ?>

                <?php echo $form->textFieldControlGroup($model, 'verifyCode', array('placeholder' => Yii::t('trans', 'Verification Code'), 'class' => 'login')); ?>

                <p class="hint"><?php echo Yii::t('trans', 'Please enter the letters as they are shown in the image above.'); ?>
                    <br/><?php echo Yii::t('trans', 'Letters are not case-sensitive.'); ?></p>

            </div>
            <div class="login-actions">
                <?php echo TbHtml::submitButton(Yii::t('trans', 'Register'), array('class' => 'button btn btn-primary btn-large')); ?>
            </div>

            <?php $this->endWidget(); ?>

        <?php endif; ?>
    </div>
</div>
<div class="login-extra">
    <?php echo Yii::t('trans', 'Already have an account? ') . CHtml::link(Yii::t('trans', 'Login to your account'), Yii::app()->user->loginUrl); ?>
</div> <!-- /login-extra -->