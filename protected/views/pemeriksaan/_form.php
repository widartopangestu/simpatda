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
                        <?php if ($model->isNewRecord): ?>
                            <tr class="template" style="display: none;">
                                <td>
                                    <input type="hidden" class="items-id" name="items[x][items_id]" id="items_xxitems.id" />
                                    <input type="hidden" name="items[x][spt_id]" id="items_xxspt_id" />
                                    <input type="hidden" name="items[x][tanggal_jatuh_tempo]" id="items_xxtanggal_jatuh_tempo" />
                                    <input type="hidden" name="items[x][kode_rekening_id]" id="items_xxkode_rekening_id" />
                                    <a href="#" class="browse browse-items" rel="tooltip" data-original-title="<?php echo Yii::t('trans', 'Browse'); ?>" id="xx"><i class="icon-list"></i></a>
                                </td>
                                <td><input readonly="readonly" name="items[x][periode_awal]" id="items_xxperiode_awal" class="spanD" type="text" style="text-align: right;"></td>
                                <td><input readonly="readonly" name="items[x][periode_akhir]" id="items_xxperiode_akhir" class="spanD" type="text" style="text-align: right;"></td>
                                <td><input name="items[x][terhutang]" id="items_xxterhutang" class="spanT required" type="text" onkeyup="getValue();" style="text-align: right;"></td>
                                <td>
                                    <?php echo Yii::t('trans', 'Setoran'); ?> : <input readonly="readonly" name="items[x][setoran]" id="items_xxsetoran" class="spanT" type="text" style="text-align: right;"><br />
                                    <?php echo Yii::t('trans', 'Kompensasi'); ?> : <input name="items[x][kompensasi]" id="items_xxkompensasi" class="spanT" type="text" onkeyup="getValue();" style="text-align: right;"><br />
                                    <?php echo Yii::t('trans', 'Lain-lain'); ?> : <input name="items[x][kredit_lain]" id="items_xxkredit_lain" class="spanT" type="text" onkeyup="getValue();" style="text-align: right;"><hr />
                                    <?php echo Yii::t('trans', 'Total'); ?> : <br /><input readonly="readonly" name="items[x][total_kredit]" id="items_xxtotal_kredit" class="spanT" type="text" style="text-align: right;">
                                </td>
                                <td><input readonly="readonly" name="items[x][pajak]" id="items_xxpajak" class="spanT" type="text" style="text-align: right;"></td>
                                <td>
                                    <?php echo Yii::t('trans', 'Bunga'); ?> : <input readonly="readonly" name="items[x][bunga]" id="items_xxbunga" class="spanT" type="text" style="text-align: right;"><br />
                                    <?php echo Yii::t('trans', 'Kenaikan'); ?> : <input name="items[x][kenaikan]" id="items_xxkenaikan" class="spanT" type="text" onkeyup="getValue();" style="text-align: right;"><hr />
                                    <?php echo Yii::t('trans', 'Total'); ?> : <br /><input readonly="readonly" name="items[x][total_sanksi]" id="items_xxtotal_sanksi" class="spanT" type="text" style="text-align: right;">
                                </td>
                                <td><input readonly="readonly" name="items[x][total]" id="items_xxtotal" class="span2" type="text" style="text-align: right;"></td>
                                <td><a href="#" class="delete remove-items" rel="tooltip" data-original-title="<?php echo Yii::t('trans', 'Delete'); ?>"> <i class="icon-trash"></i></a></td>
                            </tr>
                        <?php else : ?>         
                            <tr class="template" style="display: none;">
                                <td>
                                    <input type="hidden" class="items-id" name="items[x][items_id]" id="items_xxitems.id" />
                                    <input type="hidden" name="items[x][spt_id]" id="items_xxspt_id" />
                                    <input type="hidden" name="items[x][tanggal_jatuh_tempo]" id="items_xxtanggal_jatuh_tempo" />
                                    <input type="hidden" name="items[x][kode_rekening_id]" id="items_xxkode_rekening_id" />
                                    <a href="#" class="browse browse-items" rel="tooltip" data-original-title="<?php echo Yii::t('trans', 'Browse'); ?>" id="xx"><i class="icon-arrow"></i></a>
                                </td>
                                <td><input readonly="readonly" name="items[x][periode_awal]" id="items_xxperiode_awal" class="spanD" type="text" style="text-align: right;"></td>
                                <td><input readonly="readonly" name="items[x][periode_akhir]" id="items_xxperiode_akhir" class="spanD" type="text" style="text-align: right;"></td>
                                <td><input name="items[x][terhutang]" id="items_xxterhutang" class="spanT required" type="text" onkeyup="getValue();" style="text-align: right;"></td>
                                <td>
                                    <?php echo Yii::t('trans', 'Setoran'); ?> : <input readonly="readonly" name="items[x][setoran]" id="items_xxsetoran" class="spanT" type="text" style="text-align: right;"><br />
                                    <?php echo Yii::t('trans', 'Kompensasi'); ?> : <input name="items[x][kompensasi]" id="items_xxkompensasi" class="spanT" type="text" onkeyup="getValue();" style="text-align: right;"><br />
                                    <?php echo Yii::t('trans', 'Lain-lain'); ?> : <input name="items[x][kredit_lain]" id="items_xxkredit_lain" class="spanT" type="text" onkeyup="getValue();" style="text-align: right;"><hr />
                                    <?php echo Yii::t('trans', 'Total'); ?> : <input readonly="readonly" name="items[x][total_kredit]" id="items_xxtotal_kredit" class="spanT" type="text" style="text-align: right;">
                                </td>
                                <td><input readonly="readonly" name="items[x][pajak]" id="items_xxpajak" class="spanT" type="text" style="text-align: right;"></td>
                                <td>
                                    <?php echo Yii::t('trans', 'Bunga'); ?> : <input readonly="readonly" name="items[x][bunga]" id="items_xxbunga" class="spanT" type="text" style="text-align: right;"><br />
                                    <?php echo Yii::t('trans', 'Kenaikan'); ?> : <input name="items[x][kenaikan]" id="items_xxkenaikan" class="spanT" type="text" onkeyup="getValue();" style="text-align: right;"><hr />
                                    <?php echo Yii::t('trans', 'Total'); ?> : <input readonly="readonly" name="items[x][total_sanksi]" id="items_xxtotal_sanksi" class="spanT" type="text" style="text-align: right;">
                                </td>
                                <td><input readonly="readonly" name="items[x][total]" id="items_xxtotal" class="span2" type="text" style="text-align: right;"></td>
                                <td><a href="#" class="delete remove-items" rel="tooltip" data-original-title="<?php echo Yii::t('trans', 'Delete'); ?>"><i class="icon-trash"></i></a></td>
                            </tr>
                            <?php
                            $index = 0;
                            foreach ($model->pemeriksaanItems as $item):
                                ?>
                                <tr class="new">
                                    <td>
                                        <input type="hidden" class="items-id" name="items[<?php echo $index; ?>][items_id]" value="<?php echo $item->id; ?>" id="items_<?php echo $index; ?>xitems.id" />
                                        <input type="hidden" name="items[<?php echo $index; ?>][spt_id]" value="<?php echo $item->spt_id; ?>" id="items_<?php echo $index; ?>xspt_id" />
                                        <input type="hidden" name="items[<?php echo $index; ?>][tanggal_jatuh_tempo]" value="<?php echo $item->tanggal_jatuh_tempo; ?>" id="items_<?php echo $index; ?>xtanggal_jatuh_tempo" />
                                        <input type="hidden" name="items[<?php echo $index; ?>][kode_rekening_id]" value="<?php echo $item->kode_rekening_id; ?>" id="items_<?php echo $index; ?>xkode_rekening_id" />
                                        <a href="#" class="browse browse-items" rel="tooltip" data-original-title="<?php echo Yii::t('trans', 'Browse'); ?>" id="<?php echo $index; ?>"><i class="icon-arrow"></i></a>
                                    </td>
                                    <td><input value="<?php echo date('d/m/Y', strtotime($item->periode_awal)); ?>" readonly="readonly" name="items[<?php echo $index; ?>][periode_awal]" id="items_<?php echo $index; ?>xperiode_awal" class="spanD" type="text" style="text-align: right;"></td>
                                    <td><input value="<?php echo date('d/m/Y', strtotime($item->periode_akhir)); ?>" readonly="readonly" name="items[<?php echo $index; ?>][periode_akhir]" id="items_<?php echo $index; ?>xperiode_akhir" class="spanD" type="text" style="text-align: right;"></td>
                                    <td><input value="<?php echo $item->terhutang; ?>" name="items[<?php echo $index; ?>][terhutang]" id="items_<?php echo $index; ?>xterhutang" class="spanT required" type="text" onkeyup="getValue();" style="text-align: right;"></td>
                                    <td>
                                        <?php echo Yii::t('trans', 'Setoran'); ?> : <input value="<?php echo number_format($item->setoran, Yii::app()->params['currency_precision']); ?>" readonly="readonly" name="items[<?php echo $index; ?>][setoran]" id="items_<?php echo $index; ?>xsetoran" class="spanT" type="text" style="text-align: right;"><br />
                                        <?php echo Yii::t('trans', 'Kompensasi'); ?> : <input value="<?php echo $item->kompensasi; ?>" name="items[<?php echo $index; ?>][kompensasi]" id="items_<?php echo $index; ?>xkompensasi" class="spanT" type="text" onkeyup="getValue();" style="text-align: right;"><br />
                                        <?php echo Yii::t('trans', 'Lain-lain'); ?> : <input value="<?php echo $item->kredit_lain; ?>" name="items[<?php echo $index; ?>][kredit_lain]" id="items_<?php echo $index; ?>xkredit_lain" class="spanT" type="text" onkeyup="getValue();" style="text-align: right;"><hr />
                                        <?php echo Yii::t('trans', 'Total'); ?> : <input value="<?php echo number_format($item->total_kredit, Yii::app()->params['currency_precision']); ?>" readonly="readonly" name="items[<?php echo $index; ?>][total_kredit]" id="items_<?php echo $index; ?>xtotal_kredit" class="spanT" type="text" style="text-align: right;">
                                    </td>
                                    <td><input value="<?php echo number_format($item->pajak, Yii::app()->params['currency_precision']); ?>" readonly="readonly" name="items[<?php echo $index; ?>][pajak]" id="items_<?php echo $index; ?>xpajak" class="spanT" type="text" style="text-align: right;"></td>
                                    <td>
                                        <?php echo Yii::t('trans', 'Bunga'); ?> : <input value="<?php echo number_format($item->bunga, Yii::app()->params['currency_precision']); ?>" readonly="readonly" name="items[<?php echo $index; ?>][bunga]" id="items_<?php echo $index; ?>xbunga" class="spanT" type="text" style="text-align: right;"><br />
                                        <?php echo Yii::t('trans', 'Kenaikan'); ?> : <input value="<?php echo $item->kenaikan; ?>" name="items[<?php echo $index; ?>][kenaikan]" id="items_<?php echo $index; ?>xkenaikan" class="spanT" type="text" onkeyup="getValue();" style="text-align: right;"><hr />
                                        <?php echo Yii::t('trans', 'Total'); ?> : <input value="<?php echo number_format($item->total_sanksi, Yii::app()->params['currency_precision']); ?>" readonly="readonly" name="items[<?php echo $index; ?>][total_sanksi]" id="items_<?php echo $index; ?>xtotal_sanksi" class="spanT" type="text" style="text-align: right;">
                                    </td>
                                    <td><input value="<?php echo number_format($item->total, Yii::app()->params['currency_precision']); ?>" readonly="readonly" name="items[<?php echo $index; ?>][total]" id="items_<?php echo $index; ?>xtotal" class="span2" type="text" style="text-align: right;"></td>
                                    <td><a href="#" class="delete remove-items" rel="tooltip" data-original-title="<?php echo Yii::t('trans', 'Delete'); ?>" id="<?php echo $item->id; ?>"><i class="icon-trash"></i></a></td>
                                </tr>
                                <?php
                                $index++;
                            endforeach;
                            ?>
                        <?php endif; ?>
                        <tr>
                            <td colspan="6"><a href="#" class="btn btn-primary add-items">
                                    <?php echo Yii::t('trans', 'Add Item'); ?>
                                </a></td>
                            <td><?php echo Yii::t('trans', 'Jumlah'); ?></td>
                            <td><?php echo $form->textField($model, 'nilai_pajak', array('span' => 2, 'readonly' => 'readonly', 'style' => "text-align: right;font-size: 20px;font-weight: bold;")); ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="deletedItem" value="" id="deletedItem" />
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
                jQuery("#Pemeriksaan_nilai_pajak").val(data.nilai_pajak);
            });
        }, 1000);
    }

    function getValueSetoran(id, idx) {
        jQuery.ajax({'type': 'POST', 'url': '<?php echo $this->createUrl('pemeriksaan/jsonGetSetoran'); ?>/' + id, 'cache': false, dataType: 'json', 'data': null}).done(function (data) {
            jQuery("#" + idx + "xspt_id").val(data.spt_id);
            jQuery("#" + idx + "xtanggal_jatuh_tempo").val(data.tanggal_jatuh_tempo);
            jQuery("#" + idx + "xkode_rekening_id").val(data.kode_rekening_id);
            jQuery("#" + idx + "xperiode_awal").val(data.periode_awal);
            jQuery("#" + idx + "xperiode_akhir").val(data.periode_akhir);
            jQuery("#" + idx + "xsetoran").val(data.setoran);
            getValue();
            $.fancybox.close();
        });
    }
    $(function () {
        var itemCount = <?php echo $model->isNewRecord ? 0 : $model->pemeriksaanItemCount; ?>;
        var deletedId = '';
        $(".browse-items").on("click", function (e) {
            var idx = $(this).prev().attr('id').split('x');
            if (jQuery('#Pemeriksaan_wajib_pajak_id').val() != '') {
                $.fancybox({
                    type: 'iframe',
                    href: '<?php echo $this->createUrl('pemeriksaan/grid'); ?>?id=' + jQuery('#Pemeriksaan_wajib_pajak_id').val() + '&idx=' + idx[0],
                    width: 1000,
                    height: 800,
                });
            } else {
                alert('<?php echo Yii::t('trans', 'Pilih wajib pajak dulu.'); ?>');
            }
        });
        $(".remove-items").on("click", function (e) {
            e.preventDefault();
            var row = $(this).closest("tr");
            row.find("input[type='hidden'][value=false]").val(true);
            (row.attr('class') == 'new') ? row.remove() : row.hide();
            if ($(this).attr('id') !== undefined) {
                if (deletedId == '')
                    deletedId += $(this).attr('id');
                else
                    deletedId += ',' + $(this).attr('id');
                jQuery("#deletedItem").val(deletedId);
            }
            getValue();
        });

        $(".add-items").on("click", function (e) {
            e.preventDefault();
            var rows = $(".items-list tbody tr:first").clone(true, true);
            rows.find(".hidden").remove();
            rows.find("input, select").each(function () {
                this.id = this.id.replace('_xx', '_' + itemCount + 'x');
                this.name = this.name.replace('[x]', '[' + itemCount + ']');
                this.value = '';
            });
            rows.find(".required").prop('required', true);
            $(this).closest("tr").before(rows.removeClass("template").addClass('new').show());
            itemCount += 1;
        });
        $('form').on('submit', function (e) {
            $(".items-list tbody tr:first").remove();
            return true;

        });
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