<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Laporan') => array('menu/jlaporan'),
    Yii::t('trans', 'Master') => array('report/jmaster'),
    Yii::t('trans', 'Buku Pembantu Setoran Pajak Walet'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Buku Pembantu Setoran Pajak Walet');
$this->modulTitle = Yii::t('trans', 'Laporan') . ' ' . Yii::t('trans', 'Buku Pembantu Setoran Pajak Walet');
?>
<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
        'id' => 'jreport-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'htmlOptions' => array('class' => 'form-horizontal report'),
        'enableAjaxValidation' => false,
    ));
    ?>
    <p class="help-block"><?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?></p>
    <?php echo $form->errorSummary($model); ?>     
    <?php
    echo $form->datePickerSdControlGroup($model, 'date_from', 'date_to', array('span' => 2, 'pluginOptions' => array(
            'format' => 'dd/mm/yyyy',
    )), array('span' => 2, 'pluginOptions' => array(
            'format' => 'dd/mm/yyyy',
    )));
    ?>  
    <?php echo $form->dropdownListControlGroup($model, 'pembuat', $model->pejabatOptions, array('span' => 5)); ?>
    <?php echo $form->dropdownListControlGroup($model, 'mengetahui', $model->pejabatOptions, array('span' => 5)); ?>
    <div class="form-actions">
        <?php
        echo TbHtml::submitButton(Yii::t('trans', 'Preview'), array(
            'name' => 'status_report',
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_DEFAULT,
            'value' => 'submit'
        ));
        echo '&nbsp;';
        echo TbHtml::submitButton(Yii::t('trans', 'Export to PDF'), array(
            'name' => 'type_report',
            'color' => TbHtml::BUTTON_COLOR_DANGER,
            'size' => TbHtml::BUTTON_SIZE_DEFAULT,
            'value' => WPJasper::FORMAT_PDF
        ));
        echo '&nbsp;';
        echo TbHtml::submitButton(Yii::t('trans', 'Export to Excel'), array(
            'name' => 'type_report',
            'color' => TbHtml::BUTTON_COLOR_SUCCESS,
            'size' => TbHtml::BUTTON_SIZE_DEFAULT,
            'value' => WPJasper::FORMAT_EXCEL
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div>
<div class="preview-jasper">
    <?php echo $html_report; ?>    
</div>