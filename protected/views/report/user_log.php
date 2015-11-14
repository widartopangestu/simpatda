<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Report');
?>
<div class="row">
    <div class="span12">
        <div class="widget">
            <div class="widget-header"> <i class="icon-list-alt"></i>
                <h3><?php echo Yii::t('trans', $title); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="widget-content">
                    <div class="form">

                        <?php
                        $form = $this->beginWidget('bootstrap.widgets.FTActiveForm', array(
                            'id' => 'transaction-out-form',
                            // Please note: When you enable ajax validation, make sure the corresponding
                            // controller action is handling ajax validation correctly.
                            // There is a call to performAjaxValidation() commented in generated controller code.
                            // See class documentation of CActiveForm for details on this.
                            'enableAjaxValidation' => false,
                        ));
                        ?>

                        <p class="help-block"><?php echo Yii::t('trans', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('trans', 'are required.'); ?></p>

                        <?php echo $form->errorSummary($model); ?>

                        <?php echo $form->dropdownListControlGroup($model, 'user', $model->userOptions, array('span' => 5, 'empty' => '- All User')); ?>

                        <?php
                        echo $form->datePickerControlGroup($model, 'dateFrom', array('span' => 2, 'pluginOptions' => array(
                                'format' => 'dd/mm/yyyy'
                        )));
                        ?>

                        <?php
                        echo $form->datePickerControlGroup($model, 'dateTo', array('span' => 2, 'pluginOptions' => array(
                                'format' => 'dd/mm/yyyy'
                        )));
                        ?>

                        <div class="form-actions">
                            <?php
                            echo TbHtml::submitButton(Yii::t('trans', 'Submit'), array(
                                'name' => 'type_report',
                                'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                                'size' => TbHtml::BUTTON_SIZE_LARGE,
                                'value' => 'submit'
                            ));
                            echo '&nbsp;';
                            echo TbHtml::submitButton(Yii::t('trans', 'Export to PDF'), array(
                                'name' => 'type_report',
                                'color' => TbHtml::BUTTON_COLOR_DANGER,
                                'size' => TbHtml::BUTTON_SIZE_LARGE,
                                'value' => 'pdf'
                            ));
                            echo '&nbsp;';
                            echo TbHtml::submitButton(Yii::t('trans', 'Export to Excel'), array(
                                'name' => 'type_report',
                                'color' => TbHtml::BUTTON_COLOR_SUCCESS,
                                'size' => TbHtml::BUTTON_SIZE_LARGE,
                                'value' => 'excel'
                            ));
                            ?>
                        </div>

                        <?php $this->endWidget(); ?>

                    </div>

                    <table class="table table-striped" cellpadding="8" cellspacing="0" style="width: 100%;">
                        <thead>
                            <tr>
                                <?php
                                echo '<th>' . Yii::t('trans', 'No') . '</th>';
                                echo '<th>' . Yii::t('trans', 'Type') . '</th>';
                                echo '<th>' . Yii::t('trans', 'User') . '</th>';
                                echo '<th>' . Yii::t('trans', 'Activity') . '</th>';
                                echo '<th>' . Yii::t('trans', 'Time') . '</th>';
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($dataProvider->itemCount > 0) {
                                $i = 1;
                                foreach ($dataProvider->getData() as $id => $singleRecord) {
                                    echo '<tr>';
                                    echo '<td>' . $i++ . '</td>';
                                    echo '<td>' . $singleRecord->typeText . '</td>';
                                    echo '<td>' . $singleRecord->user->username . '</td>';
                                    echo '<td>' . $singleRecord->activity . '</td>';
                                    echo '<td>' . date('d-m-Y h:i:s A', $singleRecord->time) . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr>';
                                echo '<td colspan="5">' . Yii::t('trans', 'There is no activity.') . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>