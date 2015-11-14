<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Translate') => array('index'),
    TranslateModule::t('Missing Translations'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Translate') . ' ' . TranslateModule::t('Missing Translations');
$this->menu = array(
    array('label' => TranslateModule::t('Manage Messages'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('translate.edit.index')) ? true : false),
    array('label' => TranslateModule::t('Missing Translations'), 'url' => array('missing'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('translate.edit.missing')) ? true : false),
);
$pageSize = Yii::app()->user->getState('pageSize' . $model->tableName(), Yii::app()->params['defaultPageSize']);
?>

<div class="widget ">

    <div class="widget-header">
        <i class="icon-list-alt"></i>
        <h3><?php echo Yii::t('trans', 'Missing Translations'); ?></h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">
        <div class="control-group">
            <label class="control-label"><?php echo Yii::t('trans', 'Language'); ?></label>
            <div class="controls"><?php echo TranslateModule::translator()->dropdown(); ?>
            </div>
        </div>
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
        $visible_update = (Yii::app()->util->is_authorized('translate.edit.create')) ? 'true' : 'false';
        $visible_delete = (Yii::app()->util->is_authorized('translate.edit.missingdelete')) ? 'true' : 'false';
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
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{create}{delete}',
                    'deleteButtonUrl' => 'Yii::app()->getController()->createUrl("missingdelete",array("id"=>$data->id))',
                    'buttons' => array(
                        'create' => array(
                            'label' => TranslateModule::t('Create'),
                            'options' => array('class' => 'create'),
                            'icon' => TbHtml::ICON_FILE,
                            'url' => 'Yii::app()->getController()->createUrl("create",array("id"=>$data->id,"language"=>Yii::app()->getLanguage()))',
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