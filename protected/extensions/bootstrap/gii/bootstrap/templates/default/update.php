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
	Yii::t('".$this->tableSchema->name."', '$label')=>array('index'),
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	Yii::t('trans', 'Update'),
);\n";
?>

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Update') . ' ' . <?php echo "Yii::t('".$this->tableSchema->name."', '$label')"; ?>;
$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('<?php echo lcfirst($this->modelClass); ?>.index')) ? true : false),
	array('label'=>Yii::t('trans', 'Create'), 'url'=>array('create'), 'icon'=>'file', 'visible' => (Yii::app()->util->is_authorized('<?php echo lcfirst($this->modelClass); ?>.create')) ? true : false),
	array('label'=>Yii::t('trans', 'View'), 'url'=>array('view', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>), 'icon'=>'eye-open', 'visible' => (Yii::app()->util->is_authorized('<?php echo lcfirst($this->modelClass); ?>.view')) ? true : false),
);
?>

<div class="widget ">
    <div class="widget-header">
        <i class="icon-pencil"></i>
        <h3><?php echo "<?php echo Yii::t('trans', 'Update') . ' ' . Yii::t('".$this->tableSchema->name."', '".$label."'); ?>"; ?> <?php echo " <?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h3>
    </div> <!-- /widget-header -->
    <div class="widget-content">
<?php echo "<?php \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
    </div>
</div>