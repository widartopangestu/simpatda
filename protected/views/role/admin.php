<?php

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Role');
$this->modulTitle = Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Role');
$this->breadcrumbs = array(
    Yii::t('trans', 'Roles'),
);

$this->menu = array(
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file'),
);
?>
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