<?php

$this->pageTitle = Yii::app()->params['title'] . ' - Assign to User';
$this->modulTitle = Yii::t('trans', 'Assing User to Role {role_name}', array('{role_name}' => $model->name));
$this->breadcrumbs = array(
    Yii::t('trans', 'Roles') => array('admin'),
    $model->name => array('view', 'id' => $model->id),
    Yii::t('trans', 'Assign'),
);

$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('admin'), 'icon' => 'list-alt'),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file'),
    array('label' => Yii::t('trans', 'Update'), 'url' => array('update', 'id' => $model->id), 'icon' => 'pencil'),
    array('label' => Yii::t('trans', 'View'), 'url' => array('view', 'id' => $model->id), 'icon' => 'eye-open'),
);

Yii::app()->clientScript->registerScript('assign', "
jQuery('#user-grid a.assign').live('click',function() {
        if(!confirm('Are you sure you want to assign user?')) return false;
        
        var url = $(this).attr('href');
        //  do your post request here
        $.post(url,function(res){
             $.fn.yiiGridView.update('user-grid');
         })
         .done(function(res) {
            alert( 'Assign user sucess!' );
          })
          .fail(function(res) {
            alert( res.responseText );
          });
        return false;
});
");
?>

<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        'username',
        'email',
        'fullname',
        array(
            'name' => 'status',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->statusText)',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{assign}',
            'buttons' => array(
                'assign' => array(
                    'label' => Yii::t('trans', 'Assign'), //Text label of the button.
                    'options' => array('class' => 'assign'),
                    'url' => 'Yii::app()->createUrl("role/ajaxAssign", array("role_id"=>' . $model->id . ', "user_id"=>$data->id))',
                    'visible' => 'true', //A PHP expression for determining whether the button is visible.
                ),
            ),
        ),
    ),
));
?>