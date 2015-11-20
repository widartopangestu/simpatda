<?php

$this->widget('yiiwheels.widgets.grid.WhGridView', array(
    'id' => 'order-pengiriman-item-grid',
    'dataProvider' => new CArrayDataProvider($items, array(
        'pagination' => false,
            )),
    'template' => '{items}{pager}{summary}',
    'columns' => array(
        array(
            'header' => 'No',
            'value' => '$row+1',
        ),
        array(
            'header' => Kelurahan::model()->getAttributeLabel('kode'),
            'name' => 'kode',
            'value' => '$data->kode'
        ),
        array(
            'header' => Kelurahan::model()->getAttributeLabel('nama'),
            'name' => 'nama',
            'value' => '$data->nama'
        ),
    ),
));
