<?php
/* @var $this KodeRekeningController */
/* @var $model KodeRekening */


$this->breadcrumbs = array(
    Yii::t('trans', 'Kode Rekening') => array('index'),
    Yii::t('trans', 'Manage'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Kode Rekening');
$this->modulTitle = Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Kode Rekening');
$this->menu = array(
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('kodeRekening.create')) ? true : false),
);
$pageSize = Yii::app()->user->getState('pageSize' . $model->tableName(), Yii::app()->params['defaultPageSize']);
?>

<div class="grid-view pull-right">
    <div class="filter-container">
        <?php
        echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList('pageSizeTop', $pageSize, Yii::app()->params['optionsPage'], array(
            'onchange' => '$.fn.yiiGridView.update(\'kode-rekening-grid\',{ data:{pageSize: $(this).val() }})',
            'style' => 'width:70px;'
        ));
        ?>    </div>
</div>
<?php
$visible_view = (Yii::app()->util->is_authorized('kodeRekening.view')) ? 'true' : 'false';
$visible_update = (Yii::app()->util->is_authorized('kodeRekening.update')) ? 'true' : 'false';
$visible_delete = (Yii::app()->util->is_authorized('kodeRekening.delete')) ? 'true' : 'false';
$this->widget('yiiwheels.widgets.grid.WhGridView', array(
    'id' => 'kode-rekening-grid',
    'dataProvider' => $model->search(),
    'responsiveTable' => true,
    'filter' => $model,
    'template' => '{items}{pager}{summary}',
    'columns' => array(
        array(
            'header' => 'No',
            'value' => '$this->grid->dataProvider->getPagination()->getOffset()+$row+1'
        ),
        'kode',
        'nama',
        'tarif_persen',
        'tarif_dasar',
        'parent_id',
//        array(
//            'filter' => false,
//            'name' => 'created',
//            'value' => '$data->created !== NULL ? date("d-M-Y H:i:s", strtotime($data->created)) : \'\'',
//        ),
//        array(
//            'filter' => false,
//            'name' => 'updated',
//            'value' => '$data->updated !== NULL ? date("d-M-Y H:i:s", strtotime($data->updated)) : \'\'',
//        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'buttons' => array(
                'view' => array(
                    'visible' => $visible_view,
                ),
                'update' => array(
                    'visible' => $visible_update,
                ),
                'delete' => array(
                    'visible' => $visible_delete,
                ),
            ),
        ),
    ),
));
?>
<div class="grid-view">
    <div class="summary">
        <?php
        echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList('pageSize', $pageSize, Yii::app()->params['optionsPage'], array(
            'onchange' => '$.fn.yiiGridView.update(\'kode-rekening-grid\',{ data:{pageSize: $(this).val() }})',
            'style' => 'width:70px;'
        ));
        ?>    </div>
</div>  
<script type="text/javascript">
    $('#pageSizeTop').change(function () {
        $('#pageSize').val($('#pageSizeTop').val());
    });

    $('#pageSize').change(function () {
        $('#pageSizeTop').val($('#pageSize').val());
    });
</script>