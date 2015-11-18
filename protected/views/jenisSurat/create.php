<?php
/* @var $this JenisSuratController */
/* @var $model JenisSurat */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Jenis Surat')=>array('index'),
	Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Jenis Surat');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('jenisSurat.index')) ? true : false),
);
?>

<div class="widget ">
    <div class="widget-header">
        <i class="icon-file"></i>
        <h3><?php echo Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Jenis Surat'); ?></h3>
    </div> <!-- /widget-header -->
    <div class="widget-content">
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>    </div>
</div>