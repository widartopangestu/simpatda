<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Penagihan'),
    Yii::t('trans', 'Cetak Surat Teguran'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Cetak Surat Teguran');
$this->modulTitle = Yii::t('trans', 'Penagihan') . ' ' . Yii::t('trans', 'Cetak Surat Teguran');
?>
<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
        'id' => 'surat-teguran-form',
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
    echo $form->select2ActiveTextFieldControlGroup($model, 'npwpd', array(
        'style' => 'width:300px',
        'onChange' => 'fillData($(this).val());',
        'options' => array(
            'allowClear' => true,
            'placeholder' => Yii::t('trans', 'Ketik nama atau npwpd'),
            'ajax' => array(
                'url' => Yii::app()->createUrl('penagihan/jsonNpwpd'),
                'dataType' => 'json',
                'quietMillis' => 100,
                'data' => 'js: function(text,page) {
                            return {
                                q: text, 
                                page_limit: 10,
                                page: page,
                            };
                        }',
                'results' => 'js:function(data,page) { var more = (page * 10) < data.total; return {results: data, more:more }; }',
            ),
            'initSelection' => empty($model->wajib_pajak_id) ? null : 'js:function(element,callback){
                        callback({id:' . $model->wajib_pajak_id . ',text:"' . WajibPajak::model()->findByPk($model->wajib_pajak_id)->npwpd . '"});
                    }',
        )
    ));
    ?>

    <?php echo $form->hiddenField($model, 'wajib_pajak_id'); ?>
    <?php echo $form->textFieldControlGroup($model, 'periode', array('span' => 1)); ?><?php
    echo $form->datePickerControlGroup($model, 'tanggal_proses', array('span' => 2, 'pluginOptions' => array(
            'format' => 'dd/mm/yyyy',
            'endDate' => date('d/m/Y'),
    )));
    ?>  
    <?php
    echo $form->datePickerControlGroup($model, 'tanggal', array('span' => 2, 'pluginOptions' => array(
            'format' => 'dd/mm/yyyy',
            'endDate' => date('d/m/Y'),
    )));
    ?>  
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
<script type="text/javascript">
    var timer;
    jQuery(document).ready(function () {
        if (jQuery("#SuratTeguranForm_wajib_pajak_id").val())
            fillData(jQuery("#SuratTeguranForm_wajib_pajak_id").val());
    });
    function fillData(id) {
        jQuery.ajax({'type': 'POST', 'url': '<?php echo $this->createUrl('wajibPajak/jsonGetData'); ?>/?id=' + id, 'cache': false, dataType: 'json', 'data': null}).done(function (data) {
            jQuery("#SuratTeguranForm_wajib_pajak_id").val(data.id);
        });
    }
</script>