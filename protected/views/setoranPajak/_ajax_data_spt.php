<table class="table table-striped" cellpadding="8" cellspacing="0">
    <thead>
        <?php
        echo '<tr>';
        echo '<th>' . Yii::t('app', 'No') . '</th>';
        echo '<th>' . Yii::t('biaya', 'Kode Rekening') . '</th>';
        echo '<th>' . Yii::t('biaya', 'Nama Rekening') . '</th>';
        echo '<th>' . Yii::t('biaya', 'Jumlah (Rp.)') . '</th>';
        echo '</tr>';
        ?>
    </thead>
    <tbody>
        <?php
        if (count($penetapan) > 0) {
            $i = 1;
            $sum_pajak = 0;
            foreach ($penetapan->spt->sptItems as $spt) {
                $sum_pajak +=$spt->pajak;
                echo '<tr>';
                echo '<td>' . $i++ . '</td>';
                echo '<td>' . $spt->kodeRekening->kode . '</td>';
                echo '<td>' . $spt->kodeRekening->nama . '</td>';
                echo '<td>' . number_format($spt->pajak, Yii::app()->params['currency_precision']) . '</td>';
                echo '</tr>';
            }
            if ($denda_item['jumlah_bulan']) {
                echo '<tr>';
                echo '<td>' . $i++ . '</td>';
                echo '<td>' . $denda_item['kode_rekening'] . '</td>';
                echo '<td>' . $denda_item['keterangan'] . '</td>';
                echo '<td>' . number_format($denda_item['nilai_denda'], Yii::app()->params['currency_precision']) . '</td>';
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