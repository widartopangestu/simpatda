<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Yii::import('bootstrap.helpers.TbHtml');
Yii::import('bootstrap.helpers.TbArray');
Yii::import('yiiwheels.widgets.datetimepicker.WhDateTimePicker');

class FTDateTimePicker extends WhDateTimePicker {

    public function renderField() {
        if (null === $this->selector) {
            $options = array();

            list($name, $id) = $this->resolveNameID();

            $options['id'] = $id . '_datetimepicker';
            TbHtml::addCssClass('input-append', $options);

            echo CHtml::openTag('div', $options);
            if ($this->hasModel()) {
                echo TbHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions);
            } else {
                echo TbHtml::textField($name, $this->value, $this->htmlOptions);
            }
            echo CHtml::openTag('span', array('class' => 'add-on'));
            echo '<i data-time-icon="' . $this->iconTime . '" data-date-icon="' . $this->iconDate . '"></i>';
            echo CHtml::closeTag('span');
            echo CHtml::closeTag('div');
        }
    }

}
