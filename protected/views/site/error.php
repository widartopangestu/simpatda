<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Error');
$this->breadcrumbs = array(
    Yii::t('trans', 'Error'),
);
?>
<div class="error-container">
    <h1><?php echo $code; ?></h1>
    <h2><?php echo CHtml::encode($message); ?></h2>
    <div class="error-details">
        <?php echo Yii::t('trans', 'Sorry, an error has occured! Why not try going back to the <a href="{url}">home page</a> or perhaps try following!', array('{url}' => Yii::app()->request->baseUrl));?>
    </div> <!-- /error-details -->
    <div class="error-actions">
        <a href="<?php echo Yii::app()->request->baseUrl . '/dashboard'; ?>" class="btn btn-large btn-primary">
            <i class="icon-chevron-left"></i>
            &nbsp;
            <?php echo Yii::t('trans', 'Back to Dashboard');?>						
        </a>
    </div> <!-- /error-actions -->
</div> <!-- /error-container -->			
