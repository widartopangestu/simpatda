<?php
/**
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
echo "\n";
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	Yii::t('trans', '$label')=>array('index'),
	Yii::t('trans', 'Manage'),
);\n";
?>

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . <?php echo "Yii::t('trans', '$label')"; ?>;
$this->menu=array(
	array('label'=>Yii::t('trans', 'Create'), 'url'=>array('create'), 'icon'=>'file', 'visible' => (Yii::app()->util->is_authorized('<?php echo lcfirst($this->modelClass); ?>.create')) ? true : false),
);
$pageSize = Yii::app()->user->getState('pageSize' . $model->tableName(), Yii::app()->params['defaultPageSize']); ?>

<div class="widget ">
    <div class="widget-header">
        <i class="icon-list-alt"></i>
        <h3><?php echo "<?php echo Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', '".$this->pluralize($this->class2name($this->modelClass))."'); ?>"; ?></h3>
    </div> <!-- /widget-header -->
    <div class="widget-content">
        <div class="grid-view pull-right">
            <div class="filter-container">
        <?php echo "<?php\n"; ?>
                echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList('pageSizeTop', $pageSize, Yii::app()->params['optionsPage'], array(
                    'onchange' => '$.fn.yiiGridView.update(\'<?php echo $this->class2id($this->modelClass); ?>-grid\',{ data:{pageSize: $(this).val() }})',
                    'style' => 'width:70px;'
                ));        
        <?php echo "?>"; ?>
            </div>
        </div>
<?php echo "<?php"; ?> 
        $visible_view = (Yii::app()->util->is_authorized('<?php echo lcfirst($this->modelClass); ?>.view')) ? 'true' : 'false';
        $visible_update = (Yii::app()->util->is_authorized('<?php echo lcfirst($this->modelClass); ?>.update')) ? 'true' : 'false';
        $visible_delete = (Yii::app()->util->is_authorized('<?php echo lcfirst($this->modelClass); ?>.delete')) ? 'true' : 'false';
        $this->widget('yiiwheels.widgets.grid.WhGridView',array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
        'responsiveTable' => true,
	'filter'=>$model,
        'template'=>'{items}{pager}{summary}', 
	'columns'=>array(
                array(
                    'header' => 'No',
                    'value' => '$this->grid->dataProvider->getPagination()->getOffset()+$row+1'
                ),
<?php
$count = 0;
foreach ($this->tableSchema->columns as $column) {
    if (++$count == 7) {
		echo "\t\t/*\n";
	}
    echo "\t\t'" . $column->name . "',\n";
}
if ($count >= 7) {
	echo "\t\t*/\n";
}
?>
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'buttons' => array(
                            'view' => array(
                                'visible' => $visible_view, 
                            ),
                            'update' => array(
                                'visible' => $visible_update, 
                            ),
                            'delete' => array(
                                'visible' => $visible_delete, 
                            ),
                        ),
		),
	),
)); ?>
        <div class="grid-view">
            <div class="summary">
        <?php echo "<?php\n"; ?>
                echo Yii::t('trans', 'Tampil') . ' : ' . CHtml::dropDownList('pageSize', $pageSize, Yii::app()->params['optionsPage'], array(
                    'onchange' => '$.fn.yiiGridView.update(\'<?php echo $this->class2id($this->modelClass); ?>-grid\',{ data:{pageSize: $(this).val() }})',
                    'style' => 'width:70px;'
                ));        
        <?php echo "?>"; ?>
            </div>
        </div>  
    </div>
</div>
<script type="text/javascript">    
    $('#pageSizeTop').change(function() {
        $('#pageSize').val($('#pageSizeTop').val());
    });

    $('#pageSize').change(function() {
        $('#pageSizeTop').val($('#pageSize').val());
    });
</script>