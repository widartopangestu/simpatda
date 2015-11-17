<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Config');
?>

<div class="widget ">

    <div class="widget-header">
        <i class="icon-cog"></i>
        <h3><?php echo Yii::t('trans', 'Settings'); ?></h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
            'id' => 'config-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('class' => 'form-horizontal')
        ));
        ?>
        <p class="help-block">
            <?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?>
        </p>

        <?php echo $form->errorSummary($model); ?>

        <?php
        $this->widget('bootstrap.widgets.TbTabs', array(
            'tabs' => array(
                array('label' => Yii::t('trans', 'System'), 'content' => $this->renderPartial('_sistem', array('model' => $model, 'form' => $form), true), 'active' => true),
                array('label' => Yii::t('trans', 'Company'), 'content' => $this->renderPartial('_perusahaan', array('model' => $model, 'form' => $form), true)),
                array('label' => Yii::t('trans', 'Reports'), 'content' => $this->renderPartial('_report', array('model' => $model, 'form' => $form), true)),
            ),
        ));
        ?>
        <div class="form-actions">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => Yii::t('trans', Yii::t('trans', 'Save')),
            ));
            ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>