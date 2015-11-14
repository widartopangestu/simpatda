<?php
/* @var $this BukukasController */
/* @var $model Bukukas */


$this->breadcrumbs = array(
    'User Logs Report' => array('index'),
    Yii::t('trans', 'Manage'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - User Logs Report';
$this->menu = array(
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file'),
);
?>

<div class="widget ">
    <div class="widget-header">
        <i class="icon-list-alt"></i>
        <h3><?php echo Yii::t('trans', 'User Logs Report'); ?></h3>
    </div> <!-- /widget-header -->
    <div class="widget-content">
        <?php
        $this->widget('yiiwheels.widgets.grid.WhGridView', array(
            'id' => 'user-grid',
            'dataProvider' => $model->search(),
            'responsiveTable' => true,
            'filter' => $model,
            'template' => '{items}{pager}{summary}',
            'columns' => array(
                array(
                    'header' => 'No',
                    'value' => '$this->grid->dataProvider->getPagination()->getOffset()+$row+1'
                ),
                'username',
                'email',
                'fullname',
                array(
                    'header' => Yii::t('trans', 'Actions'),
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{lihat_transaksi}',
                    'buttons' => array(
                        'lihat_transaksi' => array(
                            'label' => Yii::t('trans', 'View') . ' Log', //Text label of the button.
                            'options' => array('class' => 'assign'),
                            'url' => 'Yii::app()->createUrl("report/userLogForm", array("id"=>$data->id))',
                            'visible' => 'true', //A PHP expression for determining whether the button is visible.
                        ),
                    ),
                ),
            ),
        ));
        ?>
    </div>
</div>