<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="row">	      	
    <div class="span9">   	      		
        <?php echo $content; ?>
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