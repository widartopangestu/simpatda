<?php
/* @var $this PemeriksaanController */
/* @var $model Pemeriksaan */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
        'id' => 'pemeriksaan-form',
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
            <?php
            if (!empty($model->wajib_pajak_id)) {
                $wp = WajibPajak::model()->findByPk($model->wajib_pajak_id);
                $model->npwpd = $wp->npwpd . ' ' . $wp->nama;
            }
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
                    'initSelection' => empty($model->wajib_pajak_id) ? null : 'js:function(element,callback){
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
            <?php
            echo $form->datePickerControlGroup($model, 'tanggal', array('span' => 2, 'onchange' => "getValue();", 'pluginOptions' => array(
                    'format' => 'dd/mm/yyyy',
                    'endDate' => date('d/m/Y'),
            )));
            ?>  

            <?php echo $form->textFieldControlGroup($model, 'periode', array('span' => 1, 'readonly' => !$model->isNewRecord)); ?>

            <?php echo $form->textFieldControlGroup($model, 'nomor', array('span' => 2, 'readonly' => !$model->isNewRecord)); ?>

            <?php // echo $form->textFieldControlGroup($model, 'nilai_pajak', array('span' => 5)); ?>

            <?php // echo $form->textFieldControlGroup($model, 'kode_rekening_id', array('span' => 5)); ?>
        </div>
        <div class="span-12">
            <fieldset><legend><?php echo Yii::t('trans', 'Pemeriksaan Item'); ?></legend>
                <table class="table table-striped table-bordered items-list">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('trans', 'Browse'); ?></th>
                            <th><?php echo Yii::t('trans', 'Periode Awal'); ?></th>
                            <th><?php echo Yii::t('trans', 'Periode Akhir'); ?></th>
                            <th><?php echo Yii::t('trans', 'Pajak Terhutang'); ?><br/>(a)</th>
                            <th><?php echo Yii::t('trans', 'Kredit Pajak'); ?><br/>(b)</th>
                            <th><?php echo Yii::t('trans', 'Pokok Pajak'); ?><br/>(c = (a - b))</th>
                            <th><?php echo Yii::t('trans', 'Sanksi'); ?><br/>(d) = (c) x 2% x <?php echo Yii::t('trans', 'jml. bulan'); ?></th>
                            <th><?php echo Yii::t('trans', 'Jumlah Pajak'); ?><br/>(e)=(c + d)</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $form->hiddenField($model, 'setoran_pajak_id'); ?> 
                                <?php echo $form->hiddenField($model, 'spt_id'); ?> 
                                <?php echo $form->hiddenField($model, 'tanggal_jatuh_tempo'); ?> 
                                <?php echo $form->hiddenField($model, 'kode_rekening_id'); ?> 
                                <a href="#" class="browse browse" rel="tooltip" data-original-title="<?php echo Yii::t('trans', 'Browse'); ?>"><i class="icon-list"></i></a>
                            </td>
                            <td><?php echo $form->textField($model, 'periode_awal', array('readonly' => 'readonly', 'class' => 'spanD')); ?></td>
                            <td><?php echo $form->textField($model, 'periode_akhir', array('readonly' => 'readonly', 'class' => 'spanD')); ?></td>
                            <td><?php echo $form->textField($model, 'terhutang', array('class' => 'spanT required', 'style' => "text-align: right;", 'onkeyup' => "getValue();")); ?></td>
                            <td>
                                <?php echo Yii::t('trans', 'Setoran'); ?> : <?php echo Yii::t('trans', 'Total'); ?> : <?php echo $form->textField($model, 'setoran', array('readonly' => 'readonly', 'class' => 'spanT', 'style' => "text-align: right;")); ?><br />
                                <?php echo Yii::t('trans', 'Kompensasi'); ?> : <?php echo $form->textField($model, 'kompensasi', array('class' => 'spanT', 'style' => "text-align: right;", 'onkeyup' => "getValue();")); ?><br />
                                <?php echo Yii::t('trans', 'Lain-lain'); ?> : <?php echo $form->textField($model, 'kredit_lain', array('class' => 'spanT', 'style' => "text-align: right;", 'onkeyup' => "getValue();")); ?><hr />
                                <?php echo Yii::t('trans', 'Total'); ?> : <?php echo Yii::t('trans', 'Total'); ?> : <?php echo $form->textField($model, 'total_kredit', array('readonly' => 'readonly', 'class' => 'spanT', 'style' => "text-align: right;")); ?>
                            </td>
                            <td><?php echo Yii::t('trans', 'Total'); ?> : <?php echo $form->textField($model, 'pajak', array('readonly' => 'readonly', 'class' => 'spanT', 'style' => "text-align: right;")); ?></td>
                            <td>
                                <?php echo Yii::t('trans', 'Bunga'); ?> : <?php echo $form->textField($model, 'bunga', array('readonly' => 'readonly', 'class' => 'spanT', 'style' => "text-align: right;")); ?><br />
                                <?php echo Yii::t('trans', 'Kenaikan'); ?> : <?php echo $form->textField($model, 'kenaikan', array('class' => 'spanT', 'style' => "text-align: right;", 'onkeyup' => "getValue();")); ?><hr />
                                <?php echo Yii::t('trans', 'Total'); ?> : <?php echo $form->textField($model, 'total_sanksi', array('readonly' => 'readonly', 'class' => 'spanT', 'style' => "text-align: right;")); ?>
                            </td>
                            <td><?php echo $form->textField($model, 'total', array('span' => 2, 'readonly' => 'readonly', 'style' => "text-align: right;")); ?></td>
                            <td><a href="#" class="delete remove" rel="tooltip" data-original-title="<?php echo Yii::t('trans', 'Delete'); ?>"> <i class="icon-trash"></i></a></td>
                        </tr>
                        <tr>
                            <td colspan="6"></td>
                            <td><?php echo Yii::t('trans', 'Jumlah'); ?></td>
                            <td><?php echo $form->textField($model, 'nilai_pajak', array('span' => 2, 'readonly' => 'readonly', 'style' => "text-align: right;font-size: 20px;font-weight: bold;")); ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>  
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

    <?php
    $this->widget('ext.fancybox.EFancyBox', array(
        'config' => array(),
            )
    );
    ?>
</div><!-- form -->
<script type="text/javascript">
    var timer;
    jQuery(document).ready(function () {
        if (jQuery("#Pemeriksaan_wajib_pajak_id").val()) {
            fillData(jQuery("#Pemeriksaan_wajib_pajak_id").val());
            getValue();
        }
    });
    function fillData(id) {
        jQuery.ajax({'type': 'POST', 'url': '<?php echo $this->createUrl('wajibPajak/jsonGetData'); ?>/?id=' + id, 'cache': false, dataType: 'json', 'data': null}).done(function (data) {
            jQuery("#Pemeriksaan_wajib_pajak_id").val(data.id);
            jQuery("#Pemeriksaan_nama").val(data.nama);
            jQuery("#Pemeriksaan_alamat").val(data.alamat);
            jQuery("#Pemeriksaan_kabupaten").val(data.kabupaten);
            jQuery("#Pemeriksaan_kecamatan").val(data.kecamatan);
            jQuery("#Pemeriksaan_kelurahan").val(data.kelurahan);
            console.log(data);
        });
    }
    function getValue() {
        clearInterval(timer);  //clear any interval on key up
        timer = setTimeout(function () { //then give it a second to see if the user is finished
            jQuery.ajax({'type': 'POST', 'url': '<?php echo $this->createUrl('pemeriksaan/ajaxGetValue'); ?>', 'cache': false, dataType: 'json', 'data': $('#pemeriksaan-form').serialize()}).done(function (data) {
                $.each(data, function (key, value) {
                    jQuery("#" + key).val(value);
                });
            });
        }, 1000);
    }

    function getValueSetoran(id) {
        jQuery.ajax({'type': 'POST', 'url': '<?php echo $this->createUrl('pemeriksaan/jsonGetSetoran'); ?>/' + id, 'cache': false, dataType: 'json', 'data': null}).done(function (data) {
            jQuery("#Pemeriksaan_spt_id").val(data.spt_id);
            jQuery("#Pemeriksaan_tanggal_jatuh_tempo").val(data.tanggal_jatuh_tempo);
            jQuery("#Pemeriksaan_kode_rekening_id").val(data.kode_rekening_id);
            jQuery("#Pemeriksaan_periode_awal").val(data.periode_awal);
            jQuery("#Pemeriksaan_periode_akhir").val(data.periode_akhir);
            jQuery("#Pemeriksaan_setoran").val(data.setoran);
            jQuery("#Pemeriksaan_setoran_pajak_id").val(data.setoran_pajak_id);
            getValue();
            $.fancybox.close();
        });
    }
    $(".browse").on("click", function (e) {
        var idx = jQuery("#Pemeriksaan_setoran_pajak_id").val();
        if (jQuery('#Pemeriksaan_wajib_pajak_id').val() != '') {
            $.fancybox({
                type: 'iframe',
                href: '<?php echo $this->createUrl('pemeriksaan/grid'); ?>?id=' + jQuery('#Pemeriksaan_wajib_pajak_id').val() + '&idx=' + idx,
                width: 1000,
                height: 800,
            });
        } else {
            alert('<?php echo Yii::t('trans', 'Pilih wajib pajak dulu.'); ?>');
        }
    });

    $(".remove").on("click", function (e) {
        //clear data
        jQuery("#Pemeriksaan_setoran").val('');
        jQuery("#Pemeriksaan_total_kredit").val('');
        jQuery("#Pemeriksaan_pajak").val('');
        jQuery("#Pemeriksaan_bunga").val('');
        jQuery("#Pemeriksaan_total_sanksi").val('');
        jQuery("#Pemeriksaan_total").val('');
        jQuery("#Pemeriksaan_nilai_pajak").val('');
        jQuery("#Pemeriksaan_spt_id").val('');
        jQuery("#Pemeriksaan_tanggal_jatuh_tempo").val('');
        jQuery("#Pemeriksaan_kode_rekening_id").val('');
        jQuery("#Pemeriksaan_periode_awal").val('');
        jQuery("#Pemeriksaan_periode_akhir").val('');
        jQuery("#Pemeriksaan_setoran").val('');
//        jQuery("#Pemeriksaan_setoran_pajak_id").val('');
    });
</script>
<style type="text/css">
    .spanT {
        width: 125px;
    }
    .spanD {
        width: 75px;
    }
</style>