<?php
/* @var $this OperationController */
/* @var $model Operation */

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Operations');
$this->breadcrumbs = array(
    Yii::t('trans', 'Operations')
);
$this->modulTitle = Yii::t('trans', 'Generate All') . ' ' . Yii::t('trans', 'Operations');
$this->menu = array(
    array('label' => Yii::t('trans', 'Generate All'), 'url' => array('generate'), 'icon' => 'asterisk'),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file'),
);
$pageSize = Yii::app()->user->getState('pageSize' . $model->tableName(), Yii::app()->params['defaultPageSize']);
?>

<div class="grid-view pull-right">
    <div class="filter-container">
        <?php
        echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList("pageSizeTop", $pageSize, Yii::app()->params['optionsPage'], array(
            "onchange" => "$.fn.yiiGridView.update('operation-grid',{ data:{pageSize: $(this).val() }})",
            "style" => "width:70px;"
        ));
        ?>
    </div>
</div>
<?php
$visible_view = (Yii::app()->util->is_authorized('operation.view')) ? 'true' : 'false';
$visible_update = (Yii::app()->util->is_authorized('operation.update')) ? 'true' : 'false';
$visible_delete = (Yii::app()->util->is_authorized('operation.delete')) ? 'true' : 'false';
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'operation-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'name',
        'description',
        array(
            'filter' => CHtml::listData($model->findAll(new CDbCriteria(array('group' => 'id'))), 'nama_modul', 'nama_modul'),
            'name' => 'nama_modul',
            'type' => 'raw',
            'value' => '$data->nama_modul',
        ),
        array(
            'filter' => $model->grupOptions,
            'name' => 'grup',
            'type' => 'raw',
            'value' => '$data->grupText',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{update} {delete}',
            'buttons' => array(
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
        echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList("pageSize", $pageSize, Yii::app()->params['optionsPage'], array(
            "onchange" => "$.fn.yiiGridView.update('operation-grid',{ data:{pageSize: $(this).val() }})",
            "style" => "width:70px;"
        ));
        ?>
    </div>
</div>
<script type="text/javascript">
    $('#pageSizeTop').change(function () {
        $('#pageSize').val($('#pageSizeTop').val());
    });

    $('#pageSize').change(function () {
        $('#pageSizeTop').val($('#pageSize').val());
    });
</script>
