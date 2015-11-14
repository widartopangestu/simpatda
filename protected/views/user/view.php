<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'View') . ' ' . Yii::t('trans', 'User');
$this->breadcrumbs = array(
    Yii::t('trans', 'User') => array('index'),
    $model->username,
);

$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt'),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file'),
    array('label' => Yii::t('trans', 'Update'), 'url' => array('update', 'id' => $model->id), 'icon' => 'pencil'),
    array('label' => Yii::t('trans', 'Delete'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?'), 'icon' => 'trash'),
);
?>

<div class="widget ">

    <div class="widget-header">
        <i class="icon-eye-open"></i>
        <h3><?php echo Yii::t('trans', 'View') . ' ' . Yii::t('trans', 'User') . ' #' . $model->username; ?></h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">
        <?php
        $this->widget('zii.widgets.CDetailView', array(
            'htmlOptions' => array(
                'class' => 'table table-striped table-condensed table-hover',
            ),
            'data' => $model,
            'attributes' => array(
                'username',
                'email',
                'fullname',
                'phone_1',
                'phone_2',
                'address',
                array(
                    'name' => 'status',
                    'type' => 'raw',
                    'value' => CHtml::encode($model->statusText),
                ),
                array(
                    'name' => 'role_id',
                    'type' => 'raw',
                    'value' => $model->roleName,
                ),
            ),
        ));
        ?>
    </div>
</div>