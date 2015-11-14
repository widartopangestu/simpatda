<page>
    <page_header>
        <table>
            <tr>
                <td style="text-align: left; vertical-align: top;">
                    <?php
                    $company_name = Yii::app()->params['company_name_report'];
                    $company_description = Yii::app()->params['company_description_report'];
                    $company_address = Yii::app()->params['company_address_report'];
                    ?>
                    <h2><?php echo (!empty($company_name)) ? $company_name : 'COMPANY NAME'; ?></h2>
                    <h5><?php echo (!empty($company_description)) ? $company_description : 'COMPANY DESCRIPTION'; ?></h5>
                    <?php echo (!empty($company_address)) ? $company_address : 'COMPANY ADDRESS'; ?>
                </td>
            </tr>
        </table>
    </page_header>
    <page_body>
        <table style="margin-left: 3px;">
            <tbody>
                <tr style="width: 100%;">
                    <td><h3><?php echo $title; ?></h3></td>
                </tr>
                <tr>
                    <td>    QUERY > <i>
                            <?php echo Yii::t('trans', 'User') . ' : ' . (!empty($model->user)) ? User::model()->findByPk($model->user)->username : 'All User'; ?>
                            | <?php echo Yii::t('trans', 'Date Activity') . ' : ' . $model->dateFrom . ' to ' . $model->dateTo; ?>
                        </i></td>
                </tr>
            </tbody>
        </table>
        <table class="tablesorter" border="1" cellpadding="8" cellspacing="0" style="width: 100%;">
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
    </page_body>
</page>