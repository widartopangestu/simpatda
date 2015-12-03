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
            throw new CHttpException(403, Yii::t('trans', 'You do not have sufficient permissions to access this page.'));
        }
    }

    public function actionAjaxGetValueHotel($id = null) {
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

    public function actionAjaxGetValueRestoran($id = null) {
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

    public function actionAjaxGetValueHiburan($id = null) {
        $model = new Spt;
        if (isset($_POST['Spt']) && isset($_POST['items'])) {
            $model->attributes = $_POST['Spt'];
            $model->nilai = ($model->nilai != '') ? doubleval(str_replace(',', '', $model->nilai)) : 0;
            $items = $_POST['items'];
            $data = array();
            $sum_pajak = 0;
            foreach ($items as $key => $item) {
                $dasar_pengenaan = (int) $item['dasar_pengenaan'];
                $tarif_persen = (int) $item['tarif_persen'];
                $pajak = $dasar_pengenaan * ($tarif_persen / 100);
                $data['items_' . $key . 'xpajak'] = number_format($pajak, Yii::app()->params['currency_precision']);
                $sum_pajak += $pajak;
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

    public function actionAjaxGetValueReklame($id = null) {
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

    public function actionAjaxGetValueElectric($id = null) {
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

    public function actionAjaxGetValueAir($id = null) {
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

    public function actionAjaxGetValueWalet($id = null) {
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

    public function actionAjaxGetValueGalian($id = null) {
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

    public function actionAjaxGetValueRetribusi($id = null) {
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

    public function actionAjaxGetValueBphtb($id = null) {
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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateHotel() {
        $model = new Spt;
        $model->nomor = 'AUTO';
        $model->jenis_surat_id = Spt::JENIS_SURAT;
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
        $model->npwpd = $model->wajibpajak->npwpd;
        $model_item = SptItem::model()->findByAttributes(array('spt_id' => $model->id));
        $model->kode_rekening_id = $model_item->kode_rekening_id;
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
        $model->jenis_surat_id = Spt::JENIS_SURAT;
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
        $model->npwpd = $model->wajibpajak->npwpd;
        $model_item = SptItem::model()->findByAttributes(array('spt_id' => $model->id));
        $model->kode_rekening_id = $model_item->kode_rekening_id;

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
        $model->jenis_surat_id = Spt::JENIS_SURAT;
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
                    $model_item->nilai = str_replace(',', '', $item['dasar_pengenaan']);
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
        $model->npwpd = $model->wajibpajak->npwpd;
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
                    if (!empty($item['items_id']))
                        $model_item = SptItem::model()->findByPk($item['items_id']);
                    else {
                        $model_item = new SptItem;
                        $model_item->spt_id = $model->id;
                    }
                    $model_item->pajak = str_replace(',', '', $item['pajak']);
                    $model_item->nilai = str_replace(',', '', $item['dasar_pengenaan']);
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
        
    }

    public function actionUpdateReklame($id) {
        
    }

    public function actionCreateElectric() {
        
    }

    public function actionUpdateElectric($id) {
        
    }

    public function actionCreateGalian() {
        
    }

    public function actionUpdateGalian($id) {
        
    }

    public function actionCreateAir() {
        
    }

    public function actionUpdateAir($id) {
        
    }

    public function actionCreateWalet() {
        
    }

    public function actionUpdateWalet($id) {
        
    }

    public function actionCreateRetribusi() {
        
    }

    public function actionUpdateRetribusi($id) {
        
    }

    public function actionCreateBphtb() {
        
    }

    public function actionUpdateBphtb($id) {
        
    }

    public function actionCreateReklameBaru() {
        
    }

    public function actionUpdateReklameBaru($id) {
        
    }

    public function actionJsonGetKodeRekening($id = null) {
        $korek = KodeRekening::model()->findByPk($id);
        if ($korek != null) {
            echo CJSON::encode(array(
                'nama' => $korek->nama,
                'tarif_persen' => $korek->tarif_persen,
                'tarif_dasar' => $korek->tarif_dasar
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
            try {
                if ($this->loadModel($id)->delete())
                    Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Delete SPTPD ID : ') . $id);
            } catch (CDbException $exc) {
                throw new CHttpException(500, Yii::t('trans', 'Delete SPTPD ID : {id}. Item ini sudah dipakai pada transaksi', array('{id}' => $id)));
            }
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
            Yii::app()->user->setState('pageSize' . $model->tableName(), (int) $_GET['pageSize']);
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
