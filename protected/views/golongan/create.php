<?php
/* @var $this GolonganController */
/* @var $model Golongan */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Golongan')=>array('index'),
	Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Golongan');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('golongan.index')) ? true : false),
);
?>

<div class="widget ">
    <div class="widget-header">
        <i class="icon-file"></i>
        <h3><?php echo Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Golongan'); ?></h3>
    </div> <!-- /widget-header -->
    <div class="widget-content">
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>    </div>
</div>