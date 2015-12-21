<?php

class SptController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'WAuth - menu, jsonGetKodeRekening, ajaxGetValueHotel, ajaxGetValueRestoran, ajaxGetValueHiburan, ajaxGetValueReklame, ajaxGetValueElectric, ajaxGetValueAir, ajaxGetValueWalet, ajaxGetValueGalian, ajaxGetValueRetribusi, ajaxGetValueBphtb',
        );
    }

    public function actionMenu() {
        if (Yii::app()->util->is_authorized('spt.createHotel') || Yii::app()->util->is_authorized('spt.createRestoran') || Yii::app()->util->is_authorized('spt.createHiburan') || Yii::app()->util->is_authorized('spt.createReklame') || Yii::app()->util->is_authorized('spt.createElectric') || Yii::app()->util->is_authorized('spt.createGalian') || Yii::app()->util->is_authorized('spt.createAir') || Yii::app()->util->is_authorized('spt.createWalet') || Yii::app()->util->is_authorized('spt.createRetribusi') || Yii::app()->util->is_authorized('spt.createBphtb') || Yii::app()->util->is_authorized('spt.createReklameBaru')) {
            $this->render('menu');
        } else {
            if (Yii::app()->user->isGuest)
                $this->redirect(Yii::app()->user->loginUrl);
            else
                throw new CHttpException(403, Yii::t('trans', 'You do not have sufficient permissions to access this page.'));
        }
    }

    public function actionAjaxGetValueHotel() {
        $model = new Spt;
        if (isset($_POST['Spt'])) {
            $model->attributes = $_POST['Spt'];
            $model->nilai = ($model->nilai != '') ? doubleval(str_replace(',', '', $model->nilai)) : 0;
            $model->pajak = $model->nilai * ($model->tarif_persen / 100);
        }
        echo CJSON::encode(array(
            'pajak' => number_format($model->pajak, Yii::app()->params['currency_precision']),
            'nilai' => number_format($model->nilai, Yii::app()->params['currency_precision'])
        ));
    }

    public function actionAjaxGetValueRestoran() {
        $model = new Spt;
        if (isset($_POST['Spt'])) {
            $model->attributes = $_POST['Spt'];
            $model->nilai = ($model->nilai != '') ? doubleval(str_replace(',', '', $model->nilai)) : 0;
            $model->pajak = $model->nilai * ($model->tarif_persen / 100);
        }
        echo CJSON::encode(array(
            'pajak' => number_format($model->pajak, Yii::app()->params['currency_precision']),
            'nilai' => number_format($model->nilai, Yii::app()->params['currency_precision'])
        ));
    }

    public function actionAjaxGetValueHiburan() {
        $model = new Spt;
        if (isset($_POST['Spt']) && isset($_POST['items'])) {
            $model->attributes = $_POST['Spt'];
            $model->nilai = ($model->nilai != '') ? doubleval(str_replace(',', '', $model->nilai)) : 0;
            $items = $_POST['items'];
            $data = array();
            $sum_pajak = 0;
            foreach ($items as $key => $item) {
                if ($key !== 'x') {
                    $nilai = (float) $item['nilai'];
                    $tarif_persen = (float) $item['tarif_persen'];
                    $pajak = $nilai * ($tarif_persen / 100);
                    $data['items_' . $key . 'xpajak'] = number_format($pajak, Yii::app()->params['currency_precision']);
                    $sum_pajak += $pajak;
                }
            }
            $model->pajak = $sum_pajak;
        }
        $rest = CMap::mergeArray(
                        $data, array(
                    'pajak' => number_format($model->pajak, Yii::app()->params['currency_precision']),
                    'nilai' => number_format($model->nilai, Yii::app()->params['currency_precision'])
        ));
        echo CJSON::encode($rest);
    }

    public function actionAjaxGetValueReklame() {
        $model = new Spt;
        if (isset($_POST['Spt'])) {
            $model->attributes = $_POST['Spt'];
            $model->nilai = ($model->nilai != '') ? doubleval(str_replace(',', '', $model->nilai)) : 0;
            $model->pajak = $model->nilai * ($model->tarif_persen / 100);
        }
        echo CJSON::encode(array(
            'pajak' => number_format($model->pajak, Yii::app()->params['currency_precision']),
            'nilai' => number_format($model->nilai, Yii::app()->params['currency_precision'])
        ));
    }

    public function actionAjaxGetValueElectric() {
        $model = new Spt;
        if (isset($_POST['Spt'])) {
            $model->attributes = $_POST['Spt'];
            $model->tarif_dasar = ($model->tarif_dasar != '') ? doubleval(str_replace(',', '', $model->tarif_dasar)) : 0;
            $model->nilai = ($model->nilai != '') ? doubleval(str_replace(',', '', $model->nilai)) : 0;
            $model->dasar_pengenaan = $model->nilai * $model->tarif_dasar;
            $model->pajak = $model->dasar_pengenaan * ($model->tarif_persen / 100);
        }
        echo CJSON::encode(array(
            'pajak' => number_format($model->pajak, Yii::app()->params['currency_precision']),
            'nilai' => number_format($model->nilai, Yii::app()->params['currency_precision']),
            'dasar_pengenaan' => number_format($model->dasar_pengenaan, Yii::app()->params['currency_precision'])
        ));
    }

    public function actionAjaxGetValueAir() {
        $model = new Spt;
        if (isset($_POST['Spt']) && isset($_POST['items'])) {
            $model->attributes = $_POST['Spt'];
            $model->nilai = ($model->nilai != '') ? doubleval(str_replace(',', '', $model->nilai)) : 0;
            $items = $_POST['items'];
            $data = array();
            $sum_pajak = 0;
            foreach ($items as $key => $item) {
                if ($key !== 'x') {
                    $nilai = (float) $item['nilai'];
                    $tarif_persen = (float) $item['tarif_persen'];
                    $tarif_dasar = (float) str_replace(',', '', $item['tarif_dasar']);
                    $dasar_pengenaan = $nilai * $tarif_dasar;
                    $pajak = $dasar_pengenaan * ($tarif_persen / 100);
                    $data['items_' . $key . 'xdasar_pengenaan'] = number_format($dasar_pengenaan, Yii::app()->params['currency_precision']);
                    $data['items_' . $key . 'xpajak'] = number_format($pajak, Yii::app()->params['currency_precision']);
                    $sum_pajak += $pajak;
                }
            }
            $model->pajak = $sum_pajak;
        }
        $rest = CMap::mergeArray(
                        $data, array(
                    'pajak' => number_format($model->pajak, Yii::app()->params['currency_precision']),
                    'nilai' => number_format($model->nilai, Yii::app()->params['currency_precision'])
        ));
        echo CJSON::encode($rest);
    }

    public function actionAjaxGetValueWalet() {
        $model = new Spt;
        if (isset($_POST['Spt']) && isset($_POST['items'])) {
            $model->attributes = $_POST['Spt'];
            $model->nilai = ($model->nilai != '') ? doubleval(str_replace(',', '', $model->nilai)) : 0;
            $items = $_POST['items'];
            $data = array();
            $sum_pajak = 0;
            foreach ($items as $key => $item) {
                if ($key !== 'x') {
                    $nilai = (float) $item['nilai'];
                    $tarif_persen = (float) $item['tarif_persen'];
                    $tarif_dasar = (float) str_replace(',', '', $item['tarif_dasar']);
                    $dasar_pengenaan = $nilai * $tarif_dasar;
                    $pajak = $dasar_pengenaan * ($tarif_persen / 100);
                    $data['items_' . $key . 'xdasar_pengenaan'] = number_format($dasar_pengenaan, Yii::app()->params['currency_precision']);
                    $data['items_' . $key . 'xpajak'] = number_format($pajak, Yii::app()->params['currency_precision']);
                    $sum_pajak += $pajak;
                }
            }
            $model->pajak = $sum_pajak;
        }
        $rest = CMap::mergeArray(
                        $data, array(
                    'pajak' => number_format($model->pajak, Yii::app()->params['currency_precision']),
                    'nilai' => number_format($model->nilai, Yii::app()->params['currency_precision'])
        ));
        echo CJSON::encode($rest);
    }

    public function actionAjaxGetValueGalian() {
        $model = new Spt;
        if (isset($_POST['Spt']) && isset($_POST['items'])) {
            $model->attributes = $_POST['Spt'];
            $model->nilai = ($model->nilai != '') ? doubleval(str_replace(',', '', $model->nilai)) : 0;
            $items = $_POST['items'];
            $data = array();
            $sum_pajak = 0;
            foreach ($items as $key => $item) {
                if ($key !== 'x') {
                    $nilai = (float) $item['nilai'];
                    $tarif_persen = (float) $item['tarif_persen'];
                    $tarif_dasar = (float) str_replace(',', '', $item['tarif_dasar']);
                    $dasar_pengenaan = $nilai * $tarif_dasar;
                    $pajak = $dasar_pengenaan * ($tarif_persen / 100);
                    $data['items_' . $key . 'xdasar_pengenaan'] = number_format($dasar_pengenaan, Yii::app()->params['currency_precision']);
                    $data['items_' . $key . 'xpajak'] = number_format($pajak, Yii::app()->params['currency_precision']);
                    $sum_pajak += $pajak;
                }
            }
            $model->pajak = $sum_pajak;
        }
        $rest = CMap::mergeArray(
                        $data, array(
                    'pajak' => number_format($model->pajak, Yii::app()->params['currency_precision']),
                    'nilai' => number_format($model->nilai, Yii::app()->params['currency_precision'])
        ));
        echo CJSON::encode($rest);
    }

    public function actionAjaxGetValueRetribusi() {
        $model = new Spt;
        if (isset($_POST['Spt']) && isset($_POST['items'])) {
            $model->attributes = $_POST['Spt'];
            $model->nilai = ($model->nilai != '') ? doubleval(str_replace(',', '', $model->nilai)) : 0;
            $items = $_POST['items'];
            $data = array();
            $sum_pajak = 0;
            foreach ($items as $key => $item) {
                if ($key !== 'x') {
                    $nilai = (float) $item['nilai'];
                    $tarif_dasar = (float) str_replace(',', '', $item['tarif_dasar']);
                    $pajak = $nilai * $tarif_dasar;
                    $data['items_' . $key . 'xpajak'] = number_format($pajak, Yii::app()->params['currency_precision']);
                    $sum_pajak += $pajak;
                }
            }
            $model->pajak = $sum_pajak;
        }
        $rest = CMap::mergeArray(
                        $data, array(
                    'pajak' => number_format($model->pajak, Yii::app()->params['currency_precision']),
                    'nilai' => number_format($model->nilai, Yii::app()->params['currency_precision'])
        ));
        echo CJSON::encode($rest);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateHotel() {
        $model = new Spt;
        $model->nomor = 'AUTO';
        $model->jenis_pajak = Spt::JENIS_PAJAK_HOTEL;
        $model->periode = date('Y');
        $model->tanggal_proses = date('d/m/Y');
        $model->tanggal_entry = date('d/m/Y');

        if (isset($_POST['Spt'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            if ($model->validate()) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');

                $model_item = new SptItem;
                $model_item->pajak = $model->pajak;
                $model_item->nilai = $model->nilai;
                $model_item->tarif_dasar = $model->tarif_dasar;
                $model_item->tarif_persen = $model->tarif_persen;
                $model_item->kode_rekening_id = $model->kode_rekening_id;
                $model->kode_rekening_id = Spt::PARENT_HOTEL;
                $flag = $model->save() && $flag;
                $model_item->spt_id = $model->primaryKey;
                $flag = $model_item->save() && $flag;
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create SPTPD Pajak Hotel ID : ') . $model->primaryKey);
                $this->redirect(array('createHotel'));
            }
        }

        $this->render('form_hotel', array(
            'model' => $model,
        ));
    }

    public function actionUpdateHotel($id) {
        $model = $this->loadModel($id);
        $model->tanggal_proses = date('d/m/Y', strtotime($model->tanggal_proses));
        $model->tanggal_entry = date('d/m/Y', strtotime($model->tanggal_entry));
        $model->periode_awal = date('d/m/Y', strtotime($model->periode_awal));
        $model->periode_akhir = date('d/m/Y', strtotime($model->periode_akhir));
        $model_item = SptItem::model()->findByAttributes(array('spt_id' => $model->id));
        $model->kode_rekening_id = $model_item->kode_rekening_id;
        if (isset($_POST['Spt'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            if ($model->validate() && $model->allowUpdate) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');

                $model_item->pajak = $model->pajak;
                $model_item->nilai = $model->nilai;
                $model_item->tarif_dasar = $model->tarif_dasar;
                $model_item->tarif_persen = $model->tarif_persen;
                $model_item->kode_rekening_id = $model->kode_rekening_id;
                $model->kode_rekening_id = Spt::PARENT_HOTEL;
                $flag = $model->save() && $flag;
                $flag = $model_item->save() && $flag;
            } else {
                $flag = false;
                if (!$model->allowUpdate) {
                    Yii::app()->util->setLog(AccessLog::TYPE_ERROR, Yii::t('trans', 'SPTPD ID : {id} sudah di Tetapkan.', array('{id}' => $model->id)));
                }
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update SPTPD Pajak Hotel ID : ') . $model->id);
                $this->redirect(array('index', 'jenis' => Spt::JENIS_PAJAK_HOTEL));
            }
        }

        $this->render('form_hotel', array(
            'model' => $model,
        ));
    }

    public function actionCreateRestoran() {
        $model = new Spt;
        $model->nomor = 'AUTO';
        $model->jenis_pajak = Spt::JENIS_PAJAK_RESTORAN;
        $model->periode = date('Y');
        $model->tanggal_proses = date('d/m/Y');
        $model->tanggal_entry = date('d/m/Y');

        if (isset($_POST['Spt'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            if ($model->validate()) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');

                $model_item = new SptItem;
                $model_item->pajak = $model->pajak;
                $model_item->nilai = $model->nilai;
                $model_item->tarif_dasar = $model->tarif_dasar;
                $model_item->tarif_persen = $model->tarif_persen;
                $model_item->kode_rekening_id = $model->kode_rekening_id;
                $model->kode_rekening_id = Spt::PARENT_HOTEL;
                $flag = $model->save() && $flag;
                $model_item->spt_id = $model->primaryKey;
                $flag = $model_item->save() && $flag;
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create SPTPD Pajak Restoran ID : ') . $model->primaryKey);
                $this->redirect(array('createRestoran'));
            }
        }

        $this->render('form_restoran', array(
            'model' => $model,
        ));
    }

    public function actionUpdateRestoran($id) {
        $model = $this->loadModel($id);
        $model->tanggal_proses = date('d/m/Y', strtotime($model->tanggal_proses));
        $model->tanggal_entry = date('d/m/Y', strtotime($model->tanggal_entry));
        $model->periode_awal = date('d/m/Y', strtotime($model->periode_awal));
        $model->periode_akhir = date('d/m/Y', strtotime($model->periode_akhir));
        $model_item = SptItem::model()->findByAttributes(array('spt_id' => $model->id));
        $model->kode_rekening_id = $model_item->kode_rekening_id;

        if (isset($_POST['Spt'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            if ($model->validate() && $model->allowUpdate) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');

                $model_item->pajak = $model->pajak;
                $model_item->nilai = $model->nilai;
                $model_item->tarif_dasar = $model->tarif_dasar;
                $model_item->tarif_persen = $model->tarif_persen;
                $model_item->kode_rekening_id = $model->kode_rekening_id;
                $model->kode_rekening_id = Spt::PARENT_HOTEL;
                $flag = $model->save() && $flag;
                $flag = $model_item->save() && $flag;
            } else {
                $flag = false;
                if (!$model->allowUpdate) {
                    Yii::app()->util->setLog(AccessLog::TYPE_ERROR, Yii::t('trans', 'SPTPD ID : {id} sudah di Tetapkan.', array('{id}' => $model->id)));
                }
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update SPTPD Pajak Restoran ID : ') . $model->id);
                $this->redirect(array('index', 'jenis' => Spt::JENIS_PAJAK_RESTORAN));
            }
        }

        $this->render('form_restoran', array(
            'model' => $model,
        ));
    }

    public function actionCreateHiburan() {
        $model = new Spt;
        $model->nomor = 'AUTO';
        $model->jenis_pajak = Spt::JENIS_PAJAK_HIBURAN;
        $model->periode = date('Y');
        $model->tanggal_proses = date('d/m/Y');
        $model->tanggal_entry = date('d/m/Y');
        $model->kode_rekening_id = Spt::PARENT_HIBURAN;

        if (isset($_POST['Spt']) && isset($_POST['items'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            if ($model->validate()) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');
                $flag = $model->save() && $flag;
                foreach ($_POST['items'] as $item) {
                    $model_item = new SptItem;
                    $model_item->pajak = str_replace(',', '', $item['pajak']);
                    $model_item->nilai = str_replace(',', '', $item['nilai']);
                    $model_item->tarif_persen = $item['tarif_persen'];
                    $model_item->kode_rekening_id = $item['kode_rekening_id'];
                    $model_item->spt_id = $model->primaryKey;
                    $flag = $model_item->save() && $flag;
                }
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create SPTPD Pajak Hiburan ID : ') . $model->primaryKey);
                $this->redirect(array('createHiburan'));
            }
        }

        $this->render('form_hiburan', array(
            'model' => $model,
        ));
    }

    public function actionUpdateHiburan($id) {
        $model = $this->loadModel($id);
        $model->tanggal_proses = date('d/m/Y', strtotime($model->tanggal_proses));
        $model->tanggal_entry = date('d/m/Y', strtotime($model->tanggal_entry));
        $model->periode_awal = date('d/m/Y', strtotime($model->periode_awal));
        $model->periode_akhir = date('d/m/Y', strtotime($model->periode_akhir));
        if (isset($_POST['Spt']) && isset($_POST['items'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            if ($model->validate() && $model->allowUpdate) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');
                $flag = $model->save() && $flag;
                foreach ($_POST['items'] as $item) {
                    if (!empty($item['items_id']))
                        $model_item = SptItem::model()->findByPk($item['items_id']);
                    else {
                        $model_item = new SptItem;
                        $model_item->spt_id = $model->id;
                    }
                    $model_item->pajak = str_replace(',', '', $item['pajak']);
                    $model_item->nilai = str_replace(',', '', $item['nilai']);
                    $model_item->tarif_persen = $item['tarif_persen'];
                    $model_item->kode_rekening_id = $item['kode_rekening_id'];
                    $flag = $model_item->save() && $flag;
                }
                if ($_POST['deletedItem']) {
                    $criteria = new CDbCriteria();
                    $criteria->condition = "id IN (" . $_POST['deletedItem'] . ")";
                    $flag = SptItem::model()->deleteAll($criteria) && $flag;
                }
            } else {
                $flag = false;
                if (!$model->allowUpdate) {
                    Yii::app()->util->setLog(AccessLog::TYPE_ERROR, Yii::t('trans', 'SPTPD ID : {id} sudah di Tetapkan.', array('{id}' => $model->id)));
                }
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update SPTPD Pajak Hiburan ID : ') . $model->id);
                $this->redirect(array('index', 'jenis' => Spt::JENIS_PAJAK_HIBURAN));
            }
        }

        $this->render('form_hiburan', array(
            'model' => $model,
        ));
    }

    public function actionCreateReklame() {
        $model = new Spt;
        $model->nomor = 'AUTO';
        $model->jenis_pajak = Spt::JENIS_PAJAK_REKLAME;
        $model->periode = date('Y');
        $model->tanggal_proses = date('d/m/Y');
        $model->tanggal_entry = date('d/m/Y');

        if (isset($_POST['Spt'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            if ($model->validate()) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');

                $model_item = new SptItem;
                $model_item->pajak = $model->pajak;
                $model_item->nilai = $model->nilai;
                $model_item->tarif_dasar = $model->tarif_dasar;
                $model_item->tarif_persen = $model->tarif_persen;
                $model_item->kode_rekening_id = $model->kode_rekening_id;
                $model->kode_rekening_id = Spt::PARENT_REKLAME;
                $flag = $model->save() && $flag;
                $model_item->spt_id = $model->primaryKey;
                $flag = $model_item->save() && $flag;
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create SPTPD Pajak Reklame ID : ') . $model->primaryKey);
                $this->redirect(array('createReklame'));
            }
        }

        $this->render('form_reklame', array(
            'model' => $model,
        ));
    }

    public function actionUpdateReklame($id) {
        $model = $this->loadModel($id);
        $model->tanggal_proses = date('d/m/Y', strtotime($model->tanggal_proses));
        $model->tanggal_entry = date('d/m/Y', strtotime($model->tanggal_entry));
        $model->periode_awal = date('d/m/Y', strtotime($model->periode_awal));
        $model->periode_akhir = date('d/m/Y', strtotime($model->periode_akhir));
        $model_item = SptItem::model()->findByAttributes(array('spt_id' => $model->id));
        $model->kode_rekening_id = $model_item->kode_rekening_id;
        if (isset($_POST['Spt'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            if ($model->validate() && $model->allowUpdate) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');

                $model_item->pajak = $model->pajak;
                $model_item->nilai = $model->nilai;
                $model_item->tarif_dasar = $model->tarif_dasar;
                $model_item->tarif_persen = $model->tarif_persen;
                $model_item->kode_rekening_id = $model->kode_rekening_id;
                $model->kode_rekening_id = Spt::PARENT_REKLAME;
                $flag = $model->save() && $flag;
                $flag = $model_item->save() && $flag;
            } else {
                $flag = false;
                if (!$model->allowUpdate) {
                    Yii::app()->util->setLog(AccessLog::TYPE_ERROR, Yii::t('trans', 'SPTPD ID : {id} sudah di Tetapkan.', array('{id}' => $model->id)));
                }
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update SPTPD Pajak Reklame ID : ') . $model->id);
                $this->redirect(array('index', 'jenis' => Spt::JENIS_PAJAK_REKLAME));
            }
        }

        $this->render('form_reklame', array(
            'model' => $model,
        ));
    }

    public function actionCreateElectric() {
        $model = new Spt;
        $model->nomor = 'AUTO';
        $model->jenis_pajak = Spt::JENIS_PAJAK_ELECTRIC;
        $model->periode = date('Y');
        $model->tanggal_proses = date('d/m/Y');
        $model->tanggal_entry = date('d/m/Y');

        if (isset($_POST['Spt'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            $model->tarif_dasar = str_replace(',', '', $model->tarif_dasar);
            $model->dasar_pengenaan = str_replace(',', '', $model->dasar_pengenaan);
            if ($model->validate()) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');

                $model_item = new SptItem;
                $model_item->pajak = $model->pajak;
                $model_item->nilai = $model->nilai;
                $model_item->tarif_dasar = $model->tarif_dasar;
                $model_item->tarif_persen = $model->tarif_persen;
                $model_item->kode_rekening_id = $model->kode_rekening_id;
                $model->kode_rekening_id = Spt::PARENT_ELECTRIC;
                $flag = $model->save() && $flag;
                $model_item->spt_id = $model->primaryKey;
                $flag = $model_item->save() && $flag;
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create SPTPD PPJ / Genset ID : ') . $model->primaryKey);
                $this->redirect(array('createElectric'));
            }
        }

        $this->render('form_electric', array(
            'model' => $model,
        ));
    }

    public function actionUpdateElectric($id) {
        $model = $this->loadModel($id);
        $model->tanggal_proses = date('d/m/Y', strtotime($model->tanggal_proses));
        $model->tanggal_entry = date('d/m/Y', strtotime($model->tanggal_entry));
        $model->periode_awal = date('d/m/Y', strtotime($model->periode_awal));
        $model->periode_akhir = date('d/m/Y', strtotime($model->periode_akhir));
        $model_item = SptItem::model()->findByAttributes(array('spt_id' => $model->id));
        $model->kode_rekening_id = $model_item->kode_rekening_id;
        if (isset($_POST['Spt'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            $model->tarif_dasar = str_replace(',', '', $model->tarif_dasar);
            $model->dasar_pengenaan = str_replace(',', '', $model->dasar_pengenaan);
            if ($model->validate() && $model->allowUpdate) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');

                $model_item->pajak = $model->pajak;
                $model_item->nilai = $model->nilai;
                $model_item->tarif_dasar = $model->tarif_dasar;
                $model_item->tarif_persen = $model->tarif_persen;
                $model_item->kode_rekening_id = $model->kode_rekening_id;
                $model->kode_rekening_id = Spt::PARENT_ELECTRIC;
                $flag = $model->save() && $flag;
                $flag = $model_item->save() && $flag;
            } else {
                $flag = false;
                if (!$model->allowUpdate) {
                    Yii::app()->util->setLog(AccessLog::TYPE_ERROR, Yii::t('trans', 'SPTPD ID : {id} sudah di Tetapkan.', array('{id}' => $model->id)));
                }
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update SPTPD PPJ / Genset ID : ') . $model->id);
                $this->redirect(array('index', 'jenis' => Spt::JENIS_PAJAK_ELECTRIC));
            }
        }

        $this->render('form_electric', array(
            'model' => $model,
        ));
    }

    public function actionCreateGalian() {
        $model = new Spt;
        $model_galian = new SptGalian;
        $model->nomor = 'AUTO';
        $model->jenis_pajak = Spt::JENIS_PAJAK_GALIAN;
        $model->periode = date('Y');
        $model->tanggal_proses = date('d/m/Y');
        $model->tanggal_entry = date('d/m/Y');
        $model->kode_rekening_id = Spt::PARENT_GALIAN;

        if (isset($_POST['Spt']) && isset($_POST['SptGalian']) && isset($_POST['items'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model_galian->attributes = $_POST['SptGalian'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            $model->tarif_dasar = str_replace(',', '', $model->tarif_dasar);
            $model->dasar_pengenaan = str_replace(',', '', $model->dasar_pengenaan);
            $model_galian->jml_rab = str_replace(',', '', $model_galian->jml_rab);
            $model_galian->spt_id = 999;
            if ($model_galian->validate() && $model->validate()) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');
                $flag = $model->save() && $flag;
                $model_galian->spt_id = $model->primaryKey;
                $flag = $model_galian->save() && $flag;
                foreach ($_POST['items'] as $item) {
                    $model_item = new SptItem;
                    $model_item->pajak = str_replace(',', '', $item['pajak']);
                    $model_item->nilai = str_replace(',', '', $item['nilai']);
                    $model_item->tarif_dasar = str_replace(',', '', $item['tarif_dasar']);
                    $model_item->tarif_persen = $item['tarif_persen'];
                    $model_item->kode_rekening_id = $item['kode_rekening_id'];
                    $model_item->spt_id = $model->primaryKey;
                    $flag = $model_item->save() && $flag;
                }
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create SPTPD Mineral Bkn. Logam & Batuan ID : ') . $model->primaryKey);
                $this->redirect(array('createGalian'));
            }
        }

        $this->render('form_galian', array(
            'model' => $model,
            'model_galian' => $model_galian,
        ));
    }

    public function actionUpdateGalian($id) {
        $model = $this->loadModel($id);
        $model_galian = $model->sptGalian;
        $model->tanggal_proses = date('d/m/Y', strtotime($model->tanggal_proses));
        $model->tanggal_entry = date('d/m/Y', strtotime($model->tanggal_entry));
        $model->periode_awal = date('d/m/Y', strtotime($model->periode_awal));
        $model->periode_akhir = date('d/m/Y', strtotime($model->periode_akhir));
        $model_galian->jml_rab = number_format($model_galian->jml_rab, Yii::app()->params['currency_precision']);
        if (isset($_POST['Spt']) && isset($_POST['items'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model_galian->attributes = $_POST['SptGalian'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            $model->tarif_dasar = str_replace(',', '', $model->tarif_dasar);
            $model->dasar_pengenaan = str_replace(',', '', $model->dasar_pengenaan);
            $model_galian->jml_rab = str_replace(',', '', $model_galian->jml_rab);
            if ($model->validate() && $model->allowUpdate) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');
                $flag = $model->save() && $flag;
                $flag = $model_galian->save() && $flag;
                foreach ($_POST['items'] as $item) {
                    if (!empty($item['items_id']))
                        $model_item = SptItem::model()->findByPk($item['items_id']);
                    else {
                        $model_item = new SptItem;
                        $model_item->spt_id = $model->id;
                    }
                    $model_item->pajak = str_replace(',', '', $item['pajak']);
                    $model_item->nilai = str_replace(',', '', $item['nilai']);
                    $model_item->tarif_dasar = str_replace(',', '', $item['tarif_dasar']);
                    $model_item->tarif_persen = $item['tarif_persen'];
                    $model_item->kode_rekening_id = $item['kode_rekening_id'];
                    $flag = $model_item->save() && $flag;
                }
                if ($_POST['deletedItem']) {
                    $criteria = new CDbCriteria();
                    $criteria->condition = "id IN (" . $_POST['deletedItem'] . ")";
                    $flag = SptItem::model()->deleteAll($criteria) && $flag;
                }
            } else {
                $flag = false;
                if (!$model->allowUpdate) {
                    Yii::app()->util->setLog(AccessLog::TYPE_ERROR, Yii::t('trans', 'SPTPD ID : {id} sudah di Tetapkan.', array('{id}' => $model->id)));
                }
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update SPTPD Mineral Bkn. Logam & Batuan ID : ') . $model->id);
                $this->redirect(array('index', 'jenis' => Spt::JENIS_PAJAK_GALIAN));
            }
        }

        $this->render('form_galian', array(
            'model' => $model,
            'model_galian' => $model_galian,
        ));
    }

    public function actionCreateAir() {
        $model = new Spt;
        $model->nomor = 'AUTO';
        $model->jenis_pajak = Spt::JENIS_PAJAK_AIR;
        $model->periode = date('Y');
        $model->tanggal_proses = date('d/m/Y');
        $model->tanggal_entry = date('d/m/Y');
        $model->kode_rekening_id = Spt::PARENT_AIR;

        if (isset($_POST['Spt']) && isset($_POST['items'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            $model->tarif_dasar = str_replace(',', '', $model->tarif_dasar);
            $model->dasar_pengenaan = str_replace(',', '', $model->dasar_pengenaan);
            if ($model->validate()) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');
                $flag = $model->save() && $flag;
                foreach ($_POST['items'] as $item) {
                    $model_item = new SptItem;
                    $model_item->lokasi = $item['lokasi'];
                    $model_item->pajak = str_replace(',', '', $item['pajak']);
                    $model_item->nilai = str_replace(',', '', $item['nilai']);
                    $model_item->tarif_dasar = str_replace(',', '', $item['tarif_dasar']);
                    $model_item->tarif_persen = $item['tarif_persen'];
                    $model_item->kode_rekening_id = $item['kode_rekening_id'];
                    $model_item->spt_id = $model->primaryKey;
                    $flag = $model_item->save() && $flag;
                }
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create SPTPD Pajak Air Bawah Tanah ID : ') . $model->primaryKey);
                $this->redirect(array('createAir'));
            }
        }

        $this->render('form_air', array(
            'model' => $model,
        ));
    }

    public function actionUpdateAir($id) {
        $model = $this->loadModel($id);
        $model->tanggal_proses = date('d/m/Y', strtotime($model->tanggal_proses));
        $model->tanggal_entry = date('d/m/Y', strtotime($model->tanggal_entry));
        $model->periode_awal = date('d/m/Y', strtotime($model->periode_awal));
        $model->periode_akhir = date('d/m/Y', strtotime($model->periode_akhir));
        if (isset($_POST['Spt']) && isset($_POST['items'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            $model->tarif_dasar = str_replace(',', '', $model->tarif_dasar);
            $model->dasar_pengenaan = str_replace(',', '', $model->dasar_pengenaan);
            if ($model->validate() && $model->allowUpdate) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');
                $flag = $model->save() && $flag;
                foreach ($_POST['items'] as $item) {
                    if (!empty($item['items_id']))
                        $model_item = SptItem::model()->findByPk($item['items_id']);
                    else {
                        $model_item = new SptItem;
                        $model_item->spt_id = $model->id;
                    }
                    $model_item->lokasi = $item['lokasi'];
                    $model_item->pajak = str_replace(',', '', $item['pajak']);
                    $model_item->nilai = str_replace(',', '', $item['nilai']);
                    $model_item->tarif_dasar = str_replace(',', '', $item['tarif_dasar']);
                    $model_item->tarif_persen = $item['tarif_persen'];
                    $model_item->kode_rekening_id = $item['kode_rekening_id'];
                    $flag = $model_item->save() && $flag;
                }
                if ($_POST['deletedItem']) {
                    $criteria = new CDbCriteria();
                    $criteria->condition = "id IN (" . $_POST['deletedItem'] . ")";
                    $flag = SptItem::model()->deleteAll($criteria) && $flag;
                }
            } else {
                $flag = false;
                if (!$model->allowUpdate) {
                    Yii::app()->util->setLog(AccessLog::TYPE_ERROR, Yii::t('trans', 'SPTPD ID : {id} sudah di Tetapkan.', array('{id}' => $model->id)));
                }
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update SPTPD Pajak Air Bawah Tanah ID : ') . $model->id);
                $this->redirect(array('index', 'jenis' => Spt::JENIS_PAJAK_AIR));
            }
        }

        $this->render('form_air', array(
            'model' => $model,
        ));
    }

    public function actionCreateWalet() {
        $model = new Spt;
        $model->nomor = 'AUTO';
        $model->jenis_pajak = Spt::JENIS_PAJAK_WALET;
        $model->periode = date('Y');
        $model->tanggal_proses = date('d/m/Y');
        $model->tanggal_entry = date('d/m/Y');
        $model->kode_rekening_id = Spt::PARENT_WALET;

        if (isset($_POST['Spt']) && isset($_POST['items'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            $model->tarif_dasar = str_replace(',', '', $model->tarif_dasar);
            $model->dasar_pengenaan = str_replace(',', '', $model->dasar_pengenaan);
            if ($model->validate()) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');
                $flag = $model->save() && $flag;
                foreach ($_POST['items'] as $item) {
                    $model_item = new SptItem;
                    $model_item->pajak = str_replace(',', '', $item['pajak']);
                    $model_item->nilai = str_replace(',', '', $item['nilai']);
                    $model_item->tarif_dasar = str_replace(',', '', $item['tarif_dasar']);
                    $model_item->tarif_persen = $item['tarif_persen'];
                    $model_item->kode_rekening_id = $item['kode_rekening_id'];
                    $model_item->spt_id = $model->primaryKey;
                    $flag = $model_item->save() && $flag;
                }
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create SPTPD Pajak Walet ID : ') . $model->primaryKey);
                $this->redirect(array('createWalet'));
            }
        }

        $this->render('form_walet', array(
            'model' => $model,
        ));
    }

    public function actionUpdateWalet($id) {
        $model = $this->loadModel($id);
        $model->tanggal_proses = date('d/m/Y', strtotime($model->tanggal_proses));
        $model->tanggal_entry = date('d/m/Y', strtotime($model->tanggal_entry));
        $model->periode_awal = date('d/m/Y', strtotime($model->periode_awal));
        $model->periode_akhir = date('d/m/Y', strtotime($model->periode_akhir));
        if (isset($_POST['Spt']) && isset($_POST['items'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            $model->tarif_dasar = str_replace(',', '', $model->tarif_dasar);
            $model->dasar_pengenaan = str_replace(',', '', $model->dasar_pengenaan);
            if ($model->validate() && $model->allowUpdate) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');
                $flag = $model->save() && $flag;
                foreach ($_POST['items'] as $item) {
                    if (!empty($item['items_id']))
                        $model_item = SptItem::model()->findByPk($item['items_id']);
                    else {
                        $model_item = new SptItem;
                        $model_item->spt_id = $model->id;
                    }
                    $model_item->pajak = str_replace(',', '', $item['pajak']);
                    $model_item->nilai = str_replace(',', '', $item['nilai']);
                    $model_item->tarif_dasar = str_replace(',', '', $item['tarif_dasar']);
                    $model_item->tarif_persen = $item['tarif_persen'];
                    $model_item->kode_rekening_id = $item['kode_rekening_id'];
                    $flag = $model_item->save() && $flag;
                }
                if ($_POST['deletedItem']) {
                    $criteria = new CDbCriteria();
                    $criteria->condition = "id IN (" . $_POST['deletedItem'] . ")";
                    $flag = SptItem::model()->deleteAll($criteria) && $flag;
                }
            } else {
                $flag = false;
                if (!$model->allowUpdate) {
                    Yii::app()->util->setLog(AccessLog::TYPE_ERROR, Yii::t('trans', 'SPTPD ID : {id} sudah di Tetapkan.', array('{id}' => $model->id)));
                }
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update SPTPD Pajak Walet ID : ') . $model->id);
                $this->redirect(array('index', 'jenis' => Spt::JENIS_PAJAK_WALET));
            }
        }

        $this->render('form_walet', array(
            'model' => $model,
        ));
    }

    public function actionCreateRetribusi() {
        $model = new Spt;
        $model->nomor = 'AUTO';
        $model->jenis_pajak = Spt::JENIS_PAJAK_RETRIBUSI;
        $model->periode = date('Y');
        $model->tanggal_proses = date('d/m/Y');
        $model->tanggal_entry = date('d/m/Y');
        $model->kode_rekening_id = Spt::PARENT_RETRIBUSI;

        if (isset($_POST['Spt']) && isset($_POST['items'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            if ($model->validate()) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');
                $flag = $model->save() && $flag;
                foreach ($_POST['items'] as $item) {
                    $model_item = new SptItem;
                    $model_item->pajak = str_replace(',', '', $item['pajak']);
                    $model_item->nilai = str_replace(',', '', $item['nilai']);
                    $model_item->tarif_dasar = str_replace(',', '', $item['tarif_dasar']);
                    $model_item->kode_rekening_id = $item['kode_rekening_id'];
                    $model_item->spt_id = $model->primaryKey;
                    $flag = $model_item->save() && $flag;
                }
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create SPTRD Retribusi ID : ') . $model->primaryKey);
                $this->redirect(array('createRetribusi'));
            }
        }

        $this->render('form_retribusi', array(
            'model' => $model,
        ));
    }

    public function actionUpdateRetribusi($id) {
        $model = $this->loadModel($id);
        $model->tanggal_proses = date('d/m/Y', strtotime($model->tanggal_proses));
        $model->tanggal_entry = date('d/m/Y', strtotime($model->tanggal_entry));
        $model->periode_awal = date('d/m/Y', strtotime($model->periode_awal));
        $model->periode_akhir = date('d/m/Y', strtotime($model->periode_akhir));
        if (isset($_POST['Spt']) && isset($_POST['items'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Spt'];
            $model->nilai = str_replace(',', '', $model->nilai);
            $model->pajak = str_replace(',', '', $model->pajak);
            if ($model->validate() && $model->allowUpdate) {
                if (!empty($model->tanggal_proses) && $model->tanggal_proses != '0000-00-00')
                    $model->tanggal_proses = date_format(date_create_from_format('d/m/Y', $model->tanggal_proses), "Y-m-d");
                else
                    $model->tanggal_proses = new CDbExpression('null');
                if (!empty($model->tanggal_entry) && $model->tanggal_entry != '0000-00-00')
                    $model->tanggal_entry = date_format(date_create_from_format('d/m/Y', $model->tanggal_entry), "Y-m-d");
                else
                    $model->tanggal_entry = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');
                $flag = $model->save() && $flag;
                foreach ($_POST['items'] as $item) {
                    if (!empty($item['items_id']))
                        $model_item = SptItem::model()->findByPk($item['items_id']);
                    else {
                        $model_item = new SptItem;
                        $model_item->spt_id = $model->id;
                    }
                    $model_item->pajak = str_replace(',', '', $item['pajak']);
                    $model_item->nilai = str_replace(',', '', $item['nilai']);
                    $model_item->tarif_dasar = str_replace(',', '', $item['tarif_dasar']);
                    $model_item->kode_rekening_id = $item['kode_rekening_id'];
                    $flag = $model_item->save() && $flag;
                }
                if ($_POST['deletedItem']) {
                    $criteria = new CDbCriteria();
                    $criteria->condition = "id IN (" . $_POST['deletedItem'] . ")";
                    $flag = SptItem::model()->deleteAll($criteria) && $flag;
                }
            } else {
                $flag = false;
                if (!$model->allowUpdate) {
                    Yii::app()->util->setLog(AccessLog::TYPE_ERROR, Yii::t('trans', 'SPTPD ID : {id} sudah di Tetapkan.', array('{id}' => $model->id)));
                }
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update SPTRD Retribusi ID : ') . $model->id);
                $this->redirect(array('index', 'jenis' => Spt::JENIS_PAJAK_RETRIBUSI));
            }
        }

        $this->render('form_retribusi', array(
            'model' => $model,
        ));
    }

    public function actionJsonGetKodeRekening($id = null) {
        $korek = KodeRekening::model()->findByPk($id);
        if ($korek != null) {
            echo CJSON::encode(array(
                'nama' => $korek->nama,
                'tarif_persen' => $korek->tarif_persen,
                'tarif_dasar' => number_format($korek->tarif_dasar, Yii::app()->params['currency_precision'])
            ));
        } else
            echo CJSON::encode(array());
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);
            if ($model->allowUpdate) {
                try {
                    if ($model->delete())
                        Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Delete SPTPD ID : ') . $id);
                } catch (CDbException $exc) {
                    throw new CHttpException(500, Yii::t('trans', 'Delete SPTPD ID : {id}. Item ini sudah dipakai pada transaksi', array('{id}' => $id)));
                }
            } else
                throw new CHttpException(500, Yii::t('trans', 'Delete SPTPD ID : {id}. Item ini sudah ditetapkan.', array('{id}' => $id)));

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
        } else {
            throw new CHttpException(400, Yii::t('trans', 'Invalid request. Please do not repeat this request again.'));
        }
    }

    /**
     * Manages all models.
     */
    public function actionIndex($jenis = null) {
        $jenis = $jenis == null ? Spt::JENIS_PAJAK_HOTEL : $jenis;
        $model = new Spt('search');
        $model->unsetAttributes();  // clear any default values
        $model->jenis_pajak = $jenis;
        if (isset($_GET['Spt'])) {
            $model->attributes = $_GET['Spt'];
        }

        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize' . $model->tableName(), (float) $_GET['pageSize']);
            unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
        }
        Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'Manage SPTPD'));

        $this->render('index', array(
            'model' => $model,
            'jenis' => $jenis
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return SPTPD the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Spt::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('trans', 'The requested page does not exist.'));
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param SPTPD $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'spt-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
