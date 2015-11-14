<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Laporan') => array('menu/jlaporan'),
    Yii::t('trans', 'Master') => array('report/jmaster'),
    Yii::t('trans', 'Master User'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Master User');
$this->menu = array(
);
?>
<div class="widget ">

    <div class="widget-header">
        <i class="icon-list-alt"></i>
        <h3><?php echo Yii::t('trans', 'Report') . ' ' . Yii::t('trans', 'Master User'); ?></h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">
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
            <?php echo $form->dropdownListControlGroup($model, 'status', $model->statusOptions, array('span' => 2, 'empty' => Yii::t('trans', '--Semua Status--'))); ?>
            <?php echo $form->dropdownListControlGroup($model, 'role_id', $model->roleOptions, array('span' => 2, 'empty' => Yii::t('trans', '--Semua Role--'))); ?>
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
    </div>
</div>