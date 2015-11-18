<?php
/**
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
<?php echo "?>\n"; ?>

<?php
echo "<?php\n";
$nameColumn = $this->guessNameColumn($this->tableSchema->columns);
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	Yii::t('trans', '$label')=>array('index'),
	\$model->{$nameColumn},
);\n";
?>

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . <?php echo "Yii::t('trans', '$label')"; ?>;
$this->menu=array(
array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('<?php echo lcfirst($this->modelClass); ?>.index')) ? true : false),
	array('label'=>Yii::t('trans', 'Create'), 'url'=>array('create'), 'icon'=>'file', 'visible' => (Yii::app()->util->is_authorized('<?php echo lcfirst($this->modelClass); ?>.create')) ? true : false),
	array('label'=>Yii::t('trans', 'Update'), 'url'=>array('update', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>), 'icon'=>'pencil', 'visible' => (Yii::app()->util->is_authorized('<?php echo lcfirst($this->modelClass); ?>.update')) ? true : false),
	array('label'=>Yii::t('trans', 'Delete'), 'url'=>'#', 'visible' => (Yii::app()->util->is_authorized('<?php echo lcfirst($this->modelClass); ?>.delete')) ? true : false, 'linkOptions'=>array('submit'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'confirm'=>Yii::t('trans', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
);
?>

<div class="widget ">
    <div class="widget-header">
        <i class="icon-eye-open"></i>
        <h3><?php echo "<?php echo Yii::t('trans', 'View') . ' ' . Yii::t('trans', '".$this->modelClass."'); ?>"; ?> <?php echo  " #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h3>
    </div> <!-- /widget-header -->
    <div class="widget-content">
<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
<?php
foreach ($this->tableSchema->columns as $column) {
    echo "\t\t'" . $column->name . "',\n";
}
?>
	),
)); ?>
    </div>
</div>