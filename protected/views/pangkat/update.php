<?php
/* @var $this PangkatController */
/* @var $model Pangkat */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Pangkat')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('trans', 'Update'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Pangkat');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('pangkat.index')) ? true : false),
	array('label'=>Yii::t('trans', 'Create'), 'url'=>array('create'), 'icon'=>'file', 'visible' => (Yii::app()->util->is_authorized('pangkat.create')) ? true : false),
);
?>

<div class="widget ">
    <div class="widget-header">
        <i class="icon-pencil"></i>
        <h3><?php echo Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Pangkat'); ?>  <?php echo $model->id; ?></h3>
    </div> <!-- /widget-header -->
    <div class="widget-content">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>    </div>
</div>