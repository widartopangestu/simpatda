<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'User'); 


$this->breadcrumbs = array(
    Yii::t('trans', 'Users') => array('index'),
);

$this->menu = array(
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file'),
);
?>
<div class="widget ">

    <div class="widget-header">
        <i class="icon-list-alt"></i>
        <h3><?php echo Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'User'); ?></h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">

        <?php
        $this->widget('yiiwheels.widgets.grid.WhGridView', array(
            'id' => 'user-grid',
            'dataProvider' => $model->search(),
            'responsiveTable' => true,
            'filter' => $model,
            'template'=>'{items}{pager}{summary}', 
            'columns' => array(
                'username',
                'email',
                'fullname',
                array(
                    'name' => 'status',
                    'type' => 'raw',
                    'value' => 'CHtml::encode($data->statusText)',
                    'filter' => $model->statusOptions,
                ),
                array(
                    'name' => 'role_id',
                    'type' => 'raw',
                    'value' => 'CHtml::encode($data->roleName)',
                    'filter' => $model->roleOptions,
                ),
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                ),
            ),
        ));
        ?>
    </div>
</div>