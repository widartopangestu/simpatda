<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Yii::import('bootstrap.helpers.TbHtml');
Yii::import('bootstrap.helpers.TbArray');
Yii::import('yiiwheels.widgets.datepicker.WhDatePicker');

class FTDatePicker extends WhDatePicker {

    public function renderField() {
        list($name, $id) = $this->resolveNameID();

        TbArray::defaultValue('id', $id, $this->htmlOptions);
        TbArray::defaultValue('name', $name, $this->htmlOptions);

        if ($this->hasModel()) {
            echo TbHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions);
        } else {
            echo TbHtml::textField($name, $this->value, $this->htmlOptions);
        }
    }

}
