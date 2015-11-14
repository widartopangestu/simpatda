<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


Yii::import('bootstrap.helpers.TbHtml');
Yii::import('bootstrap.widgets.TbActiveForm');

/**
 * Bootstrap active form widget.
 */
class FTActiveForm extends TbActiveForm {

    public function customControlGroup($input, $model, $attribute, $htmlOptions = array()) {
        $htmlOptions = $this->processControlGroupOptions($model, $attribute, $htmlOptions);
        return TbHtml::customActiveControlGroup($input, $model, $attribute, $htmlOptions);
    }

    public function datePickerControlGroup($model, $attribute, $htmlOptions = array()) {
        // the options for the Bootstrap JavaScript plugin
        $datePickerOptions = array(
            'model' => $model,
            'attribute' => $attribute,
            'pluginOptions' => TbArray::popValue('pluginOptions', $htmlOptions, array()),
            'events' => TbArray::popValue('events', $htmlOptions, array()),
            'htmlOptions' => $htmlOptions,
        );
        $datePicker = $this->owner->widget('yiiwheels.widgets.datepicker.FTDatePicker', $datePickerOptions, true);
        return $this->customControlGroup($datePicker, $model, $attribute, $htmlOptions);
    }
    
    public function maskMoneyControlGroup($model, $attribute, $htmlOptions = array()) {
        // the options for the Bootstrap JavaScript plugin
        $name = get_class($model);
        $options = array(
            'model' => $model,
            'name' => $name.'['.$attribute.']',
            'value' => $model->{$attribute},
            'htmlOptions' => $htmlOptions,
        );
        $maskMoney = $this->owner->widget('yiiwheels.widgets.maskmoney.WhMaskMoney', $options, true);
        return $this->customControlGroup($maskMoney, $model, $attribute, $htmlOptions);
    }
    
    public function dateTimePickerControlGroup($model, $attribute, $htmlOptions = array()) {
        // the options for the Bootstrap JavaScript plugin
        $dateTimePickerOptions = array(
            'model' => $model,
            'attribute' => $attribute,
            'format' => 'yyyy-MM-dd hh:mm:ss',
            'pluginOptions' => TbArray::popValue('pluginOptions', $htmlOptions, array()),
            'events' => TbArray::popValue('events', $htmlOptions, array()),
            'htmlOptions' => $htmlOptions,
        );
        $dateTimePicker = $this->owner->widget('yiiwheels.widgets.datetimepicker.FTDateTimePicker', $dateTimePickerOptions, true);
        return $this->customControlGroup($dateTimePicker, $model, $attribute, $htmlOptions);
    }

}
