<?php
/* @var $this AccessLogController */
/* @var $model AccessLog */


$this->breadcrumbs = array(
    Yii::t('trans', 'Access Logs') => array('index'),
    Yii::t('trans', 'Manage'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Access Logs');
$this->menu = array(
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('accessLog.create')) ? true : false),
);
$pageSize = Yii::app()->user->getState('pageSize' . $model->tableName(), Yii::app()->params['defaultPageSize']);
?>

<div class="widget ">
    <div class="widget-header">
        <i class="icon-list-alt"></i>
        <h3><?php echo Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Access Logs'); ?></h3>
    </div> <!-- /widget-header -->
    <div class="widget-content">
        <div class="grid-view pull-right">
            <div class="filter-container">
                <?php
                echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList('pageSizeTop', $pageSize, Yii::app()->params['optionsPage'], array(
                    'onchange' => '$.fn.yiiGridView.update(\'access-log-grid\',{ data:{pageSize: $(this).val() }})',
                    'style' => 'width:70px;'
                ));
                ?>            </div>
        </div>
        <?php
        $visible_view = (Yii::app()->util->is_authorized('accessLog.view')) ? 'true' : 'false';
        $visible_update = (Yii::app()->util->is_authorized('accessLog.update')) ? 'true' : 'false';
        $visible_delete = (Yii::app()->util->is_authorized('accessLog.delete')) ? 'true' : 'false';
        $this->widget('yiiwheels.widgets.grid.WhGridView', array(
            'id' => 'access-log-grid',
            'dataProvider' => $model->search(),
            'responsiveTable' => true,
            'filter' => $model,
            'template' => '{items}{pager}{summary}',
            'columns' => array(
                array(
                    'header' => 'No',
                    'value' => '$this->grid->dataProvider->getPagination()->getOffset()+$row+1'
                ),
                array(
                    'name' => 'user_id',
                    'type' => 'raw',
                    'value' => 'CHtml::encode($data->userName)',
                    'filter' => $model->userOptions,
                ),
                array(
                    'name' => 'type',
                    'type' => 'raw',
                    'value' => 'CHtml::encode($data->typeText)',
                    'filter' => $model->typeOptions,
                ),
                'activity',
                array(
                    'name' => 'time',
                    'type' => 'raw',
                    'value' => 'date("d-m-Y h:i:s A", $data->time)',
                    'filter' => false,
                ),
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
                    'onchange' => '$.fn.yiiGridView.update(\'access-log-grid\',{ data:{pageSize: $(this).val() }})',
                    'style' => 'width:70px;'
                ));
                ?>            </div>
        </div>  
    </div>
</div>
<script type="text/javascript">
    $('#pageSizeTop').change(function() {
        $('#pageSize').val($('#pageSizeTop').val());
    });

    $('#pageSize').change(function() {
        $('#pageSizeTop').val($('#pageSize').val());
    });
</script>