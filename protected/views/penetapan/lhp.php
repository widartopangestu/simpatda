<?php
/* @var $this PenetapanController */
/* @var $model Penetapan */
?>

<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Penetapan') => array('index'),
    Yii::t('trans', 'Form Penetapan LHP'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Form Penetapan LHP');
$this->modulTitle = Yii::t('trans', 'Form Penetapan LHP');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('penetapan.index')) ? true : false),
);
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
        'id' => 'penetapan-lhp-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'form-horizontal'),
    ));
    ?>

    <p class="help-block"><?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?></p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'periode', array('span' => 1)); ?>
    <?php echo $form->textFieldSdControlGroup($model, 'pemeriksaan_from', 'pemeriksaan_to', array('span' => 2), array('span' => 2)); ?>
    <?php
    echo $form->datePickerControlGroup($model, 'tanggal_penetapan', array('span' => 2, 'pluginOptions' => array(
            'format' => 'dd/mm/yyyy'
    )));
    ?>

    <div class="form-actions">
        <?php
        echo TbHtml::submitButton(Yii::t('trans', 'Tetapkan'), array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_DEFAULT,
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->