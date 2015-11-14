<?php

class UtilComponent extends CApplicationComponent {

    public function init() {
        
    }

    public function setLog($type, $msg) {
        $user_id = Yii::app()->user->id;
        $log = new AccessLog;
        $log->user_id = $user_id;
        $log->type = $type;
        $log->activity = $msg;
        $log->save();
        if ($log->type == AccessLog::TYPE_ERROR || $log->type == AccessLog::TYPE_SUCCESS)
            Yii::app()->user->setFlash($log->typeText, ucfirst($log->typeText) . '!|' . $log->activity);
    }

    public function is_authorized($operation) {
        if (Yii::app()->user->isGuest) {
            return FALSE;
        } else {
            if (!in_array($operation, Yii::app()->session['operationArray']))
                return FALSE;
        }
        return TRUE;
    }

    public function setParamInc($data = array()) {
        $file = dirname(__FILE__) . '/../config/params.inc';
        $content = file_get_contents($file);
        $arr = unserialize(base64_decode($content));
        foreach ($data as $k => $d) {
            $arr[$k] = $d;
        }
        $str = base64_encode(serialize($arr));
        file_put_contents($file, $str);
    }

    public function printButton($controller, $id) {
        $rep = new WPJasper();
        $button = array();
        foreach ($rep->getTypes() as $type) {
            $button[] = array('label' => Yii::t('trans', 'As {file_ext}', array('{file_ext}' => strtoupper($type['name']))), 'url' => Yii::app()->createUrl($controller . '/jPrint', array('id' => $id, 'type_report' => $type['name'])));
        }
        return TbHtml::buttonDropdown(Yii::t('trans', 'Print'), $button, array('size' => TbHtml::BUTTON_SIZE_SMALL));
    }

    public function _ini_set_timeout() {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
    }

    public function terbilang($satuan) {
        if (strpos($satuan, '.')) {
            $tmp = explode('.', $satuan);
            $satuan = $tmp[0];
        }
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam",
            "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        if ($satuan < 12)
            return " " . $huruf[$satuan];
        elseif ($satuan < 20)
            return $this->terbilang($satuan - 10) . " belas";
        elseif ($satuan < 100)
            return $this->terbilang($satuan / 10) . " puluh" .
                    $this->terbilang($satuan % 10);
        elseif ($satuan < 200)
            return " seratus" . $this->terbilang($satuan - 100);
        elseif ($satuan < 1000)
            return $this->terbilang($satuan / 100) . " ratus" .
                    $this->terbilang($satuan % 100);
        elseif ($satuan < 2000)
            return " seribu" . $this->terbilang($satuan - 1000);
        elseif ($satuan < 1000000)
            return $this->terbilang($satuan / 1000) . " ribu" .
                    $this->terbilang($satuan % 1000);
        elseif ($satuan < 1000000000)
            return $this->terbilang($satuan / 1000000) . " juta" .
                    $this->terbilang($satuan % 1000000);
        elseif ($satuan >= 1000000000)
            echo "Angka terlalu Besar";
    }

    public function number_to_words($number) {
        if (Yii::app()->language == 'id') {
            $before_comma = trim($this->terbilang($number));
            $after_comma = trim($this->comma($number));
            if (strpos($number, '.'))
                return ucwords($results = $before_comma . ' koma ' . $after_comma);
            else
                return ucwords($results = $before_comma);
        } else {
            return $this->convert_number($number);
        }
    }

    public function comma($number) {
        $after_comma = stristr($number, '.');
        $arr_number = array(
            "nol",
            "satu",
            "dua",
            "tiga",
            "empat",
            "lima",
            "enam",
            "tujuh",
            "delapan",
            "sembilan");

        $results = "";
        $length = strlen($after_comma);
        $i = 1;
        while ($i < $length) {
            $get = substr($after_comma, $i, 1);
            $results .= " " . $arr_number[$get];
            $i++;
        }
        return $results;
    }

    public
            function convert_number($number) {

        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'fourty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion',
            1000000000000 => 'trillion',
            1000000000000000 => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                    'only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . $this->convert_number(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->convert_number($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->convert_number($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }

}
