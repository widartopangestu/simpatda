<?php
/* @var $this SetoranBankController */
/* @var $model SetoranBank */
?>

<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Setoran Bank') => array('index'),
    Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Setoran Bank');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Setoran Bank');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('setoranBank.index')) ? true : false),
);
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
        'id' => 'setoran-bank-form',
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

    <?php
    echo $form->datePickerControlGroup($model, 'tanggal', array('span' => 2, 'onchange' => "getValue();", 'pluginOptions' => array(
            'format' => 'dd/mm/yyyy'
    )));
    ?>

    <?php // echo $form->textFieldControlGroup($model, 'nomor', array('span' => 2)); ?>
    <?php
    $this->widget('yiiwheels.widgets.grid.WhGridView', array(
        'id' => 'setoran-pajak-grid',
        'dataProvider' => $setoran_pajak->search(),
        'responsiveTable' => true,
        'filter' => $setoran_pajak,
        'template' => '{items}{pager}{summary}',
        'columns' => array(
            array(
                'class' => 'CCheckBoxColumn',
                'checkBoxHtmlOptions' => array(
                    'name' => 'SetoranPajak_ids[]',
                ),
                'selectableRows' => '2',
                'header' => 'Selected',
                'id' => 'check-boxes', // need this id for use with $.fn.yiiGridView.getChecked(containerID,columnID)
                'value' => '$data->id',
                'checked' => 'Yii::app()->user->getState($data->id)', // we are using the user session variable to store the checked row values, also considering here that email_ids are unique for your app, it would be best to use any field that is unique in the table
            ),
            array(
                'header' => 'No',
                'value' => '$this->grid->dataProvider->getPagination()->getOffset()+$row+1'
            ),
            'nomor',
            array(
                'name' => 'periode',
                'type' => 'raw',
                'value' => 'CHtml::encode($data->penetapan->spt->periode)',
                'filter' => false,
            ),
            array(
                'name' => 'kohir',
                'type' => 'raw',
                'value' => 'CHtml::encode($data->penetapan->kohir)',
                'filter' => false,
            ),
            array(
                'name' => 'jenis_surat',
                'type' => 'raw',
                'value' => 'CHtml::encode($data->namaJenisSurat)',
                'filter' => $setoran_pajak->jenisSuratOptions,
            ),
            array(
                'name' => 'tanggal_bayar',
                'value' => 'date("d/m/Y",strtotime($data->tanggal_bayar))',
                'filter' => false,
            ),
            array(
                'name' => 'nama_rekening',
                'type' => 'raw',
                'value' => 'CHtml::encode($data->penetapan->spt->kodeRekening->nama)',
                'filter' => false,
            ),
            array(
                'name' => 'npwpd',
                'type' => 'raw',
                'value' => 'CHtml::encode($data->penetapan->spt->wajibpajak->npwpd)',
                'filter' => false,
            ),
            array(
                'name' => 'nama_wajib_pajak',
                'type' => 'raw',
                'value' => 'CHtml::encode($data->penetapan->spt->wajibpajak->nama)',
                'filter' => false,
            ),
            array(
                'name' => 'via_bayar',
                'type' => 'raw',
                'value' => 'CHtml::encode($data->viaBayarText)',
                'filter' => $setoran_pajak->viaBayarOptions,
            ),
            array(
                'name' => 'jumlah_bayar',
                'type' => 'raw',
                'value' => 'number_format($data->jumlah_bayar, Yii::app()->params[\'currency_precision\'])',
            ),
        ),
    ));
    ?>
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