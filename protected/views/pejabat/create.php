<?php
/* @var $this PejabatController */
/* @var $model Pejabat */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Pejabat')=>array('index'),
	Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Pejabat');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('pejabat.index')) ? true : false),
);
?>

<div class="widget ">
    <div class="widget-header">
        <i class="icon-file"></i>
        <h3><?php echo Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Pejabat'); ?></h3>
    </div> <!-- /widget-header -->
    <div class="widget-content">
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>    </div>
</div>