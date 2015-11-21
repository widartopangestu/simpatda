<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Laporan') => array('menu/jlaporan'),
    Yii::t('trans', 'Master') => array('report/jmaster'),
    Yii::t('trans', 'Wajib Pajak'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Wajib Pajak');
$this->modulTitle = Yii::t('trans', 'Laporan') . ' ' . Yii::t('trans', 'Wajib Pajak');
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
    <?php echo $form->dropdownListControlGroup($model, 'jenis', $model->jenisOptions, array('span' => 2)); ?>
    <?php echo $form->dropdownListControlGroup($model, 'golongan', $model->golonganOptions, array('span' => 2, 'empty' => Yii::t('trans', '--Semua Golongan--'))); ?>
    <?php echo $form->dropdownListControlGroup($model, 'kode_rekening', $model->kodeRekeningOptions, array('span' => 5, 'empty' => Yii::t('trans', '--Semua Kode Rekening--'))); ?>
    <?php
    echo $form->dropDownListControlGroup($model, 'kecamatan', $model->kecamatanOptions, array('span' => 3, 'empty' => Yii::t('trans', '- Pilih Kecamatan -'), 'ajax' => array(
            'type' => 'POST',
            'url' => CController::createUrl('jReport/dynamicKelurahan'),
            'update' => '#JrWajibPajakForm_kelurahan',
    )));
    ?>
    <?php echo $form->dropDownListControlGroup($model, 'kelurahan', $model->kelurahanOptions, array('span' => 3, 'empty' => Yii::t('trans', '- Pilih Kelurahan -'))); ?>
    <?php echo $form->dropdownListControlGroup($model, 'mengetahui', $model->pejabatOptions, array('span' => 5)); ?>
    <?php echo $form->dropdownListControlGroup($model, 'diperiksa', $model->pejabatOptions, array('span' => 5)); ?>
    <?php
    echo $form->datePickerControlGroup($model, 'tanggal', array('span' => 2, 'pluginOptions' => array(
            'format' => 'dd/mm/yyyy',
            'endDate' => date('d/m/Y'),
    )));
    ?>  
    <?php echo $form->dropdownListControlGroup($model, 'status', $model->statusOptions, array('span' => 2, 'empty' => Yii::t('trans', '--Semua Status--'))); ?>
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