<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Role');

$this->breadcrumbs = array(
    Yii::t('trans', 'Roles'),
);

$this->menu = array(
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file'),
);
?>

<div class="widget ">

    <div class="widget-header">
        <i class="icon-list-alt"></i>
        <h3><?php echo Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Role'); ?></h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'role-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
                'name',
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                ),
            ),
        ));
        ?>
    </div>
</div>