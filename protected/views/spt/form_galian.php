<?php
/* @var $this SptController */
/* @var $model Spt */
?>

<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'SPTPD') => array('index', 'jenis' => Spt::JENIS_PAJAK_GALIAN),
    Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'SPTPD Mineral Bkn. Logam & Batuan'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'SPTPD Mineral Bkn. Logam & Batuan');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'SPTPD Mineral Bkn. Logam & Batuan');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index', 'jenis' => Spt::JENIS_PAJAK_GALIAN), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('spt.index')) ? true : false),
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

            <?php echo $form->textFieldControlGroup($model_galian, 'nama', array('span' => 3)); ?>
            <?php echo $form->textFieldControlGroup($model_galian, 'no_kontrak', array('span' => 3)); ?>
            <?php echo $form->maskMoneyControlGroup($model_galian, 'jml_rab', array('span' => 3, 'style' => "text-align: right")); ?>

            <?php echo $form->textAreaControlGroup($model, 'uraian', array('rows' => 3, 'span' => 4)); ?>

            <?php // echo $form->dropdownListControlGroup($model, 'kode_rekening_id', KodeRekening::model()->getParentTreeOptions(Spt::PARENT_GALIAN), array('span' => 3, 'empty' => Yii::t('trans', '-- Pilih Kode Rekening --'), 'onchange' => 'getNamaRekening($(this).val())')); ?>

            <?php // echo $form->textFieldControlGroup($model, 'nama_kode_rekening', array('span' => 3, 'maxlength' => 255, 'readonly' => true)); ?>

            <?php // echo $form->maskMoneyControlGroup($model, 'nilai', array('span' => 3, 'style' => "text-align: right")); ?>

            <?php // echo $form->textFieldControlGroup($model, 'tarif_dasar', array('span' => 3)); ?>

            <?php // echo $form->textFieldControlGroup($model, 'tarif_persen', array('span' => 1, 'readonly' => 'readonly')); ?>

        </div>
        <div class="span-12">
            <fieldset><legend><?php echo Yii::t('trans', 'Detail Galian'); ?></legend>
                <table class="table table-striped table-bordered items-list">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('trans', 'Kode Rekening'); ?></th>
                            <th><?php echo Yii::t('trans', 'Jumlah (M<sup>3</sup>)'); ?><br/>(a)</th>
                            <th><?php echo Yii::t('trans', 'Tarip Dasar'); ?><br/>(b)</th>
                            <th><?php echo Yii::t('trans', 'Dasar Pengenaan (Rp.)'); ?><br/>(c = (a x b))</th>
                            <th><?php echo Yii::t('trans', 'Tarip (%)'); ?><br/>(d)</th>
                            <th><?php echo Yii::t('trans', 'Pajak (Rp.)'); ?><br/>(c x d)</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($model->isNewRecord): ?>
                            <tr class="template" style="display: none;">
                                <td>
                                    <input type="hidden" class="items-id" name="items[x][items_id]" value="" id="items_xxitems.id" />
                                    <select class="span3 required" name="items[x][kode_rekening_id]" id="items_xxkode_rekening_id" onchange="getNamaRekening($(this).val(), $(this).attr('id').split('x'));">
                                        <?php
                                        echo '<option value="">' . Yii::t('trans', '-- Pilih Kode Rekening --') . '</option>';
                                        foreach (KodeRekening::model()->getParentTreeOptions(Spt::PARENT_GALIAN) as $id => $val) {
                                            echo '<option value=' . $id . '>' . $val . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><input name="items[x][nilai]" id="items_xxnilai" class="span1 required" type="text" onkeyup="getValueGalian();" style="text-align: right;"></td>
                                <td><input readonly="readonly" name="items[x][tarif_dasar]" id="items_xxtarif_dasar" class="span2" type="text" style="text-align: right;"></td>
                                <td><input readonly="readonly" name="items[x][dasar_pengenaan]" id="items_xxdasar_pengenaan" class="span2" type="text" style="text-align: right;"></td>
                                <td><input readonly="readonly" name="items[x][tarif_persen]" id="items_xxtarif_persen" class="span1" type="text" style="text-align: right;"></td>
                                <td><input readonly="readonly" name="items[x][pajak]" id="items_xxpajak" class="span2" type="text" style="text-align: right;"></td>
                                <td><a href="#" class="delete remove-items" rel="tooltip" data-original-title="<?php echo Yii::t('trans', 'Delete'); ?>"><i class="icon-trash"></i></a></td>
                            </tr>
                        <?php else : ?>         
                            <tr class="template" style="display: none;">
                                <td>
                                    <input type="hidden" class="items-id" name="items[x][items_id]" value="" id="items_xxitems.id" />
                                    <select class="span3 required" name="items[x][kode_rekening_id]" id="items_xxkode_rekening_id" onchange="getNamaRekening($(this).val(), $(this).attr('id').split('x'));">
                                        <?php
                                        echo '<option value="">' . Yii::t('trans', '-- Pilih Kode Rekening --') . '</option>';
                                        foreach (KodeRekening::model()->getParentTreeOptions(Spt::PARENT_GALIAN) as $id => $val) {
                                            echo '<option value=' . $id . '>' . $val . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><input name="items[x][nilai]" id="items_xxnilai" class="span1 required" type="text" onkeyup="getValueGalian();" style="text-align: right;"></td>
                                <td><input readonly="readonly" name="items[x][tarif_dasar]" id="items_xxtarif_dasar" class="span2" type="text" style="text-align: right;"></td>
                                <td><input readonly="readonly" name="items[x][dasar_pengenaan]" id="items_xxdasar_pengenaan" class="span2" type="text" style="text-align: right;"></td>
                                <td><input readonly="readonly" name="items[x][tarif_persen]" id="items_xxtarif_persen" class="span1" type="text" style="text-align: right;"></td>
                                <td><input readonly="readonly" name="items[x][pajak]" id="items_xxpajak" class="span2" type="text" style="text-align: right;"></td>
                                <td><a href="#" class="delete remove-items" rel="tooltip" data-original-title="<?php echo Yii::t('trans', 'Delete'); ?>"><i class="icon-trash"></i></a></td>
                            </tr>
                            <?php
                            $index = 0;
                            foreach ($model->sptItems as $item):
                                ?>
                                <tr class="new">
                                    <td>
                                        <input type="hidden" class="items-id" name="items[<?php echo $index; ?>][items_id]" value="<?php echo $item->id; ?>" id="items_<?php echo $index; ?>xitems.id" />
                                        <select class="span3 required" name="items[<?php echo $index; ?>][kode_rekening_id]" id="items_<?php echo $index; ?>xkode_rekening_id" onchange="getNamaRekening($(this).val(), $(this).attr('id').split('x'));">
                                            <?php
                                            echo '<option value="">' . Yii::t('trans', '-- Pilih Kode Rekening --') . '</option>';
                                            foreach (KodeRekening::model()->getParentTreeOptions(Spt::PARENT_GALIAN) as $id => $val) {
                                                $selected = $item->kode_rekening_id == $id ? 'selected="selected"' : '';
                                                echo '<option value=' . $id . ' ' . $selected . '>' . $val . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><input value="<?php echo $item->nilai; ?>" name="items[<?php echo $index; ?>][nilai]" id="items_<?php echo $index; ?>xnilai" class="span1 required" type="text" onkeyup="getValueGalian();" style="text-align: right;"></td>
                                    <td><input value="<?php echo number_format($item->tarif_dasar, Yii::app()->params['currency_precision']); ?>" readonly="readonly" name="items[<?php echo $index; ?>][tarif_dasar]" id="items_<?php echo $index; ?>xtarif_dasar" class="span2" type="text" style="text-align: right;"></td>
                                    <td><input value="<?php echo $item->dasar_pengenaan; ?>" readonly="readonly" name="items[<?php echo $index; ?>][dasar_pengenaan]" id="items_<?php echo $index; ?>xdasar_pengenaan" class="span2" type="text" style="text-align: right;"></td>
                                    <td><input value="<?php echo $item->tarif_persen; ?>" readonly="readonly" name="items[<?php echo $index; ?>][tarif_persen]" id="items_<?php echo $index; ?>xtarif_persen" class="span1" type="text" style="text-align: right;"></td>
                                    <td><input value="<?php echo $item->pajak; ?>" readonly="readonly" name="items[<?php echo $index; ?>][pajak]" id="items_<?php echo $index; ?>xpajak" class="span2" type="text" style="text-align: right;"></td>
                                    <td><a href="#" class="delete remove-items" rel="tooltip" data-original-title="<?php echo Yii::t('trans', 'Delete'); ?>" id="<?php echo $item->id; ?>"><i class="icon-trash"></i></a></td>
                                </tr>
                                <?php
                                $index++;
                            endforeach;
                            ?>
                        <?php endif; ?>
                        <tr>
                            <td colspan="4"><a href="#" class="btn btn-primary add-items">
                                    <?php echo Yii::t('trans', 'Add Item'); ?>
                                </a></td>
                            <td><?php echo Yii::t('trans', 'Jumlah'); ?></td>
                            <td><?php echo $form->textField($model, 'pajak', array('span' => 2, 'readonly' => 'readonly', 'style' => "text-align: right;font-size: 20px;font-weight: bold;")); ?></td>
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

</div><!-- form -->
<script type="text/javascript">
    var timer;
    jQuery(document).ready(function () {
        getValueGalian();
        if (jQuery("#Spt_wajib_pajak_id").val())
            fillData(jQuery("#Spt_wajib_pajak_id").val());
    });
    function getNamaRekening(id, idx) {
        jQuery.ajax({'type': 'POST', 'url': '<?php echo $this->createUrl('spt/jsonGetKodeRekening'); ?>/?id=' + id, 'cache': false, dataType: 'json', 'data': null}).done(function (data) {
            jQuery("#" + idx[0] + "xtarif_persen").val(data.tarif_persen);
            jQuery("#" + idx[0] + "xtarif_dasar").val(data.tarif_dasar);
            getValueGalian();
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
        });
    }
    function getValueGalian() {
        clearInterval(timer);  //clear any interval on key up
        timer = setTimeout(function () { //then give it a second to see if the user is finished
            jQuery.ajax({'type': 'POST', 'url': '<?php echo $this->createUrl('spt/ajaxGetValueGalian'); ?>', 'cache': false, dataType: 'json', 'data': $('#spt-form').serialize()}).done(function (data) {
                $.each(data, function (key, value) {
                    jQuery("#" + key).val(value);
                });
                jQuery("#Spt_pajak").val(data.pajak);
            });
        }, 1000);
    }
    $(function () {
        var itemCount = <?php echo $model->isNewRecord ? 0 : $model->sptItemCount; ?>;
        var deletedId = '';
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
            getValueGalian();
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