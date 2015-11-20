<?php
/* @var $this PangkatController */
/* @var $model Pangkat */


$this->breadcrumbs = array(
    Yii::t('trans', 'Pangkat') => array('index'),
    Yii::t('trans', 'Manage'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Pangkat');
$this->modulTitle = Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Pangkat');
$this->menu = array(
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('pangkat.create')) ? true : false),
);
$pageSize = Yii::app()->user->getState('pageSize' . $model->tableName(), Yii::app()->params['defaultPageSize']);
?>

<div class="grid-view pull-right">
    <div class="filter-container">
        <?php
        echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList('pageSizeTop', $pageSize, Yii::app()->params['optionsPage'], array(
            'onchange' => '$.fn.yiiGridView.update(\'pangkat-grid\',{ data:{pageSize: $(this).val() }})',
            'style' => 'width:70px;'
        ));
        ?>            </div>
</div>
<?php
$visible_update = (Yii::app()->util->is_authorized('pangkat.update')) ? 'true' : 'false';
$visible_delete = (Yii::app()->util->is_authorized('pangkat.delete')) ? 'true' : 'false';
$this->widget('yiiwheels.widgets.grid.WhGridView', array(
    'id' => 'pangkat-grid',
    'dataProvider' => $model->search(),
    'responsiveTable' => true,
    'filter' => $model,
    'template' => '{items}{pager}{summary}',
    'columns' => array(
        array(
            'header' => 'No',
            'value' => '$this->grid->dataProvider->getPagination()->getOffset()+$row+1'
        ),
        'nama',
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
                    'visible' => 'false',
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
            'onchange' => '$.fn.yiiGridView.update(\'pangkat-grid\',{ data:{pageSize: $(this).val() }})',
            'style' => 'width:70px;'
        ));
        ?>            </div>
</div> 
<script type="text/javascript">
    $('#pageSizeTop').change(function () {
        $('#pageSize').val($('#pageSizeTop').val());
    });

    $('#pageSize').change(function () {
        $('#pageSizeTop').val($('#pageSize').val());
    });
</script>