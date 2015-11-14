<?php
/* @var $this OperationController */
/* @var $model Operation */

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Operations');

$this->breadcrumbs = array(
    'Operations',
);

$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('admin'), 'icon' => 'list-alt'),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file'),
);
?>
<script>
    function checkall(el) {
        var ip = document.getElementsByTagName('input'), i = ip.length - 1;
        for (i; i > -1; --i) {
            if (ip[i].type && ip[i].type.toLowerCase() === 'checkbox') {
                ip[i].checked = el.checked;
            }
        }
    }
</script>
<div class="widget ">

    <div class="widget-header">
        <i class="icon-list-alt"></i>
        <h3><?php echo Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Operations'); ?></h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">

        <table class="table table-striped" cellpadding="8" cellspacing="0" style="width: 100%;">
            <thead>
                <tr>
                    <?php
                    echo '<th><input type="checkbox" value="" onclick="checkall(this);"></th>';
                    echo '<th>' . Yii::t('trans', 'Name') . '</th>';
                    echo '<th>' . Yii::t('trans', 'Description') . '</th>';
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
                    'id' => 'profile-form',
                    'action' => Yii::app()->createUrl('operation/generateAll'),
                    'enableAjaxValidation' => true,
                ));

                foreach ($data['controllers'] as $controller)
                    foreach ($controller['actions'] as $action) {
                        $operation_name = $controller['name'] . '.' . $action;
                        echo '<tr>';
                        if (Operation::model()->exists('name = :name', array(":name" => $operation_name))) {
                            $operation_description = Operation::model()->getDescriptionByName($operation_name);
                            echo '<td>&nbsp;</td>';
                        } else {
                            $operation_description = ucfirst($controller['name']) . ' ' . ucfirst($action);
                            echo '<td><input type="checkbox" value="' . $operation_description . '" name="id[' . $operation_name . ']" /></td>';
                        }
                        echo '<td>' . $operation_name . '</td>';
                        echo '<td>' . $operation_description . '</td>';
                        echo '</tr>';
                    }


                foreach ($data['modules'] as $modul)
                    foreach ($modul['controllers'] as $controller)
                        foreach ($controller['actions'] as $action) {
                            $operation_name = $modul['name'] . '.' . $controller['name'] . '.' . $action;
                            echo '<tr>';
                            if (Operation::model()->exists('name = :name', array(":name" => $operation_name))) {
                                $operation_description = Operation::model()->getDescriptionByName($operation_name);
                                echo '<td>&nbsp;</td>';
                            } else {
                                $operation_description = ucfirst($modul['name']) . ' ' . ucfirst($controller['name']) . ' ' . ucfirst($action);
                                echo '<td><input type="checkbox" value="' . $operation_description . '" name="id[' . $operation_name . ']" /></td>';
                            }
                            echo '<td>' . $operation_name . '</td>';
                            echo '<td>' . $operation_description . '</td>';
                            echo '</tr>';
                        }
                ?>
            </tbody>
        </table>
        <div class="form-actions">
            <?php
            echo TbHtml::submitButton(Yii::t('trans', 'Generate'), array(
                'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                'size' => TbHtml::BUTTON_SIZE_LARGE,
            ));
            ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>