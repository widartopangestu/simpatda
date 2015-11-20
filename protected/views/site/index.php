<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Home');
$this->modulTitle = Yii::t('trans', 'Dashboard');
$this->breadcrumbs = array(
    Yii::t('trans', 'Dashboard')
);
?>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/pages/dashboard.css" rel="stylesheet"> 
<div class="row">
    <div class="span7">
        <div class="widget">
            <div class="widget-header"> <i class="icon-bookmark"></i>
                <h3>About <?php echo Yii::app()->name; ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="shortcuts"> 
                    <a href="#" class="shortcut"><i class="shortcut-icon icon-list-alt"></i><span class="shortcut-label">Apps</span> </a>
                    <a href="#" class="shortcut"><i class="shortcut-icon icon-bookmark"></i><span class="shortcut-label">Bookmarks</span> </a>
                    <a href="#" class="shortcut"><i class="shortcut-icon icon-signal"></i> <span class="shortcut-label">Reports</span> </a>
                    <a href="#" class="shortcut"> <i class="shortcut-icon icon-comment"></i><span class="shortcut-label">Comments</span> </a>
                    <a href="#" class="shortcut"><i class="shortcut-icon icon-user"></i><span class="shortcut-label">Users</span> </a>
                    <a href="#" class="shortcut"><i class="shortcut-icon icon-file"></i><span class="shortcut-label">Notes</span> </a>
                    <a href="#" class="shortcut"><i class="shortcut-icon icon-picture"></i> <span class="shortcut-label">Photos</span> </a>
                    <a href="#" class="shortcut"> <i class="shortcut-icon icon-tag"></i><span class="shortcut-label">Tags</span> </a> </div>
                <!-- /shortcuts --> 
            </div>
            <!-- /widget-content --> 
        </div>
        <!-- /widget --> 
    </div>
    <!-- /span6 -->
    <div class="span4">        
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
            </div>
            <!-- /widget-content --> 
        </div>
        <!-- /widget -->
    </div>
    <!-- /span6 --> 
</div>