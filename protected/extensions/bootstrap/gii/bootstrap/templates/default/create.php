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
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	Yii::t('trans', '$label')=>array('index'),
	Yii::t('trans', 'Create'),
);\n";
?>
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . <?php echo "Yii::t('trans', '$label')"; ?>;
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', '<?php echo $this->class2name($this->modelClass); ?>');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('<?php echo lcfirst($this->modelClass); ?>.index')) ? true : false),
);
?>

<?php echo "<?php \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>