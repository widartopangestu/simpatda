<?php
$this->breadcrumbs = array(
    Yii::t('trans', 'Profile') => array('profile'),
    $model->fullname,
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Profile');
$this->modulTitle = Yii::t('trans', 'Profile');
$this->menu = array(
    array('label' => Yii::t('trans', 'Edit Profile'), 'url' => array('edit'), 'icon' => TbHtml::ICON_PENCIL),
    array('label' => Yii::t('trans', 'Change Password'), 'url' => array('changePassword'), 'icon' => TbHtml::ICON_COG),
    array('label' => Yii::t('trans', 'Change Photo'), 'url' => array('changePhoto'), 'icon' => TbHtml::ICON_PICTURE),
);
?>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'image',
            'value' => CHtml::image(Yii::app()->request->baseUrl . Yii::app()->params['upload_image_profile'] . $model->image, "", array("style" => "width:100px;height:125px;")),
            'type' => 'html',
        ),
        'username',
        'fullname',
        'email',
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
        array(
            'name' => 'last_login',
            'type' => 'raw',
            'value' => Yii::app()->format->timeago($model->last_login),
        ),
)));
?>


<?php $pageSize = Yii::app()->user->getState('pageSize' . $model->tableName(), Yii::app()->params['defaultPageSize']); ?>

<div class="modul-title"><?php echo Yii::t('trans', 'Log Akses') ?></div>
<br/>
<br/>
<div class="grid-view pull-right">
    <div class="summary">
        <?php
        echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList("pageSizeTop", $pageSize, Yii::app()->params['optionsPage'], array(
            "onchange" => "$.fn.yiiGridView.update('access-log-grid',{ data:{pageSize: $(this).val() }})",
            "style" => "width:70px;"
        ));
        ?>
    </div>
</div><br><br>
<?php
$this->widget('yiiwheels.widgets.grid.WhGridView', array(
    'id' => 'access-log-grid',
    'dataProvider' => $model_log->search(),
    'responsiveTable' => false,
    'filter' => $model_log,
    'template' => '{items}{pager}{summary}',
    'columns' => array(
        array(
            'header' => 'No',
            'value' => '$this->grid->dataProvider->getPagination()->getOffset()+$row+1'
        ),
        array(
            'name' => 'type',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->typeText)',
            'filter' => $model_log->typeOptions,
        ),
        'activity',
        array(
            'name' => 'time',
            'type' => 'raw',
            'value' => 'date("d-m-Y h:i:s A", strtotime($data->time))',
            'filter' => false,
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{download}',
            'header' => 'Download',
            'buttons' => array(
                'download' => array(
                    'label' => Yii::t('trans', 'Download LOG'), //Text label of the button.
                    'options' => array('class' => 'print'),
                    'icon' => TbHtml::ICON_FILE,
                    'url' => 'Yii::app()->createUrl("accessLog/download", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));
?>
<div class="grid-view">
    <div class="summary">
        <?php
        echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList("pageSize", $pageSize, Yii::app()->params['optionsPage'], array(
            "onchange" => "$.fn.yiiGridView.update('access-log-grid',{ data:{pageSize: $(this).val() }})",
            "style" => "width:70px;"
        ));
        ?>
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