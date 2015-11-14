
<?php

Yii::app()->clientScript->registerScript('revoke', "
jQuery('#user-grid a.revoke').live('click',function() {
        if(!confirm('Are you sure you want to revoke user?')) return false;
        
        var url = $(this).attr('href');
        //  do your post request here
        $.post(url,function(res){
             $.fn.yiiGridView.update('user-grid');
         })
         .done(function(res) {
            alert( 'Revoke user sucess!' );
          })
          .fail(function(res) {
            alert( res.responseText );
          });
        return false;
});
");

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'user-grid',
    'dataProvider' => new CArrayDataProvider($users, array(
        'pagination' => array(
            'pageSize' => 5,
        ),
        'sort' => array(
            'attributes' => array(
                'username',
                'email',
                'fullname',
                'status',
            ),
        ),
            )),
//    'filter' => $model,
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
            'template' => '{revoke}',
            'buttons' => array(
                'revoke' => array(
                    'label' => Yii::t('trans', 'Revoke'), //Text label of the button.
                    'options' => array('class' => 'revoke'),
                    'url' => 'Yii::app()->createUrl("role/ajaxRevoke", array("id"=>$data->id))',
                    'visible' => 'true', //A PHP expression for determining whether the button is visible.
                ),
            ),
        ),
    ),
));
?>