<?php
/* @var $this SetoranPajakController */
/* @var $model SetoranPajak */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
        'id' => 'setoran-pajak-form',
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
            <?php // echo $form->textFieldControlGroup($model,'nomor',array('span'=>5)); ?>

            <?php
            if (!empty($model->penetapan_id)) {
                $m = Penetapan::model()->findByPk($model->penetapan_id);
                $model->kohir = $m->kohir;
            }
            echo $form->select2ActiveTextFieldControlGroup($model, 'kohir', array(
                'style' => 'width:300px',
                'onChange' => 'fillData($(this).val());',
                'options' => array(
                    'allowClear' => true,
                    'placeholder' => Yii::t('trans', 'Ketik nomor kohir'),
                    'ajax' => array(
                        'url' => Yii::app()->createUrl('penetapan/jsonKohir'),
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
                    'initSelection' => empty($model->penetapan_id) ? null : 'js:function(element,callback){
                        callback({id:' . $model->penetapan_id . ',text:"' . $model->kohir . ' [' . $model->penetapan->spt->periode . ' - ' . $model->penetapan->jenisSurat->singkatan . '] ' . $model->penetapan->spt->wajibpajak->npwpd . ' ' . $model->penetapan->spt->wajibpajak->nama . '"});
                    }',
                )
            ));
            ?>

            <?php echo $form->hiddenField($model, 'penetapan_id'); ?>

            <?php
            echo $form->datePickerControlGroup($model, 'tanggal_bayar', array('span' => 2, 'pluginOptions' => array(
                    'format' => 'dd/mm/yyyy'
            )));
            ?>

            <?php echo $form->dropDownListControlGroup($model, 'via_bayar', $model->viaBayarOptions, array('span' => 3)); ?>

            <?php echo $form->textFieldControlGroup($model, 'nama_penyetor', array('span' => 3, 'maxlength' => 255)); ?>
            <?php echo $form->textFieldControlGroup($model, 'tanggal_jatuh_tempo', array('span' => 2, 'maxlength' => 255, 'readonly' => true)); ?>
        </div>
        <div class="span5">            
            <?php echo $form->textFieldControlGroup($model, 'nama', array('span' => 3, 'maxlength' => 255, 'readonly' => true)); ?>

            <?php echo $form->textAreaControlGroup($model, 'alamat', array('rows' => 3, 'span' => 3, 'readonly' => true)); ?>

            <?php echo $form->textFieldControlGroup($model, 'kabupaten', array('span' => 3, 'maxlength' => 255, 'readonly' => true)); ?>

            <?php echo $form->textFieldControlGroup($model, 'kecamatan', array('span' => 3, 'maxlength' => 255, 'readonly' => true)); ?>

            <?php echo $form->textFieldControlGroup($model, 'kelurahan', array('span' => 3, 'maxlength' => 255, 'readonly' => true)); ?>

        </div>
        <div id="List_spt" class="span11">
            <table class="table table-striped" cellpadding="8" cellspacing="0">
                <thead>
                    <?php
                    echo '<tr>';
                    echo '<th>' . Yii::t('app', 'No') . '</th>';
                    echo '<th>' . Yii::t('biaya', 'Kode Rekening') . '</th>';
                    echo '<th>' . Yii::t('biaya', 'Nama Rekening') . '</th>';
                    echo '<th>' . Yii::t('biaya', 'Jumlah (Rp.)') . '</th>';
                    echo '</tr>';
                    ?>
                </thead>
                <tbody>
                    <?php
                    if ($model->penetapan_id) {
                        $i = 1;
                        foreach ($model->penetapan->spt->sptItems as $spt) {
                            echo '<tr>';
                            echo '<td>' . $i++ . '</td>';
                            echo '<td>' . $spt->kodeRekening->kode . '</td>';
                            echo '<td>' . $spt->kodeRekening->nama . '</td>';
                            echo '<td>' . number_format($spt->pajak, Yii::app()->params['currency_precision']) . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr>';
                        echo '<td colspan="4">' . Yii::t('trans', 'There is no item.') . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="span5">    
        </div>
        <div class="span5">     
            <?php echo $form->textFieldControlGroup($model, 'jumlah_pajak', array('span' => 3, 'readonly' => true, 'style' => "text-align: right")); ?>
            <?php echo $form->maskMoneyControlGroup($model, 'jumlah_potongan', array('class' => 'span3', 'onkeyup' => 'getValue();', 'style' => "text-align: right")); ?>
            <?php echo $form->textFieldControlGroup($model, 'jumlah_bayar', array('span' => 3, 'readonly' => true, 'style' => "text-align: right;font-size: 20px;font-weight: bold;")); ?>
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

</div><!-- form --><script type="text/javascript">
    var timer;
    jQuery(document).ready(function () {
        getValue();
        if (jQuery("#SetoranPajak_penetapan_id").val())
            fillData(jQuery("#SetoranPajak_penetapan_id").val());
    });
    function fillData(id) {
        jQuery.ajax({'type': 'POST', 'url': '<?php echo $this->createUrl('setoranPajak/jsonGetData'); ?>/?id=' + id, 'cache': false, dataType: 'json', 'data': null}).done(function (data) {
            jQuery("#SetoranPajak_penetapan_id").val(data.penetapan_id);
            jQuery("#SetoranPajak_nama").val(data.nama);
            jQuery("#SetoranPajak_alamat").val(data.alamat);
            jQuery("#SetoranPajak_kabupaten").val(data.kabupaten);
            jQuery("#SetoranPajak_kecamatan").val(data.kecamatan);
            jQuery("#SetoranPajak_kelurahan").val(data.kelurahan);
            jQuery("#SetoranPajak_tanggal_jatuh_tempo").val(data.tanggal_jatuh_tempo);
            jQuery("#SetoranPajak_jumlah_pajak").val(data.jumlah_pajak);
            getValue();
        });
        jQuery.ajax({'type': 'POST', 'url': '<?php echo $this->createUrl('setoranPajak/dynamicDataSpt'); ?>/?id=' + id, 'cache': false, dataType: 'html', 'data': null}).done(function (data) {
            jQuery("#List_spt").html(data);
        });
    }
    function getValue() {
        clearInterval(timer);  //clear any interval on key up
        timer = setTimeout(function () { //then give it a second to see if the user is finished
            jQuery.ajax({'type': 'POST', 'url': '<?php echo $this->createUrl('setoranPajak/ajaxGetValue'); ?>', 'cache': false, dataType: 'json', 'data': $('#setoran-pajak-form').serialize()}).done(function (data) {
                jQuery("#SetoranPajak_jumlah_bayar").val(data.jumlah_bayar);
            });
        }, 1000);
    }
</script>