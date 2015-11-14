<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Login');
$this->breadcrumbs = array(
    Yii::t('trans', 'Login'),
);
?>

<div class="account-container">
    <div class="content clearfix">     		
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
        <h1>
            <?php echo Yii::t('trans', 'User Login.'); ?>
        </h1>
        <div class="login-fields">

            <p><?php echo Yii::t('trans', 'Please provide your details'); ?></p>

            <?php //echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model, 'username', array('span' => 5, 'maxlength' => 255, 'placeholder' => 'Username or Email', 'class' => 'login username-field')); ?>

            <?php echo $form->passwordFieldControlGroup($model, 'password', array('span' => 5, 'maxlength' => 255, 'placeholder' => 'Password', 'class' => 'login password-field')); ?>
        </div>

        <div class="login-actions">
            <span class="login-checkbox">
                <?php echo $form->checkBoxControlGroup($model, 'rememberMe', array('span' => 5, 'class' => 'field login-checkbox')); ?>
            </span>
            <?php
            echo TbHtml::submitButton(Yii::t('trans', 'Login'), array('class' => 'button btn btn-success btn-large'));
            ?>
        </div>

        <?php $this->endWidget(); ?>

    </div> <!-- /content -->

</div> <!-- /account-container -->

<div class="login-extra">
    <?php echo TbHtml::link(Yii::t('trans', 'Forgot Password'), array('/user/recovery')) ?>
</div>