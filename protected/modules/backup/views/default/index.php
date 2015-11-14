<?php
/* @var $this BackupController */
/* @var $model Backup */


$this->breadcrumbs = array(
    Yii::t('trans', 'Backup') => array('index'),
    Yii::t('trans', 'List Backup') . ' ' . UploadForm::label(2),
);
?>
<div class="widget ">

    <div class="widget-header">
        <i class="icon-list-alt"></i>
        <h3><?php echo Yii::t('trans', 'List Backup'); ?></h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">
        <?php
        $visible_download = (Yii::app()->util->is_authorized('backup.default.download')) ? 'true' : 'false';
        $visible_restore = (Yii::app()->util->is_authorized('backup.default.restore')) ? 'true' : 'false';
        $visible_delete = (Yii::app()->util->is_authorized('backup.default.delete')) ? 'true' : 'false';
        $this->widget('yiiwheels.widgets.grid.WhGridView', array(
            'id' => 'backup-grid',
            'dataProvider' => $dataProvider,
            'responsiveTable' => true,
            'template' => '{items}{pager}{summary}',
            'columns' => array(
                array(
                    'header' => 'No',
                    'value' => '$this->grid->dataProvider->getPagination()->getOffset()+$row+1'
                ),
                array(
                    'name' => 'name',
                    'header' => Yii::t('trans', 'Name')
                ),
                array(
                    'name' => 'size',
                    'header' => Yii::t('trans', 'Size')
                ),
                array(
                    'name' => 'create_time',
                    'header' => Yii::t('trans', 'Create Time')
                ),
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{download} {restore} {delete}',
                    'buttons' => array(
                        'download' => array(
                            'url' => 'Yii::app()->createUrl("backup/default/download", array("file"=>$data["name"]))',
                            'icon' => TbHtml::ICON_DOWNLOAD_ALT,
                            'visible' => $visible_download
                        ),
                        'restore' => array(
                            'url' => 'Yii::app()->createUrl("backup/default/restore", array("file"=>$data["name"]))',
                            'icon' => TbHtml::ICON_REPEAT,
                            'visible' => $visible_restore
                        ),
                        'delete' => array(
                            'url' => 'Yii::app()->createUrl("backup/default/delete", array("file"=>$data["name"]))',
                            'visible' => $visible_delete
                        ),
                    ),
                ),
            ),
        ));
        ?>
    </div>
</div>