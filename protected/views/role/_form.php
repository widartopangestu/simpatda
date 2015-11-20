<?php
/* @var $this RoleController */
/* @var $model Role */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'role-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,'htmlOptions' => array('class' => 'form-horizontal'),
    ));
    ?>

    <p class="help-block"><?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?></p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'name', array('span' => 5, 'maxlength' => 45)); ?>
    <div class="control-group">
        <label class="control-label" for="Role_operations">Operations</label>
        <div class="controls">
            <div class="row" style="padding-left: 14px">
                <ul style="list-style: none; padding: 2px;margin: 2px;">
                    <li style="padding-left: 14px">

                        <input type="checkbox" name="operation_all" value="1" <?php echo ($model->id) ? $data['all_operation'] : '' ?>/> All Operation
                        <ul style="list-style: none; padding: 2px;margin: 2px;">
                            <div class="span-4">
                                <?php foreach ($operations as $key => $value): ?>
                                    <?php if ($key == 1 || $key == 2 || $key == 3): ?> 
                                        <li style="padding-left: 14px">
                                            <input  span="5"  type="checkbox" name="operation_grup[]" value="1" <?php echo ($model->id) ? $data[$key . 'grp'] : '' ?>/> <b><?php echo Operation::model()->getGrupText($key); ?></b>
                                            <ul style="list-style: none; padding: 2px;margin: 2px;">
                                                <?php foreach ($value as $key2 => $value2): ?>
                                                    <li  style="padding-left: 14px">
                                                        <input type="checkbox" name="operation_modul[]" value="1" <?php echo ($model->id) ? $data[$key2 . 'mdl'] : '' ?>/><i> <?php echo $key2 ?></i>
                                                        <ul  style="list-style: none; padding: 2px;margin: 2px;">
                                                            <?php foreach ($value2 as $opt): ?>
                                                                <li  style="padding-left: 14px">
                                                                    <input type="checkbox" name="operation[]" value="<?php echo $opt->id ?>" <?php echo ($model->id) ? $data[$opt->id . 'opt'] : '' ?> /> <?php echo $opt->description ?>
                                                                </li> 
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="span-4">
                                <?php foreach ($operations as $key => $value): ?>
                                    <?php if ($key == 4 || $key == 5 || $key == 6): ?> 
                                        <li style="padding-left: 14px">
                                            <input  span="5"  type="checkbox" name="operation_grup[]" value="1" <?php echo ($model->id) ? $data[$key . 'grp'] : '' ?>/> <b><?php echo Operation::model()->getGrupText($key); ?></b>
                                            <ul style="list-style: none; padding: 2px;margin: 2px;">
                                                <?php foreach ($value as $key2 => $value2): ?>
                                                    <li  style="padding-left: 14px">
                                                        <input type="checkbox" name="operation_modul[]" value="1" <?php echo ($model->id) ? $data[$key2 . 'mdl'] : '' ?>/><i> <?php echo $key2 ?></i>
                                                        <ul  style="list-style: none; padding: 2px;margin: 2px;">
                                                            <?php foreach ($value2 as $opt): ?>
                                                                <li  style="padding-left: 14px">
                                                                    <input type="checkbox" name="operation[]" value="<?php echo $opt->id ?>" <?php echo ($model->id) ? $data[$opt->id . 'opt'] : '' ?> /> <?php echo $opt->description ?>
                                                                </li> 
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="span-4">
                                <?php foreach ($operations as $key => $value): ?>
                                    <?php if ($key == 7 || $key == 8 || $key == 9): ?> 
                                        <li style="padding-left: 14px">
                                            <input  span="5"  type="checkbox" name="operation_grup[]" value="1" <?php echo ($model->id) ? $data[$key . 'grp'] : '' ?>/> <b><?php echo Operation::model()->getGrupText($key); ?></b>
                                            <ul style="list-style: none; padding: 2px;margin: 2px;">
                                                <?php foreach ($value as $key2 => $value2): ?>
                                                    <li  style="padding-left: 14px">
                                                        <input type="checkbox" name="operation_modul[]" value="1" <?php echo ($model->id) ? $data[$key2 . 'mdl'] : '' ?>/><i> <?php echo $key2 ?></i>
                                                        <ul  style="list-style: none; padding: 2px;margin: 2px;">
                                                            <?php foreach ($value2 as $opt): ?>
                                                                <li  style="padding-left: 14px">
                                                                    <input type="checkbox" name="operation[]" value="<?php echo $opt->id ?>" <?php echo ($model->id) ? $data[$opt->id . 'opt'] : '' ?> /> <?php echo $opt->description ?>
                                                                </li> 
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="span-4">
                                <?php foreach ($operations as $key => $value): ?>
                                    <?php if ($key == 10): ?> 
                                        <li style="padding-left: 14px">
                                            <input  span="5"  type="checkbox" name="operation_grup[]" value="1" <?php echo ($model->id) ? $data[$key . 'grp'] : '' ?>/> <b><?php echo Operation::model()->getGrupText($key); ?></b>
                                            <ul style="list-style: none; padding: 2px;margin: 2px;">
                                                <?php foreach ($value as $key2 => $value2): ?>
                                                    <li  style="padding-left: 14px">
                                                        <input type="checkbox" name="operation_modul[]" value="1" <?php echo ($model->id) ? $data[$key2 . 'mdl'] : '' ?>/><i> <?php echo $key2 ?></i>
                                                        <ul  style="list-style: none; padding: 2px;margin: 2px;">
                                                            <?php foreach ($value2 as $opt): ?>
                                                                <li  style="padding-left: 14px">
                                                                    <input type="checkbox" name="operation[]" value="<?php echo $opt->id ?>" <?php echo ($model->id) ? $data[$opt->id . 'opt'] : '' ?> /> <?php echo $opt->description ?>
                                                                </li> 
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <?php
        echo TbHtml::submitButton($model->isNewRecord ? Yii::t('trans', 'Create') : Yii::t('trans', 'Save'), array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_DEFAULT,
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    $(document).ready(function() {
        // Apparently click is better chan change? Cuz IE?
        $('.indeterminate').each(function() {
            this.indeterminate = true;
        });
        var checked = false;
        checkSiblings = function(el) {
            var parent = el.parent().parent(), all = true;

            el.siblings().each(function() {
                return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
            });

            if (all && checked) {
                parent.children('input[type="checkbox"]').prop({
                    indeterminate: false,
                    checked: checked
                });
                checkSiblings(parent);
            } else if (all && !checked) {
                parent.children('input[type="checkbox"]').prop("checked", checked);
                parent.children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
                checkSiblings(parent);
            } else {
                el.parents("li").children('input[type="checkbox"]').prop({
                    indeterminate: true,
                    checked: false
                });
            }
        };

        $('input[type="checkbox"]').change(function(e) {
            checked = $(this).prop("checked");
            var container = $(this).parent();
            var siblings = container.siblings();

            container.find('input[type="checkbox"]').prop({
                indeterminate: false,
                checked: checked
            });
            checkSiblings(container);
        });
    });

</script>