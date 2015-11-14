<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Translate') => array('translate/edit/index'),
    TranslateModule::t('Manage Messages'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Translate') . ' ' . TranslateModule::t('Manage Messages');
$this->menu = array(
    array('label' => TranslateModule::t('Manage Messages'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('translate.edit.index')) ? true : false),
    array('label' => TranslateModule::t('Missing Translations'), 'url' => array('missing'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('translate.edit.missing')) ? true : false),
);
$pageSize = Yii::app()->user->getState('pageSize' . $model->tableName(), Yii::app()->params['defaultPageSize']);
?>

<div class="widget ">

    <div class="widget-header">
        <i class="icon-list-alt"></i>
        <h3><?php echo Yii::t('trans', 'List Messages'); ?></h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">
        <div class="grid-view pull-right">
            <div class="filter-container">
                <?php
                echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList('pageSizeTop', $pageSize, Yii::app()->params['optionsPage'], array(
                    'onchange' => '$.fn.yiiGridView.update(\'message-grid\',{ data:{pageSize: $(this).val() }})',
                    'style' => 'width:70px;'
                ));
                ?>            
            </div>
        </div>
        <?php
        $visible_update = (Yii::app()->util->is_authorized('translate.edit.update')) ? 'true' : 'false';
        $visible_delete = (Yii::app()->util->is_authorized('translate.edit.delete')) ? 'true' : 'false';
        $source = MessageSource::model()->findAll();
        $this->widget('yiiwheels.widgets.grid.WhGridView', array(
            'id' => 'message-grid',
            'dataProvider' => $model->search(),
            'responsiveTable' => true,
            'filter' => $model,
            'template' => '{items}{pager}{summary}',
            'columns' => array(
                array(
                    'header' => 'No',
                    'value' => '$this->grid->dataProvider->getPagination()->getOffset()+$row+1'
                ),
                'id',
                array(
                    'name' => 'message',
                ),
                array(
                    'name' => 'category',
                    'filter' => CHtml::listData($source, 'category', 'category'),
                ),
                array(
                    'name' => 'language',
                    'filter' => CHtml::listData($model->findAll(new CDbCriteria(array('group' => 'language'))), 'language', 'language')
                ),
                'translation',
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{update}{delete}',
                    'updateButtonUrl' => 'Yii::app()->getController()->createUrl("update",array("id"=>$data->id,"language"=>$data->language))',
                    'deleteButtonUrl' => 'Yii::app()->getController()->createUrl("delete",array("id"=>$data->id,"language"=>$data->language))',
                    'buttons' => array(
                        'update' => array(
                            'visible' => $visible_update,
                        ),
                        'delete' => array(
                            'visible' => $visible_delete,
                        ),
                    ),
                )
            ),
        ));
        ?>
        <div class="grid-view">
            <div class="summary">
                <?php
                echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList('pageSize', $pageSize, Yii::app()->params['optionsPage'], array(
                    'onchange' => '$.fn.yiiGridView.update(\'message-grid\',{ data:{pageSize: $(this).val() }})',
                    'style' => 'width:70px;'
                ));
                ?>            </div>
        </div>  
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
