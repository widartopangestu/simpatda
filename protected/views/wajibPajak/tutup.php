<?php
/* @var $this WajibPajakController */
/* @var $model WajibPajak */
?>

<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Wajib Pajak') => array('index'),
    Yii::t('trans', 'Tutup'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Tutup') . ' ' . Yii::t('trans', 'Wajib Pajak');
$this->modulTitle = Yii::t('trans', 'Tutup') . ' ' . Yii::t('trans', 'Wajib Pajak');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('wajibPajak.index')) ? true : false),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('wajibPajak.create')) ? true : false),
);
?>
<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
        'id' => 'wajib-pajak-form',
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
    <div class="row">
        <div class="span5">
            <?php echo $form->hiddenField($model, 'wajib_pajak_id'); ?>

            <?php
            echo $form->datePickerControlGroup($model, 'tanggal_tutup', array('span' => 2, 'pluginOptions' => array(
                    'format' => 'dd/mm/yyyy',
                    'endDate' => date('d/m/Y'),
            )));
            ?>  

            <?php
            echo $form->select2ActiveTextFieldControlGroup($model, 'npwpd', array(
                'style' => 'width:300px',
                'onChange' => 'fillData($(this).val());',
                'options' => array(
                    'allowClear' => true,
                    'placeholder' => Yii::t('trans', 'Ketik nama atau npwpd'),
                    'ajax' => array(
                        'url' => Yii::app()->createUrl('wajibPajak/jsonNpwpd'),
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
                )
            ));
            ?>

            <?php echo $form->textFieldControlGroup($model, 'nama', array('span' => 3, 'maxlength' => 255, 'readonly' => true)); ?>

            <?php echo $form->textAreaControlGroup($model, 'alamat', array('rows' => 3, 'span' => 3, 'readonly' => true)); ?>

            <?php echo $form->textFieldControlGroup($model, 'kabupaten', array('span' => 3, 'maxlength' => 255, 'readonly' => true)); ?>

            <?php echo $form->textFieldControlGroup($model, 'kecamatan', array('span' => 3, 'maxlength' => 255, 'readonly' => true)); ?>

            <?php echo $form->textFieldControlGroup($model, 'kelurahan', array('span' => 3, 'maxlength' => 255, 'readonly' => true)); ?>
        </div>
        <div class="span5">
            <?php echo $form->textFieldControlGroup($model, 'no_ba', array('span' => 3, 'maxlength' => 255)); ?>

            <?php echo $form->textAreaControlGroup($model, 'isi_ba', array('rows' => 3, 'span' => 3)); ?>
        </div>
    </div>
    <div class="form-actions">
        <?php
        echo TbHtml::submitButton(Yii::t('trans', 'Save'), array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_DEFAULT,
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    jQuery(document).ready(function () {
        if (jQuery("#TutupWajibPajakForm_npwpd").val())
            fillData(jQuery("#TutupWajibPajakForm_npwpd").val());
    });
    function fillData(id) {
        jQuery.ajax({'type': 'POST', 'url': '<?php echo $this->createUrl('wajibPajak/jsonGetData'); ?>/?id=' + id, 'cache': false, dataType: 'json', 'data': null}).done(function (data) {
            jQuery("#TutupWajibPajakForm_wajib_pajak_id").val(data.id);
            jQuery("#TutupWajibPajakForm_nama").val(data.nama);
            jQuery("#TutupWajibPajakForm_alamat").val(data.alamat);
            jQuery("#TutupWajibPajakForm_kabupaten").val(data.kabupaten);
            jQuery("#TutupWajibPajakForm_kecamatan").val(data.kecamatan);
            jQuery("#TutupWajibPajakForm_kelurahan").val(data.kelurahan);
            console.log(data);
        });
    }
</script>