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

    public function chosenActiveMultiSelectControlGroup($model, $attribute, $data, $htmlOptions = array()) {
        $chosen = Chosen::activeMultiSelect($model, $attribute, $data, $htmlOptions);
        return $this->customControlGroup($chosen, $model, $attribute, $htmlOptions);
    }

    public function chosenActiveDropDownListControlGroup($model, $attribute, $data, $htmlOptions = array()) {
        $chosen = Chosen::activeDropDownList($model, $attribute, $data, $htmlOptions);
        return $this->customControlGroup($chosen, $model, $attribute, $htmlOptions);
    }

    public function maskMoneyControlGroup($model, $attribute, $htmlOptions = array()) {
        // the options for the Bootstrap JavaScript plugin
        $name = get_class($model);
        $options = array(
            'model' => $model,
            'name' => $name . '[' . $attribute . ']',
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

    public function select2ActiveTextFieldControlGroup($model, $attribute, $htmlOptions = array()) {
        $select2Options = array(
            'model' => $model,
            'attribute' => $attribute,
            'value' => $model->{$attribute},
            'options' => TbArray::popValue('options', $htmlOptions, array()),
            'htmlOptions' => $htmlOptions,
        );
        $select2 = $this->owner->widget('ext.select2.ESelect2', $select2Options, true);
        return $this->customControlGroup($select2, $model, $attribute, $htmlOptions);
    }

    public function ktpFieldControlGroup($model, $attribute1, $data, $attribute2, $html1Options = array(), $html2Options = array()) {
        $control = $this->dropDownList($model, $attribute1, $data, $html1Options);
        $control .= " " . $this->textField($model, $attribute2, $html2Options);
        return $this->customControlGroup($control, $model, $attribute1, $html1Options);
    }

    public function datePickerSdControlGroup($model, $attribute1, $attribute2, $html1Options = array(), $html2Options = array()) {
        // the options for the Bootstrap JavaScript plugin
        $datePicker1Options = array(
            'model' => $model,
            'attribute' => $attribute1,
            'pluginOptions' => TbArray::popValue('pluginOptions', $html1Options, array()),
            'events' => TbArray::popValue('events', $html1Options, array()),
            'htmlOptions' => $html1Options,
        );
        $datePicker2Options = array(
            'model' => $model,
            'attribute' => $attribute2,
            'pluginOptions' => TbArray::popValue('pluginOptions', $html2Options, array()),
            'events' => TbArray::popValue('events', $html2Options, array()),
            'htmlOptions' => $html2Options,
        );
        $datePicker = $this->owner->widget('yiiwheels.widgets.datepicker.FTDatePicker', $datePicker1Options, true);
        $datePicker .= " " . $model->getAttributeLabel($attribute2) . " " . $this->owner->widget('yiiwheels.widgets.datepicker.FTDatePicker', $datePicker2Options, true);
        return $this->customControlGroup($datePicker, $model, $attribute1, $html1Options);
    }
    
    public function textFieldSdControlGroup($model, $attribute1, $attribute2, $html1Options = array(), $html2Options = array()) {
        $control = $this->textField($model, $attribute1, $html1Options);
        $control .= " " . $model->getAttributeLabel($attribute2) . " " . $this->textField($model, $attribute2, $html2Options);
        return $this->customControlGroup($control, $model, $attribute1, $html1Options);
    }
}
