<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Home');
?>
<div class="row">
    <div class="span12">
        <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
                <h3>About <?php echo Yii::app()->name; ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="well-small">
                    <p><b><?php echo Yii::app()->name; ?></b></p>
                </div>
            </div>
            <!-- /widget-content --> 
        </div>
    </div>

    <div class="span7">
        <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
                <h3>User Information</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="well-small">
                    <?php
                    $this->widget('zii.widgets.CDetailView', array(
                        'htmlOptions' => array(
                            'class' => 'table table-striped table-condensed table-hover',
                        ),
                        'data' => $user,
                        'attributes' => array(
                            'username',
                            'email',
                            'fullname',
                            'phone_1',
                            array(
                                'name' => 'status',
                                'type' => 'raw',
                                'value' => CHtml::encode($user->statusText),
                            ),
                            array(
                                'name' => 'role_id',
                                'type' => 'raw',
                                'value' => $user->roleName,
                            ),
                            array(
                                'name' => 'last_login',
                                'type' => 'raw',
                                'value' => Yii::app()->format->timeago($user->last_login),
                            ),
                        ),
                    ));
                    ?>
                </div>
                <div class="well-small">
                    <h3><?php echo Yii::t('trans', 'Access Log List'); ?></h3>
                    <?php
                    $this->widget('yiiwheels.widgets.grid.WhGridView', array(
                        'id' => 'access-log-grid',
                        'dataProvider' => $accessLog->search(),
                        'responsiveTable' => true,
                        'filter' => $accessLog,
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
                                'filter' => $accessLog->typeOptions,
                            ),
                            'activity',
                            array(
                                'name' => 'time',
                                'type' => 'raw',
                                'value' => 'date("d-m-Y h:i:s A", $data->time)',
                                'filter' => false,
                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>
            <!-- /widget-content --> 
        </div>
    </div>
</div>