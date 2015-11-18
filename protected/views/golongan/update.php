<?php
/* @var $this GolonganController */
/* @var $model Golongan */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Golongan')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('trans', 'Update'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Golongan');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('golongan.index')) ? true : false),
	array('label'=>Yii::t('trans', 'Create'), 'url'=>array('create'), 'icon'=>'file', 'visible' => (Yii::app()->util->is_authorized('golongan.create')) ? true : false),
);
?>

<div class="widget ">
    <div class="widget-header">
        <i class="icon-pencil"></i>
        <h3><?php echo Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Golongan'); ?>  <?php echo $model->id; ?></h3>
    </div> <!-- /widget-header -->
    <div class="widget-content">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>    </div>
</div>