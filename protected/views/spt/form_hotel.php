<?php
/* @var $this SptController */
/* @var $model Spt */
?>

<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'SPTPD') => array('index'),
    Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'SPTPD Pajak Hotel'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'SPTPD Pajak Hotel');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'SPTPD Pajak Hotel');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index', 'jenis' => Spt::JENIS_PAJAK_HOTEL), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('spt.index')) ? true : false),
);
?>
<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
        'id' => 'spt-form',
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
            <?php echo $form->textFieldControlGroup($model, 'nomor', array('span' => 3)); ?>

            <?php echo $form->textFieldControlGroup($model, 'periode', array('span' => 1, 'maxlength' => 4)); ?>

            <?php
            echo $form->datePickerControlGroup($model, 'tanggal_proses', array('span' => 2, 'pluginOptions' => array(
                    'format' => 'dd/mm/yyyy',
                    'endDate' => date('d/m/Y'),
            )));
            ?>  

            <?php
            echo $form->datePickerControlGroup($model, 'tanggal_entry', array('span' => 2, 'pluginOptions' => array(
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
                    'initSelection' => $model->isNewRecord ? null : 'js:function(element,callback){
                        callback({id:' . $model->wajib_pajak_id . ',text:"' . $model->npwpd . '"});
                    }',
                )
            ));
            ?>

            <?php echo $form->hiddenField($model, 'wajib_pajak_id'); ?>

            <?php echo $form->textFieldControlGroup($model, 'nama', array('span' => 3, 'maxlength' => 255, 'readonly' => true)); ?>

            <?php echo $form->textAreaControlGroup($model, 'alamat', array('rows' => 3, 'span' => 3, 'readonly' => true)); ?>

            <?php echo $form->textFieldControlGroup($model, 'kabupaten', array('span' => 3, 'maxlength' => 255, 'readonly' => true)); ?>

            <?php echo $form->textFieldControlGroup($model, 'kecamatan', array('span' => 3, 'maxlength' => 255, 'readonly' => true)); ?>

            <?php echo $form->textFieldControlGroup($model, 'kelurahan', array('span' => 3, 'maxlength' => 255, 'readonly' => true)); ?>
        </div>
        <div class="span5">
            <?php echo $form->dropDownListControlGroup($model, 'jenis_pemungutan', $model->jenisPemungutanOptions, array('span' => 3)); ?>

            <?php
            echo $form->datePickerControlGroup($model, 'periode_awal', array('span' => 2, 'pluginOptions' => array(
                    'format' => 'dd/mm/yyyy',
            )));
            ?>  

            <?php
            echo $form->datePickerControlGroup($model, 'periode_akhir', array('span' => 2, 'pluginOptions' => array(
                    'format' => 'dd/mm/yyyy',
            )));
            ?>  

            <?php // echo $form->textFieldControlGroup($model, 'jenis_pajak', array('span' => 3)); ?>

            <?php echo $form->dropdownListControlGroup($model, 'kode_rekening_id', KodeRekening::model()->getParentTreeOptions(Spt::PARENT_HOTEL), array('span' => 3, 'empty' => Yii::t('trans', '-- Pilih Kode Rekening --'), 'onchange' => 'getNamaRekening($(this).val())')); ?>

            <?php echo $form->textFieldControlGroup($model, 'nama_kode_rekening', array('span' => 3, 'maxlength' => 255, 'readonly' => true)); ?>

            <?php echo $form->maskMoneyControlGroup($model, 'nilai', array('span' => 3, 'style' => "text-align: right")); ?>

            <?php // echo $form->textFieldControlGroup($model, 'tarif_dasar', array('span' => 3)); ?>

            <?php echo $form->textFieldControlGroup($model, 'tarif_persen', array('span' => 1, 'readonly' => 'readonly')); ?>

            <?php echo $form->maskMoneyControlGroup($model, 'pajak', array('span' => 3, 'readonly' => 'readonly', 'style' => "text-align: right;font-size: 20px;font-weight: bold;")); ?>

            <?php echo $form->textAreaControlGroup($model, 'uraian', array('rows' => 3, 'span' => 4)); ?>

        </div>
    </div>
    <div class="form-actions">
        <?php
        echo TbHtml::submitButton($model->isNewRecord ? Yii::t('trans', 'Create') : Yii::t('trans', 'Save'), array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_DEFAULT,
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    var timer;
    jQuery(document).ready(function () {
        getNamaRekening(jQuery("#Spt_kode_rekening_id").val());
        if (jQuery("#Spt_wajib_pajak_id").val())
            fillData(jQuery("#Spt_wajib_pajak_id").val());
    });
    function getNamaRekening(id) {
        jQuery.ajax({'type': 'POST', 'url': '<?php echo $this->createUrl('spt/jsonGetKodeRekening'); ?>/?id=' + id, 'cache': false, dataType: 'json', 'data': null}).done(function (data) {
            jQuery("#Spt_nama_kode_rekening").val(data.nama);
            jQuery("#Spt_tarif_persen").val(data.tarif_persen);
            getValueHotel();
        });
    }
    function fillData(id) {
        jQuery.ajax({'type': 'POST', 'url': '<?php echo $this->createUrl('wajibPajak/jsonGetData'); ?>/?id=' + id, 'cache': false, dataType: 'json', 'data': null}).done(function (data) {
            jQuery("#Spt_wajib_pajak_id").val(data.id);
            jQuery("#Spt_nama").val(data.nama);
            jQuery("#Spt_alamat").val(data.alamat);
            jQuery("#Spt_kabupaten").val(data.kabupaten);
            jQuery("#Spt_kecamatan").val(data.kecamatan);
            jQuery("#Spt_kelurahan").val(data.kelurahan);
            console.log(data);
        });
    }
    jQuery('#Spt_nilai').keyup(function (e) {
        clearInterval(timer);  //clear any interval on key up
        timer = setTimeout(function () { //then give it a second to see if the user is finished
            getValueHotel();
        }, 1000);
    });
    function getValueHotel() {
        jQuery.ajax({'type': 'POST', 'url': '<?php echo $this->createUrl('spt/ajaxGetValueHotel'); ?>', 'cache': false, dataType: 'json', 'data': $('#spt-form').serialize()}).done(function (data) {
            jQuery("#Spt_pajak").val(data.pajak);
            jQuery("#Spt_nilai").val(data.nilai);
        });
    }
</script>