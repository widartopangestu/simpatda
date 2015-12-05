<?php echo $form->textFieldControlGroup($model, 'title', array('class' => 'span5', 'maxlength' => 255)); ?>
<?php echo $form->dropDownListControlGroup($model, 'general_user_role', $model->roleOptions, array('span' => 2)); ?>
<?php echo $form->dropDownListControlGroup($model, 'defaultPageSize', Yii::app()->params['optionsPage'], array('span' => 2)); ?>
<?php echo $form->dropDownListControlGroup($model, 'language', $model->languageOptions, array('span' => 2)); ?>
<?php echo $form->textFieldControlGroup($model, 'currency_precision', array('span' => 2, 'maxlength' => 2)); ?>
<?php echo $form->textFieldControlGroup($model, 'qty_precision', array('span' => 2, 'maxlength' => 2)); ?>      
<?php echo $form->textFieldControlGroup($model, 'hari_jatuh_tempo', array('span' => 2, 'maxlength' => 2)); ?>      