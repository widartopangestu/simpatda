<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'View') . ' ' . Yii::t('trans', 'Role');
$this->modulTitle = Yii::t('trans', 'View') . ' ' . Yii::t('trans', 'Role') . ' #' . $model->name;
$this->breadcrumbs = array(
    Yii::t('trans', 'Roles') => array('admin'),
    $model->name,
);

$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('admin'), 'icon' => 'list-alt'),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file'),
    array('label' => Yii::t('trans', 'Update'), 'url' => array('update', 'id' => $model->id), 'icon' => 'pencil'),
    array('label' => Yii::t('trans', 'Delete'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?'), 'icon' => 'trash'),
    array('label' => Yii::t('trans', 'Assign User'), 'url' => array('assign', 'id' => $model->id), 'icon' => 'check'),
);
?>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data' => $model,
    'attributes' => array(
        'name',
        array(
            'name' => 'operations',
            'type' => 'html',
            'value' => $model->operationsFormat,
        ),
    ),
));
?>
<div id="users">
    <?php
    $this->renderPartial('_users', array(
        'users' => $model->users,
    ));
    ?>
</div>