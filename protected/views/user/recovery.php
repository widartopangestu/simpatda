<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Password Recovery');
$this->breadcrumbs = array(
    Yii::t('trans', 'Login') => array('/site/login'),
    Yii::t('trans', 'Password Recovery'),
);
?>

<div class="account-container">
    <div class="content clearfix"> 

        <?php if (Yii::app()->user->hasFlash('recoveryMessage')): ?>
            <div class="success">
                <?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
            </div>
        <?php else: ?>

            <?php echo TbHtml::beginForm(); ?>

            <h1><?php echo Yii::t('trans', 'Password Recovery'); ?></h1>
            <?php echo TbHtml::errorSummary($form); ?>

            <div class="login-fields">
                <?php echo TbHtml::activeTextFieldControlGroup($form, 'login_or_email', array('placeholder' => 'Email', 'class' => 'login')) ?>
                <p class="hint"><?php echo Yii::t('trans', 'Please enter your email addres.'); ?></p>
            </div>

            <div class="login-actions">
                <?php echo TbHtml::submitButton(Yii::t('trans', 'Reset'), array('class' => 'button btn btn-success btn-large')); ?>
            </div>

            <?php echo TbHtml::endForm(); ?>
        <?php endif; ?>

    </div> <!-- /content -->

</div> <!-- /account-container -->

<div class="login-extra">
</div>