<?php
/**
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form TbActiveForm */
<?php echo "?>\n"; ?>

<div class="form">

    <?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.FTActiveForm', array(
	'id'=>'" . $this->class2id($this->modelClass) . "-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('class' => 'form-horizontal'),
)); ?>\n"; ?>

    <p class="help-block"><?php echo "<?php echo Yii::t('trans', 'Fields with'); ?>"; ?> <span class="required">*</span> <?php echo "<?php echo Yii::t('trans', 'are required.'); ?>"; ?></p>

    <?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

    <?php
    foreach ($this->tableSchema->columns as $column) {
        if ($column->autoIncrement) {
            continue;
        }
        ?>
        <?php echo "<?php echo " . $this->generateActiveControlGroup($this->modelClass, $column) . "; ?>\n"; ?>

    <?php
    }
    ?>
    <div class="form-actions">
        <?php echo "<?php echo TbHtml::submitButton(\$model->isNewRecord ? Yii::t('trans', 'Create') : Yii::t('trans', 'Save'),array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
		)); ?>\n"; ?>
    </div>

    <?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->