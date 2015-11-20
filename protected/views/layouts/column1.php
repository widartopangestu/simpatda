<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">	      	
    <div class="span12">   
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
    </div>
</div>
<?php $this->endContent(); ?>