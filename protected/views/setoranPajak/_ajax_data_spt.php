<table class="table table-striped" cellpadding="8" cellspacing="0">
    <thead>
        <?php
        echo '<tr>';
        echo '<th>' . Yii::t('app', 'No') . '</th>';
        echo '<th>' . Yii::t('biaya', 'Kode Rekening') . '</th>';
        echo '<th>' . Yii::t('biaya', 'Nama Rekening') . '</th>';
        echo '<th>' . Yii::t('biaya', 'Jumlah (Rp.)'). '</th>';
        echo '</tr>';
        ?>
    </thead>
    <tbody>
        <?php
        if (count($model) > 0) {
            $i = 1;
            foreach ($model->spt->sptItems as $spt) {
                echo '<tr>';
                echo '<td>' . $i++ . '</td>';
                echo '<td>' . $spt->kodeRekening->kode . '</td>';
                echo '<td>' . $spt->kodeRekening->nama . '</td>';
                echo '<td>' . number_format($spt->pajak, Yii::app()->params['currency_precision']) . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="4">' . Yii::t('trans', 'There is no item.') . '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>