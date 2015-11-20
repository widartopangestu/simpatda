<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Profile') => array('profile'),
    Yii::t('trans', 'Change Password'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Change Photo');
$this->modulTitle = Yii::t('trans', 'Change Password'); 
$this->menu = array(
    array('label' => Yii::t('trans', 'Profile'), 'url' => array('profile'), 'icon' => TbHtml::ICON_USER),
    array('label' => Yii::t('trans', 'Edit Profile'), 'url' => array('edit'), 'icon' => TbHtml::ICON_PENCIL),
    array('label' => Yii::t('trans', 'Change Password'), 'url' => array('changePassword'), 'icon' => TbHtml::ICON_COG),
);
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'changeimage-form',
//            'enableAjaxValidation' => true,
//            'clientOptions' => array(
//                'validateOnSubmit' => true,
//            ),
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'form-vertical'),
        ));
?>

<p class="help-block"><?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?></p>
<?php echo $form->errorSummary($model); ?>

<div class="control-group">
    <?php
    if ($model->getOldPhoto() != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->params['upload_image_profile'] . $model->getOldPhoto()))
        echo CHtml::image(Yii::app()->request->baseUrl . Yii::app()->params['upload_image_profile'] . $model->getOldPhoto(), "", array("style" => "width:125px;height:200px;"));
    else
        echo CHtml::image(Yii::app()->request->baseUrl . Yii::app()->params['upload_image_profile'] . 'no_image.jpg', "", array("style" => "width:125px;height:200px;"));
    ?>
</div>

<div class="control-group">
    <?php echo $form->labelEx($model, 'image'); ?>
    <div class="controls">
        <?php echo $form->fileField($model, 'image', array('class' => 'span9')); ?>
        <?php echo $form->error($model, 'image'); ?>
    </div>
    <span class="help-inline">
        <?php echo Yii::t('trans', 'Maximal image size 2mb.'); ?>
    </span>
</div>


<div class="form-actions">
    <?php echo TbHtml::submitButton(Yii::t('trans', 'Upload'), array('class' => 'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>