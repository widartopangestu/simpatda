<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="row">	      	
    <div class="span9">   	
        <div class="widget ">
            <div class="widget-header"><?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?>
                <!-- breadcrumbs -->
            </div> 
            <!-- /widget-header -->
            <div class="widget-content">
                <div>
                    <?php if ($this->modulTitle): ?>
                        <div class="modul-title"><?php echo strtoupper($this->modulTitle); ?></div>
                    <?php endif; ?>
                    <?php
                    $this->widget('bootstrap.widgets.TbNav', array(
                        'type' => TbHtml::NAV_TYPE_PILLS,
                        'items' => $this->menu,
                        'htmlOptions' => array('class' => 'pull-right'),
                    ));
                    ?>
                </div>      		
                <?php echo $content; ?>
            </div>
        </div>
    </div><!-- content -->
    <div class="span3">
        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-alt"></i>
                <h3> <?php
                    $this->beginWidget('zii.widgets.CPortlet', array(
                        'title' => Yii::t('trans', 'Operations'),
                    ));
                    ?></h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">
                <?php
                $this->widget('bootstrap.widgets.TbNav', array(
                    'type' => TbHtml::NAV_TYPE_TABS,
                    'stacked' => true,
                    'items' => $this->menu,
                ));
                $this->endWidget();
                ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>