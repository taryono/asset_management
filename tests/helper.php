<?php

//di delete karna jadi g bisa di composer update

function say($text, $text_replace = null, $replace_with = null)
{
    $input = request()->all();
    if (array_key_exists("cek_trans", $input)) {
        (new Lib\core\Translator($text))->isCheck();
        return "%" . ($text) . "%";
    } else {
        if ($text_replace) {
            return str_replace($text_replace, $replace_with, trans('say.' . $text));
        } else {
            return is_array(trans('say')) ? (array_key_exists($text, trans('say')) ? trans('say.' . $text) : $text) : $text;
        }
    }
}

function months(){
    return array(
        1=> say("Januari"), 
        2=> say("Februari"), 3=> say("Maret"),
        4=> say("April"), 
        5=> say("Mei"), 
        6=> say("Juni"),
        7=> say("Juli"), 
        8=> say("Agustus"), 
        9=> say("September"),
        10=> say("Oktober"), 
        11=> say("November"), 
        12=> say("Desember")
    );
}

function rupiahFormat($price, $decimal = 2, $tail = null)
{
    return "Rp. " . number_format((float) preg_replace('/[^0-9\.,]/', '', $price), $decimal) . $tail;
}

function idrFormat($price, $decimal = 2)
{
    return "IDR. " . number_format((float) preg_replace('/[^0-9\.,]/', '', $price), $decimal);
}

function decimalFormat($price, $decimal = 2, $tail = null)
{
    return number_format((float) preg_replace('/[^0-9\.,]/', '', $price), $decimal) . $tail;
}

function numberToAlphabet($num, $uppercase = false)
{
    $num -= 1;

    $letter = chr(($num % 26) + 97);
    $letter .= (floor($num / 26) > 0) ? str_repeat($letter, floor($num / 26)) : '';
    return ($uppercase ? strtoupper($letter) : $letter);
}

function say_number($number)
{
    $words = '';
    $th = array('', 'ribu', 'juta', 'miliar', 'triliun');
    $n = array('nol', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan');
    $te = array('', 'puluh', 'ratus');

    preg_match_all("/./", $number, $digit);
    $digit = $digit[0];
    $number = implode('', array_reverse($digit));

    preg_match_all("/.{1,3}/", $number, $parts);
    $parts = $parts[0];
    for ($i = count($parts) - 1; $i >= 0; --$i) {
        $part = $parts[$i];
        preg_match_all("/./", $part, $digits);
        $digit = $digits[0];
        for ($j = count($digit) - 1; $j >= 0; --$j) {
            $words .= $n[$digit[$j]] . ' ' . $te[$j] . ' ';
        }
        $words .= $th[$i] . " ";
    }

    $x = array('puluh', 'ratus', 'ribu');
    $words = preg_replace("/nol(\w+)? /", "", $words);
    $words = preg_replace("/\s+/", ' ', $words);
    $words = preg_replace("/ratus puluh/", 'ratus', $words);
    $words = preg_replace("/ratus puluh/", 'ratus', $words);
    $words = preg_replace("/ribu ratus/", 'ribu', $words);
    foreach ($x as $y) {
        $words = preg_replace("/satu " . $y . "/", "se$y", $words);
    }
    foreach ($n as $m) {
        $words = preg_replace("/sepuluh " . $m . "/", "$m belas", $words);
    }
    $words = preg_replace("/satu belas/", 'sebelas', $words);
    $words = preg_replace("/juta ratus ribu/", 'juta', $words);
    return $words;
}

function say_numberEng($number)
{

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
            'say_number only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . say_numberEng(abs($number));
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
                $string .= $conjunction . say_numberEng($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = say_numberEng($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= say_numberEng($remainder);
            }
            break;
    }

    if (null !== $fraction && say_numberEng($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

function DateToIndo($date)
{
    if ($date && date('Y', strtotime($date)) > 1) {
        $BulanIndo = months();

        $tahun = date('Y', strtotime($date));
        $bulan = date('n', strtotime($date));
        $tgl = date('d', strtotime($date));

        $result = $tgl . " " . $BulanIndo[(int) $bulan] . " " . $tahun;
    } else {
        $result = null;
    }

    return ($result);
}

function DateToTimeIndo($date)
{
    $BulanIndo = months();
    if ($date && date('Y', strtotime($date)) > 1) {

        $tahun = date('Y', strtotime($date));
        $bulan = date('n', strtotime($date));
        $tgl = date('d', strtotime($date));
        $time = date('H:i', strtotime($date));

        $result = $tgl . " " . $BulanIndo[(int)$bulan] . " " . $tahun . " " . $time;
    } else {
        $result = null;
    }

    return ($result);
}

function DateTimeToHour($date)
{
    if ($date && date('Y', strtotime($date)) > 1) {
        $jam = date('H', strtotime($date));
        $menit = date('i', strtotime($date));

        $result = $jam . ":" . $menit;
    } else {
        $result = null;
    }

    return ($result);
}

function DateTimeToIndo($date)
{
    if ($date && date('Y', strtotime($date)) > 1) {
        $BulanIndo = months();

        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $time = date('H:i', strtotime($date));

        $result = $tgl . " " . $BulanIndo[(int) $bulan] . " " . $tahun;
    } else {
        $result = null;
    }

    return ($result);
}

function dateToInd($date)
{
    if ($date && date('Y', strtotime($date)) > 1) {
        $BulanIndo = array(
            say("Jan"), say("Feb"), say("Mar"),
            say("Apr"), say("Mei"), say("Jun"),
            say("Jul"), say("Agu"), say("Sep"),
            say("Okt"), say("Nov"), say("Des")
        );

        $tahun = date('Y', strtotime($date));
        $bulan = date('n', strtotime($date));
        $tgl = date('d', strtotime($date));

        $result = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
    } else {
        $result = null;
    }
    return ($result);
}

function dateToIndWithoutYear($date)
{
    if ($date && date('Y', strtotime($date)) > 1) {
        $BulanIndo = months();
        $bulan = date('n', strtotime($date));
        $tgl = date('d', strtotime($date));

        $result = $tgl . " " . $BulanIndo[(int) $bulan];
    } else {
        $result = null;
    }
    return ($result);
}

function dateToIndWithYear($date)
{
    if ($date && date('Y', strtotime($date)) > 1) {
        $BulanIndo = months();

        $tahun = date('Y', strtotime($date));
        $bulan = date('n', strtotime($date));
        $tgl = date('d', strtotime($date));

        $result = $tgl . " " . $BulanIndo[(int) $bulan] . " " . $tahun;
    } else {
        $result = null;
    }
    return ($result);
}

function dateToEng($date)
{
    if ($date && date('Y', strtotime($date)) > 1) {
        $year = date('Y', strtotime($date));
        $day = date('d', strtotime($date));
        $daysuf = "<sup style='font-size:8.5px !important'>th</sup>";
        switch ($day) {
            case 1:
                $daysuf = "<sup font-size:8.5px !important'>st</sup>";
                break;
            case 2:
                $daysuf = "<sup font-size:8.5px !important'>nd</sup>";
                break;
            case 3:
                $daysuf = "<sup font-size:8.5px !important'>rd</sup>";
                break;
        }
        $day = ($day < 10) ? $day . $daysuf : $day . $daysuf;
        $result = date('F', strtotime($date)) . " " . $day . ", " . $year;
    } else {
        $result = null;
    }

    return ($result);
}

function DateTimeToEng($date)
{
    if ($date && date('Y', strtotime($date)) > 1) {
        $year = date('Y', strtotime($date));
        $day = date('d', strtotime($date));
        $time = date('H:i', strtotime($date));
        $daysuf = "<sup style='font-size:8.5px !important'>th</sup>";
        switch ($day) {
            case 1:
                $daysuf = "<sup font-size:8.5px !important'>st</sup>";
                break;
            case 2:
                $daysuf = "<sup font-size:8.5px !important'>nd</sup>";
                break;
            case 3:
                $daysuf = "<sup font-size:8.5px !important'>rd</sup>";
                break;
        }
        $day = ($day < 10) ? $day . $daysuf : $day . $daysuf;
        $result = date('F', strtotime($date)) . " " . $day . ", " . $year . " " . $time;
    } else {
        $result = null;
    }

    return ($result);
}

function DateHalf($date)
{
    if ($date && date('Y', strtotime($date)) > 1) {
        $BulanIndo = array(
            say("Jan"), say("Feb"), say("Mar"),
            say("Apr"), say("Mei"), say("Jun"),
            say("Jul"), say("Agu"), say("Sep"),
            say("Okt"), say("Nov"), say("Des")
        );

        $bulan = date('n', strtotime($date));
        $tgl = date('d', strtotime($date));

        $result = $tgl . " " . $BulanIndo[(int) $bulan - 1];
    } else {
        $result = null;
    }

    return ($result);
}

function DateToDay($date)
{
    $HariIndo = array(say("Senin"), say("Selasa"), say("Rabu"), say("Kamis"), say("Jum'at"), say("Sabtu"), say("Minggu"));
    $hari = date('N', strtotime($date));
    $result = $HariIndo[(int) $hari - 1];
    return ($result);
}

function isWeekDay($date)
{
    $day = date('N', strtotime($date));
    return ($day != '6' && $day != '7') ? true : false;
}

function DayToString($day)
{
    $HariIndo = array("", say("Senin"), say("Selasa"), say("Rabu"), say("Kamis"), say("Jum'at"), say("Sabtu"), say("Minggu"));
    $result = array_key_exists($day, $HariIndo) ? $HariIndo[$day] : '';
    return $result;
}

function DayIndo()
{
    return array(1 => say('Senin'), 2 => say('Selasa'), 3 => say('Rabu'), 4 => say('Kamis'), 5 => say('Jumat'), 6 => say('Sabtu'), 7 => say('Minggu'));
}

function NumToDay($num)
{
    if ($num < 8) {
        $day = array(1 => say('Senin'), 2 => say('Selasa'), 3 => say('Rabu'), 4 => say('Kamis'), 5 => say('Jumat'), 6 => say('Sabtu'), 7 => say('Minggu'));
        $result = $day[$num];
    } else {
        $result = null;
    }

    return ($result);
}

function DaySchool()
{
    return array(1 => say('Senin'), 2 => say('Selasa'), 3 => say('Rabu'), 4 => say('Kamis'), 5 => say('Jumat'), 6 => say('Sabtu'));
}

function semester_casting($number)
{
    $text = say('Semester ');
    return $text . $number;
}

function rule_types($number = null)
{
    $rule_types = [
        null => '',
        1 => say('Installment Payment'),
        2 => say('Full Payment 1st Semester'),
        3 => say('Full Payment 1st 2nd Semester'),
    ];
    return ($number > 0) ? $rule_types[$number] : $rule_types;
}

function semesters($number = null)
{
    $semesters = [
        1 => say('Semester 1'),
        2 => say('Semester 2'),
        3 => say('Semester 3'),
        4 => say('Semester 4'),
        5 => say('Semester 5'),
        6 => say('Semester 6'),
        7 => say('Semester 7'),
        8 => say('Semester 8')
    ];
    return ($number > 0) ? $semesters[$number] : $semesters;
}

function payment_types($number = null)
{
    $payment_types = [
        null => '',
        1 => say('Down Payment'),
        2 => say('1st Installment'),
        3 => say('2nd Installment'),
        4 => say('3rd Installment'),
        5 => say('4th Installment'),
        6 => say('5th Installment'),
        7 => say('6th Installment'),
        8 => say('7th Installment'),
        9 => say('8th Installment'),
        10 => say('9th Installment'),
        11 => say('10th Installment'),
        12 => say('11th Installment'),
    ];
    return ($number > 0) ? $payment_types[$number] : $payment_types;
}

function payment_types_aggreement($number = null)
{
    $payment_types = [
        null => '',
        1 => say('Down Payment'),
        2 => "1<sup font-size:8.5px !important'>st</sup> Installment",
        3 => "2<sup font-size:8.5px !important'>nd</sup> Installment",
        4 => "3<sup font-size:8.5px !important'>rd</sup> Installment",
        5 => "4<sup font-size:8.5px !important'>th</sup> Installment",
        6 => "5<sup font-size:8.5px !important'>th</sup> Installment",
        7 => "6<sup font-size:8.5px !important'>th</sup> Installment",
        8 => "7<sup font-size:8.5px !important'>th</sup> Installment",
        9 => "8<sup font-size:8.5px !important'>th</sup> Installment",
        10 => "9<sup font-size:8.5px !important'>th</sup> Installment",
    ];
    return ($number > 0) ? $payment_types[$number] : $payment_types;
}

function numberToMonth($no)
{
    $no = intval($no);
    $bulan = months();
    return (array_key_exists($no, $bulan)) ? $bulan[$no] : "";
}

function numberToMonthC($no)
{
    $bulan = array(
        "", say("JAN"), say("FEB"), say("MAR"), say("APR"), say("MEI"), say("JUN"), say("JUL"), say("AGU"), say("SEP"), say("OKT"), say("NOV"), say("DES")
    );
    return (array_key_exists($no, $bulan)) ? $bulan[intval($no)] : "";
}

function numberToMonthNA($no)
{
    $bulan = array(
        "NA", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    );
    return (array_key_exists($no, $bulan)) ? $bulan[intval($no)] : "";
}

function number_of_working_days($from, $to)
{
    $workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)
    $holidayDays = ['*-01-01', '*-05-01', '*-06-01', '*-08-17', '*-12-24', '*-12-25']; # variable and fixed holidays

    $from = new DateTime($from);
    $to = new DateTime($to);
    $to->modify('+1 day');
    $interval = new DateInterval('P1D');
    $periods = new DatePeriod($from, $interval, $to);

    $days = 0;
    foreach ($periods as $period) {
        if (!in_array($period->format('N'), $workingDays)) continue;
        if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
        if (in_array($period->format('*-m-d'), $holidayDays)) continue;
        $days++;
    }
    return $days;
}

function countIntervalTime($from, $to)
{
    $date1 = new DateTime($from);
    $date2 = new DateTime($to);
    $diff = date_diff($date1, $date2);
    return $diff->format("%a Days %H:%I:%S");
}

function countIntervalBetweenTimeIndo($from,$to)
{   
    if(!$to){
        $to=now();
    }
    $time = \Carbon\Carbon::make($from)->diff($to);
    if($time->y > 0){
        return $time->y. ' tahun yang lalu';
    }else if($time->y==0 && $time->d > 0){
        return $time->d. ' hari yang lalu';
    }else if($time->y==0 && $time->d==0 && $time->i > 0 ){
        return $time->i. ' menit yang lalu';
    }
}

function countIntervalBetweenTimeIndo2($from,$to)
{   
    if(!$to){
        $to=now();
    }
    $time = \Carbon\Carbon::make($from)->diff($to);
    
    return $time->h. ' jam ' .$time->i. ' menit';
}

function getMonthIndo()
{
    $bulan = months();

    return $bulan;
}

function getMonthIndoZero()
{
    $bulan = array(
        '01' => say("Januari"), '02' => say("Februari"),
        '03' => say("Maret"), '04' => say("April"),
        '05' => say("Mei"), '06' => say("Juni"),
        '07' => say("Juli"), '08' => say("Agustus"),
        '09' => say("September"), '10' => say("Oktober"),
        '11' => say("November"), '12' => say("Desember")
    );
    return $bulan;
}

function numberToMonthYear($date)
{
    $month = ucwords(strtolower(numberToMonthC(date('n', strtotime($date)))));
    $year = date('Y', strtotime($date));
    $result = $month . " " . $year;
    return $result;
}

function randomString($length = 6)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';
    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }
    return $string;
}

function age($date1, $date2)
{
    $diff = abs(strtotime($date2) - strtotime($date1));

    $years = floor($diff / (365 * 60 * 60 * 24));
    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    printf("%d Tahun, %d Bulan", $years, $months);
}

function month_interval($date1, $date2)
{
    $strtotime1 = strtotime($date1);
    $day1 = date('d', $strtotime1);
    $month1 = date('m', $strtotime1);
    $year1 = date('Y', $strtotime1);

    $strtotime2 = strtotime($date2);
    $day2 = date('d', $strtotime2);
    $month2 = date('m', $strtotime2);
    $year2 = date('Y', $strtotime2);

    $interval = \Carbon\Carbon::createFromDate($year1, $month1, $day1)->diff(\Carbon\Carbon::parse($day2 . '-' . $month2 . '-' . $year2))->format('%y-%m');

    $intervals = explode('-', $interval);
    $years = $intervals[0];
    $months = $intervals[1];

    // $diff = abs(strtotime($date2) - strtotime($date1));

    // $years = floor($diff / (365 * 60 * 60 * 24));
    // $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    // $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

    $interval = ($years * 12) + $months;
    return $interval;
}

function year_interval($date1, $date2)
{
    $strtotime1 = strtotime($date1);
    $day1 = date('d', $strtotime1);
    $month1 = date('m', $strtotime1);
    $year1 = date('Y', $strtotime1);

    $strtotime2 = strtotime($date2);
    $day2 = date('d', $strtotime2);
    $month2 = date('m', $strtotime2);
    $year2 = date('Y', $strtotime2);

    $interval = \Carbon\Carbon::createFromDate($year1, $month1, $day1)->diff(\Carbon\Carbon::parse($day2 . '-' . $month2 . '-' . $year2))->format('%y-%m');

    $intervals = explode('-', $interval);
    $years = $intervals[0];
    $months = $intervals[1];

    // $diff = abs(strtotime($date2) - strtotime($date1));

    // $years = floor($diff / (365 * 60 * 60 * 24));
    // $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    // $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

    $interval = $years;
    return $interval;
}

function periodMonthByDate($start, $end)
{
    $start = new DateTime($start);
    $end = new DateTime($end);

    $interval = DateInterval::createFromDateString('1 days');
    $period = new DatePeriod($start, $interval, $end);

    $month = [];
    foreach ($period as $dt) {
        $mth = ltrim($dt->format("m"), 0);
        $year = ltrim($dt->format("Y"), 0);
        $month[$mth . '#' . $year] = say(numberToMonth($mth));
    }

    return $month;
}

function periodDate($start, $end)
{
    $start = new DateTime($start);
    $end = new DateTime($end);

    $interval = DateInterval::createFromDateString('1 days');
    $period = new DatePeriod($start, $interval, $end);

    $dates = [];
    foreach ($period as $dt) {
        $mth = ltrim($dt->format("m"), 0);
        $date = ltrim($dt->format("d-m-Y"), 0);
        $dates[$mth] = $date;
    }

    return $dates;
}

function getPaymentLogo($code)
{
    $logo = "";
    switch ($code) {
        case '14':
            $logo = '<img src="/assets/images/payment/alfa-pay-new.png" style="width: 96px;"/>';
            break;
        case '15':
            $logo = '<img src="/assets/images/payment/visa-pay-new.png" style="width: 94px;"/>';
            break;
        case '02':
            $logo = '<img src="/assets/images/payment/mandiri-pay-new.png" style="width: 55px;"/> ';
            break;
        case '05':
            $logo = '<img src="/assets/images/payment/atm-pay-new.png" style="width: 55px;"/> ';
            break;
        case '06':
            $logo = '<img src="/assets/images/payment/bri-pay.png" style="width: 55px;"/> ';
            break;
        case '07':
            $logo = '<img src="/assets/images/payment/atm-pay-new.png" style="width: 55px;"/> ';
            break;
        case '25':
            $logo = '<img src="/assets/images/payment/muamalat.png" style="width: 55px;"/> ';
            break;
        case '26':
            $logo = '<img src="/assets/images/payment/danamon.png" style="width: 55px;"/> ';
            break;
        case '28':
            $logo = '<img src="/assets/images/payment/permata.png" style="width: 55px;"/> ';
            break;
        case '01':
            $logo = '<img src="/assets/images/payment/ovo.png" style="width: 55px;"/> ';
            break;
        default:
            $logo = ' <img  src="/assets/images/payment/doku-pay-new.png" style="width: 50px;"/> ';
            break;
    }
    return $logo;
}

function getPortalPaymentLogo($code)
{
    $logo = "";
    switch ($code) {
        case '14':
            $logo = '<img src="/bo/images/payment/alfa-pay-new.png" style="padding-bottom:10px; width:100px;height:50px;float:right"/>';
            break;
        case '15':
            $logo = '<img src="/bo/images/payment/visa-pay-new.png" style="padding-bottom:10px; width:100px;float:right"/>';
            break;
        case '02':
            $logo = '<img src="/bo/images/payment/mandiri-pay-new.png" style="padding-bottom:10px; width:100px;height:50px;float:right"/> ';
            break;
        case '05':
            $logo = '<img src="/bo/images/payment/atm-pay-new.png" style="padding-bottom:10px; width:100px;float:right"/> ';
            break;
        case '06':
            $logo = '<img src="/bo/images/payment/bri-pay-new.png" style="padding-bottom:10px; width:100px;float:right"/> ';
            break;
        case '07':
            $logo = '<img src="/bo/images/payment/atm-pay-new.png" style="padding-bottom:10px; width:100px;float:right"/> ';
            break;
        case '25':
            $logo = '<img src="/bo/images/payment/muamalat.png" style="padding-bottom:10px; width:100px;float:right"/> ';
            break;
        case '26':
            $logo = '<img src="/bo/images/payment/danamon.png" style="padding-bottom:10px; width:100px;float:right"/> ';
            break;
        case '28':
            $logo = '<img src="/bo/images/payment/permata.png" style="padding-bottom:10px; width:100px;float:right"/> ';
            break;
        case '01':
            $logo = '<img src="/bo/images/payment/ovo.png" style="padding-bottom:10px; width:100px;float:right"/>';
            break;
        default:
            $logo = ' <img  src="/bo/images/payment/doku-pay-new.png" style="padding-bottom:10px; width:100px;float:right"/> ';
            break;
    }
    return $logo;
}

function getPpdbPortalPaymentLogo($code)
{
    $logo = "";
    switch ($code) {
        case '14':
            $logo = '<img src="/images/payment/alfa-pay-new.png" style="padding-bottom:10px; width:100px;height:50px;" class="image-logo"/>';
            break;
        case '15':
            $logo = '<img src="/images/payment/visa-pay-new.png" style="padding-bottom:10px; width:100px;"  class="image-logo"/>';
            break;
        case '02':
            $logo = '<img src="/images/payment/mandiri-pay-new.png" style="padding-bottom:10px; width:100px;height:50px;"  class="image-logo"/> ';
            break;
        case '05':
            $logo = '<img src="/images/payment/atm-pay-new.png" style="padding-bottom:10px; width:100px;"  class="image-logo"/> ';
            break;
        case '06':
            $logo = '<img src="/images/payment/bri-pay-new.png" style="padding-bottom:10px; width:100px;"  class="image-logo"/> ';
            break;
        case '07':
            $logo = '<img src="/images/payment/atm-pay-new.png" style="padding-bottom:10px; width:100px;"  class="image-logo"/> ';
            break;
        case '08':
            $logo = '<img src="/images/payment/mandiri-atm.jpg" style="padding-bottom:10px; width:100px;"  class="image-logo"/> ';
            break;
        case '18':
            $logo = '<img src="/images/payment/bca-pay-new.png" style="padding-bottom:10px; width:100px;"  class="image-logo"/> ';
            break;
        case '25':
            $logo = '<img src="/images/payment/muamalat.png" style="padding-bottom:10px; width:100px;"  class="image-logo"/> ';
            break;
        case '26':
            $logo = '<img src="/images/payment/danamon.png" style="padding-bottom:10px; width:100px;"  class="image-logo"/> ';
            break;
        case '28':
            $logo = '<img src="/images/payment/permata.png" style="padding-bottom:10px; width:100px;"  class="image-logo"/> ';
            break;
        case '29':
            $logo = '<img src="/images/payment/logo-bca.png" style="padding-bottom:10px; width:100px;"  class="image-logo"/> ';
            break;
        case 'CT':
            $logo = '<img src="/images/payment/setor-tunai.png" style="padding-bottom:10px; width:100px;"  class="image-logo"/> ';
            break;
        case 'BT':
            $logo = '<img src="/images/payment/convenience_store.png" style="padding-bottom:10px; width:100px;"  class="image-logo"/> ';
            break;
        default:
            $logo = ' <img  src="/images/payment/doku-pay-new.png" style="padding-bottom:10px; width:100px;"  class="image-logo"/> ';
            break;
    }
    return $logo;
}
   

function isMobile()
{
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
        return true;
    }
    return false;
}

function dateRange($start, $end, $step = '+1 day', $format = 'Y-m-d')
{

    $dates = array();
    $current = strtotime($start);
    $last = strtotime($end);

    while ($current <= $last) {

        $dates[] = date($format, $current);
        $current = strtotime($step, $current);
    }

    return $dates;
}

function isDev()
{
    return (env("APP_ENV") == "local") ? true : false;
}

function isProduction()
{
    return (env("APP_ENV") == "production") ? true : false;
}

function jk($j)
{
    $jk = [
        '' => '',
        0 => '',
        1 => say('Laki-Laki'),
        2 => say('Perempuan')
    ];
    return $jk[$j];
}

function skill($i)
{
    $skill = [
        0 => say('Basic'),
        1 => say('Medium'),
        2 => say('Intermediate')
    ];
    return $skill[$i];
}

function unit_casting($unit)
{
    return "Unit 0" . (($unit < 2) ? $unit : $unit);
}

function relation($j)
{
    $relation = [
        '' => '',
        0 => '',
        1 => say('Anak Kandung'),
        2 => say('Anak Angkat'),
        3 => say('Anak Tiri'),
        4 => say('Adik'),
        5 => say('Sepupu'),
        6 => say('Kakak'),
        7 => say('Ayah'),
        8 => say('Ibu')
    ];
    return $relation[$j];
}

function enquirer_relation($i)
{
    $relation = [
        '' => '',
        0 => '',
        1 => say('Ayah'),
        2 => say('Ibu'),
        3 => say('Wali'),
    ];
    return array_key_exists($i, $relation) ? $relation[$i] : $relation[0];
}

function religi($j)
{
    $religi = [
        '' => '',
        0 => '',
        1 => say('Islam'),
        6 => say('Katolik'),
        4 => say('Hindu'),
        5 => say('Buddha'),
        3 => say('Protestan')
    ];
    return $religi[$j];
}

function marital($j)
{
    $marital = [
        '' => '',
        0 => '',
        1 => say('Menikah'),
        2 => say('Belum Menikah')
    ];
    return $marital[$j];
}

function darah($j)
{
    $darah = [
        '' => '',
        0 => '',
        1 => 'A',
        2 => 'B',
        3 => 'AB',
        4 => 'O'
    ];
    return $darah[$j];
}

function angka($j)
{
    $angka = [
        '' => '',
        0 => '',
        1 => '(Satu)',
        2 => '(Dua)',
        3 => '(Tiga)',
        4 => '(Empat)',
        5 => '(Lima)',
        6 => '(Enam)',
        7 => '(Tujuh)',
        8 => '(Delapan)',
        9 => '(Sembilan)',
        10 => '(Sepuluh)',
        11 => '(Sebelas)',
        12 => '(Dua belas)',
        13 => '(Tiga belas)',
        14 => '(Empat belas)',
        15 => '(Lima belas)',
        15 => '(Enam belas)',
        17 => '(Tujuh belas)',
        18 => '(Delapan belas)',
        19 => '(Sembilan belas)',
        20 => '(Dua puluh)'
    ];
    return array_key_exists($j, $angka) ? $angka[$j] : '';
}

function status($j)
{
    $status = [
        1 => "Diajukan",
        2 => "Disetujui",
        3 => "Ditolak",
    ];
    return array_key_exists($j, $status) ? $status[$j] : "Pending";
}

function hereg_status($j)
{
    $status = [
        1 => "Belum Daftar Ulang",
        2 => "Sudah Daftar Ulang",
    ];
    return array_key_exists($j, $status) ? $status[$j] : "Belum Daftar Ulang";
}

function hereg_colors($index)
{
    $colors = [
        null => "bg-red",
        1 => "bg-red",
        2 => "bg-green",
        3 => "bg-orange",
        4 => "bg-red",
        5 => "bg-green",
        6 => "bg-orange",
    ];
    return array_key_exists($index, $colors) ? $colors[$index] : "bg-purple";
}

function bg_status($index)
{
    $colors = [
        null => "bg-red",
        0 => "bg-red",
        1 => "bg-green",
    ];
    return array_key_exists($index, $colors) ? $colors[$index] : "bg-purple";
}

function student_status($index)
{
    $colors = [
        0 => '<label class="bg-red bg-label">' . say("Not Active (Move)") . '</label>',
        1 => '<label class="bg-green bg-label">' . say("Active") . '</label>',
        2 => '<label class="bg-orange bg-label">' . say("Graduate") . '</label>',
        3 => '<label class="bg-blue bg-label">' . say("On Process Withdrawal") . '</label>',
    ];
    return array_key_exists($index, $colors) ? $colors[$index] : "bg-purple";
}

function installment_status($index)
{
    $colors = [
        null => "bg-red",
        1 => "bg-blue",
        2 => "bg-green",
        3 => "bg-red",
    ];
    return array_key_exists($index, $colors) ? $colors[$index] : "bg-purple";
}

function budget_status($index)
{
    $colors = [
        null => "bg-red",
        1 => "bg-red",
        2 => "bg-blue",
        3 => "bg-green",
        4 => "bg-red",
        5 => "bg-green",
        6 => "bg-orange",
        7 => "bg-red",
        8 => "bg-green",
        10 => "bg-orange",
    ];
    return array_key_exists($index, $colors) ? $colors[$index] : "bg-purple";
}

function new_hereg_colors($index)
{
    $colors = [
        1 => "bg-green",
        2 => "bg-orange",
        null => "bg-orange",
    ];
    return array_key_exists($index, $colors) ? $colors[$index] : "bg-purple";
}

function class_type_colors($index)
{
    $colors = [
        null => "bg-blue",
        1 => "bg-blue",
        2 => "bg-green",
        3 => "bg-orange",
        4 => "bg-red",
        5 => "bg-yellow-crusta",
        6 => "bg-purple",
        7 => "bg-blue",
        8 => "bg-green",
        9 => "bg-orange",
        10 => "bg-red",
        11 => "bg-yellow-crusta",
        12 => "bg-purple",
    ];
    return array_key_exists($index, $colors) ? $colors[$index] : "bg-purple";
}

function is_url_exist($url)
{
    if (is_connected()) {
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);
        if ($url) {
            $headers = get_headers($url, 0, $context);
            if (array_key_exists(0, $headers)) return stripos($headers[0], "200 OK") ? true : false;
        }
    }
    return false;
}

function monthToRoman($month)
{
    $months = [
        1 => 'I',
        2 => 'II',
        3 => 'III',
        4 => 'IV',
        5 => 'V',
        6 => 'VI',
        7 => 'VII',
        8 => 'VIII',
        9 => 'IX',
        10 => 'X',
        11 => 'XI',
        12 => 'XII',
    ];
    return $months[$month];
}

function numberToRoman($number)
{
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
        foreach ($map as $roman => $int) {
            if ($number >= $int) {
                $number -= $int;
                $returnValue .= $roman;
                break;
            }
        }
    }
    return $returnValue;
}

function rageLetter($min, $max)
{
    $pointer = strtoupper($min);
    $output = array();
    while (positionalcomparison($pointer, strtoupper($max)) <= 0) {
        array_push($output, $pointer);
        $pointer++;
    }
    return $output;
}

function positionalcomparison($a, $b)
{
    $a1 = stringtointvalue($a);
    $b1 = stringtointvalue($b);
    if ($a1 > $b1) return 1;
    else if ($a1 < $b1) return -1;
    else return 0;
}

function stringtointvalue($str)
{
    $amount = 0;
    $strarra = array_reverse(str_split($str));

    for ($i = 0; $i < strlen($str); $i++) {
        $amount += (ord($strarra[$i]) - 64) * pow(26, $i);
    }
    return $amount;
}

function day($date)
{
    $day = date('N', strtotime($date));
    return $day;
}

function getPaymentLogoSpp($code)
{
    $logo = "";
    switch ($code) {
        case '01':
            $logo = '<img src="/assets/images/payment/ovo.png" class="bank-icon"/>';
            break;
        case '14':
            $logo = '<img src="/assets/images/payment/alfamart_icon.png" class="bank-icon"/>';
            break;
        case '15':
            $logo = '<img src="/assets/images/payment/cc.png" class="bank-icon"/>';
            break;
        case "02":
            $logo = '<img src="/assets/images/payment/mandiri-atm.jpg" class="bank-icon"/> ';
            break;
        case '05':
            $logo = '<img src="/assets/images/payment/atm-pay-new.png" class="bank-icon"/> ';
            break;
        case '06':
            $logo = '<img src="/assets/images/payment/bri_icon.png" class="bank-icon"/> ';
            break;
        case '07':
            $logo = '<img src="/assets/images/payment/permata_icon.png" class="bank-icon"/> ';
            break;
        case '08':
            $logo = '<img src="/assets/images/payment/mandiri-atm.jpg" class="bank-icon"/> ';
            break;
        case '25':
            $logo = '<img src="/assets/images/payment/muamalat.png" class="bank-icon"/> ';
            break;
        case '26':
            $logo = '<img src="/assets/images/payment/danamon.png" class="bank-icon"/> ';
            break;
        case '28':
            $logo = '<img src="/assets/images/payment/permata_icon.png" class="bank-icon"/> ';
            break;
        case '29':
            $logo = '<img src="/assets/images/payment/bca_icon.png" class="bank-icon"/> ';
            break;
        case '32':
            $logo = '<img src="https://images.lekar.co.id/images/payment/cimbniaga.png"  class="bank-icon">';
            break;
        case '33':
            $logo = '<img src="/assets/images/payment/danamon.png" class="bank-icon"/> ';
            break;
        case '34':
            $logo = '<img src="/assets/images/payment/bri_icon.png" class="bank-icon"/> ';
            break;
        case '35':
            $logo = '<img src="/assets/images/payment/alfamart_icon.png"  class="bank-icon"/> ';
            break;
        case '36':
            $logo = '<img src="/assets/images/payment/permata_icon.png" class="bank-icon"/> ';
            break;
        case '38':
            $logo = '<img src="/assets/images/payment/bni_icon.png" class="bank-icon"/>';
            break;
        case '380':
            $logo = '<img src="/assets/images/payment/bni_icon.png" class="bank-icon"/>';
            break;
        case "202":
            $logo = '<img src="/assets/images/payment/bni_icon.png" class="bank-icon"/>';
            break;
        case '41':
            $logo = '<img src="/assets/images/payment/mandiri_icon.png" class="bank-icon"/> ';
            break;
        case '47':
            $logo = '<img  src="https://images.lekar.co.id/images/payment/logo-atm.png">';
            break;
        case '201':
            $logo = '<img src="/assets/images/payment/permata_icon.png" class="bank-icon"/> ';
            break;
        case '200':
            $logo = '<img src="/assets/images/payment/atm-pay-new.png" class="bank-icon"/>';
            break;
        default:
            $logo = ' <img  src="/assets/images/payment/doku.png" class="bank-icon"/> ';
            break;
    }
    return $logo;
}

function getPaymentLogoGenerated($code)
{
    $logo = "";
    switch ($code) {
        case '14':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/alfagroup.png">';
            break;
        case '15':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/visa-pay-new.png">';
            break;
        case '02':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/mandiri-atm.jpg">';
            break;
        case '05':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/atm-pay-new.png">';
            break;
        case '06':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/bri.png">';
            break;
        case '07':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/permata.png">';
            break;
        case '08':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/mandiri-atm.jpg">';
            break;
        case '25':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/muamalat.png">';
            break;
        case '26':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/danamon.png">';
            break;
        case '28':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/permata.png">';
            break;
        case '29':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/bca.jpg">';
            break;
        case '33':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/danamon.jpg">';
            break;
        case '34':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/bri.png">';
            break;
        case '35':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/alfagroup.png">';
            break;
        case '36':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/permata.png">';
            break;
        case '38':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/bni.png">';
            break;
        case '380':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/bni.png">';
            break;
        case '41':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/mandiri-atm.jpg">';
            break;
        case '200':
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/permata.png">';
            break;
        default:
            $logo = '<img class="bank-icon-bayar mt-1 mb-1" src="/assets/images/payment/doku.png">';
            break;
    }
    return $logo;
}

function feeType($type)
{
    $data = [1 => 'flat', 2 => 'procentage', 3 => 'procentage'];
    return $data[$type];
}

function concatDayAndDate($date)
{
    if (!empty($date) && date('Y', strtotime($date)) > 1) {
        return DateToDay($date) . ', ' . DateToIndo($date);
    } else {
        return '-';
    }
}

function concatDayAndDateEn($date)
{
    if (!empty($date) && date('Y', strtotime($date)) > 1) {
        return DateToDayEn($date) . ', ' . DateToEn($date);
    } else {
        return '-';
    }
}

function DateToDayEn($date)
{
    $HariIndo = array(say("Monday"), say("Thursday"), say("Wednesday"), say("Tuesday"), say("Friday"), say("Saturday"), say("Sunday"));
    $hari = date('N', strtotime($date));
    $result = $HariIndo[(int)$hari - 1];
    return ($result);
}

function DateToEn($date)
{
    if ($date && date('Y', strtotime($date)) > 1) {
        $BulanIndo = array(
            say("JanuarY"), say("February"), say("March"),
            say("April"), say("May"), say("June"),
            say("July"), say("August"), say("September"),
            say("October"), say("November"), say("December")
        );

        $tahun = date('Y', strtotime($date));
        $bulan = date('n', strtotime($date));
        $tgl = date('d', strtotime($date));

        $result = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun;
    } else {
        $result = null;
    }

    return ($result);
}

function employeeTypeRecursive($id)
{
    $ng_employee_type = \Models\ng_employee_type::getChildRecursive($id);
    return $ng_employee_type;
}

function departmentRecursive($id)
{
    $ng_department = \Models\ng_department::getChildRecursive($id);
    return $ng_department;
}

function accalRecursive($id)
{
    $ng_academic_calendar = \Models\ng_academic_calendar::getChildRecursive($id);
    return $ng_academic_calendar;
}

function getEmployeeByAuth($user)
{
    $ng_employee = \Models\ng_employee::where('users_id', isset($user->id) ? $user->id : '')
        ->first();
    return $ng_employee;
}

function getActiveAccal()
{
    $active = \Models\ng_academic_calendar::where('status', 1)
        ->where('parent', 0)
        ->whereIn('ng_department_id', Session()->get('ng_department_ids', ''))
        ->first();

    $active = isset($active->id) ? $active->id : null;
    $accal_active = Session()->get('accal_as', $active);

    return $accal_active;
}

function status_applicant($j)
{
    $status_applicant = [
        1 => say('Active'),
        2 => say('Bucket'),
        3 => say('Paid')
    ];
    $status = array_key_exists($j, $status_applicant) ? $status_applicant[$j] : '';
    return $status;
}

function status_short_semester($j)
{
    $status_short_semester = [
        1 => say('Penambah'),
        2 => say('Perbaikan')
    ];
    $status = array_key_exists($j, $status_short_semester) ? $status_short_semester[$j] : '';
    return $status;
}

function DateTimeIndo($date)
{
    if ($date && date('Y', strtotime($date)) > 1) {
        $BulanIndo = months();

        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $jam = substr($date, 11, 2);
        $menit = substr($date, 13, 3);
        $detik = substr($date, 16, 3);
        $result = $tgl . " " . $BulanIndo[(int) $bulan] . " " . $tahun . " - " . $jam . $menit . $detik;
    } else {
        $result = null;
    }

    return ($result);
}

function first_name($name)
{
    $string = $name;
    $substring = substr($string, 0, strpos($string, ' '));
    return $substring;
}

function program_type($type)
{
    $program_types = [
        '1' => say('Program 1 Tahun'),
        '2' => say('Program Course'),
        '3' => say('Program Reguler')
    ];
    $program_type = array_key_exists($type, $program_types) ? $program_types[$type] : '';
    return $program_type;
}

function fine_types($type = null)
{
    $fine_types = [
        NUll => say('Pilih Denda'),
        '1' => say('Monthly'),
        '2' => say('Fixed'),
    ];

    return (array_key_exists($type, $fine_types)  && $type > null ? $fine_types[$type] : $fine_types);
}

function fine_statuses($type = null)
{
    $fine_types = [
        NUll => say('Pilih Status'),
        '1' => say('Aktif'),
        '2' => say('Tidak Aktif'),
    ];
    return (array_key_exists($type, $fine_types)   && $type > null) ? $fine_types[$type] : $fine_types;
}

function programs($no)
{
    $programs = [
        NUll => '',
        '1' => say('1st Program Selections'),
        '2' => say('2nd Program Selections'),
        '3' => say('3rd Program Selections'),
        '4' => say('4th Program Selections'),
        '5' => say('5th Program Selections'),
        '6' => say('6th Program Selections'),
        '7' => say('7th Program Selections'),
        '8' => say('8th Program Selections'),
        '9' => say('9th Program Selections'),
    ];
    return array_key_exists($no, $programs) ? $programs[$no] : $programs;
}

function search($controller, $key)
{

    if (Session()->has('filter')) {
        if (array_key_exists('controller_name', Session()->get('filter'))) {
            if (strtolower(Session()->get('filter')['controller_name']) == $controller) {
                return array_key_exists($key, Session()->get('filter')) ? Session()->get('filter')[$key] : null;
            }
        }
    }
}

function fix_keys($array)
{
    foreach ($array as $k => $val) {
        if (is_array($val))
            $array[$k] = fix_keys($val); //recurse
    }
    return array_values($array);
}

function month_range($date_start, $date_end)
{
    $start    = (new DateTime($date_start))->modify('first day of this month');
    $end      = (new DateTime($date_end))->modify('first day of next month');
    $interval = DateInterval::createFromDateString('1 month');
    $period   = new DatePeriod($start, $interval, $end);
    $data = array();

    foreach ($period as $dt) {
        $data_month = array(
            'month' => $dt->format("m"),
            'year' => $dt->format("Y")
        );
        array_push($data, $data_month);
    }

    //Array( 'month'   => '2', 'year'    => '2016');
    return $data;
}

function iconText($ng_academic_calendar, $key)
{
    if ($ng_academic_calendar->ng_department->ng_department_level->code == 'MA') {
        $text = [
            'pembelajaran' => say('Agenda Kelas'),
            'jadwal' => say('Agenda Kelas')
        ];
    } elseif ($ng_academic_calendar->ng_department->ng_department_level->code == 'TK') {
        $text = [
            'pembelajaran' => say('Jurnal Kelas'),
            'jadwal' => say('Jadwal Kegiatan')
        ];
    } else {
        $text = [
            'pembelajaran' => say('Jurnal Kelas'),
            'jadwal' => say('Jadwal Kelas')
        ];
    }
    return $text[$key];
}

function time_diff($start, $end)
{
    $now = new DateTime($end);
    $then = new DateTime($start);
    $diff = $now->diff($then);
    echo $diff->format('%H Jam %i Menit');
}

function time_diff_hours($start, $end)
{
    $now = new DateTime($end);
    $then = new DateTime($start);
    $diff = $now->diff($then);

    return $diff->format('%h');
}

function thousand($angka)
{

    $hasil_rupiah = number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function getTypeGradeCam()
{
    $type = array(
        1 => say("Harian"), say("Mingguan"), say("Bulanan")
    );

    return $type;
}

function getTextTypeGradeCam($key)
{
    $type = array(
        1 => say("Harian"), say("Mingguan"), say("Bulanan")
    );

    $text = array_key_exists($key, $type) ? $type[$key] : '';

    return $text;
}

function accalDefault($ng_department_id)
{
    $acl_actv = \Models\ng_academic_calendar::where('status', 1)
        ->where('parent', 0);

    $acl_actv->whereIn('ng_department_id', departmentRecursive($ng_department_id));

    $acl_actv = $acl_actv->first();

    $acl_actv = isset($acl_actv->id) ? $acl_actv->id : null;
    return $acl_actv;
}

function courseConversion()
{
    $conversions = [
        1 => ['remark' => 'K', 'desc' => say('Baru Mulai')],
        2 => ['remark' => 'C', 'desc' => say('Cukup Baik')],
        3 => ['remark' => 'B', 'desc' => say('Baik')],
        4 => ['remark' => 'SB', 'desc' => say('Sangat Baik')]
    ];

    return $conversions;
}

function courseConversionRemark()
{
    $conversions = [
        1 => 'K',
        2 => 'C',
        3 => 'B',
        4 => 'SB'
    ];

    return $conversions;
}

function weeks()
{
    $weeks = [
        1 => say('Minggu ke - 1'),
        2 => say('Minggu ke - 2'),
        3 => say('Minggu ke - 3'),
        4 => say('Minggu ke - 4')
    ];

    return $weeks;
}

function specSeq($spec_code)
{
    $default = in_array($spec_code, ['PAS', 'PTS']) ? 1 : 2;
    return $default;
}

function tasks()
{
    $taks = [0 => say('Tidak Ada Tugas'), 1 => say('Ada Tugas')];
    return $taks;
}

function getTask($student_task)
{
    $taks = [0 => say('Tidak Ada Tugas'), 1 => say('Ada Tugas')];
    $task = array_key_exists($student_task, $taks) ? $taks[$student_task] : '';
    return $task;
}

function reports($key = null)
{
    $data = [
        1 => say('NERACA'),
        2 => say('LABA - RUGI'),
    ];

    return ($key) ? $data[$key] : $data;
}

function cashes($key = null)
{
    $data = [
        1 => say('Debet'),
        2 => say('Kredit'),
    ];

    return ($key) ? $data[$key] : $data;
}

function babSequence()
{
    $babSequence = [];

    for ($i = 1; $i <= 20; $i++) {
        $babSequence[$i] = $i;
    }

    return $babSequence;
}

function diff($date1, $date2)
{

    $now = strtotime($date1);
    $your_date = strtotime($date2);

    if ($your_date < $now) {
        return 0;
    }

    $datediff = $your_date - $now;

    return round($datediff / (60 * 60 * 24));
}

function detailText($text, $limit)
{
    // $text = checkDetailDiv($text); //check div
    // $text = checkDetailVideo($text); //check video
    // $text = checkDetailImage($text); //check image
    // $text = checkDetailBr($text); //check br
    $text = strip_tags($text);

    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

function checkDetailDiv($text)
{
    $text = preg_replace("/<div[^>]+>/i", "", $text);
    $text = preg_replace("<div>", "", $text);
    $text = preg_replace("</div>", "", $text);
    $text = preg_replace("<>", "", $text);
    $text = preg_replace("/<[^>]*?>/", "", $text);
    return $text;
}

function checkDetailVideo($text)
{
    $text = preg_replace('/<iframe.*?\/iframe>/i', '', $text);
    return $text;
}

function checkDetailImage($text)
{
    $text = preg_replace("/<img[^>]+\>/i", "", $text);
    return $text;
}

function checkDetailBr($text)
{
    // $text = str_replace("<p></p>", "", $text);
    // $text = str_replace("<p><br></p>", "", $text);
    $text = preg_replace("/<p[^>]*?>/", "", $text);
    $text = str_replace("</p>", "", $text);
    $text = preg_replace("/<span[^>]*?>/", "", $text);
    $text = str_replace("</span>", "", $text);
    $text = str_replace("<br>", "", $text);
    return $text;
}

function clear_space($string)
{
    return trim(preg_replace("/\r|\n/", '', $string));
}

function getWorkingDays($startDate, $endDate)
{
    $begin = strtotime($startDate);
    $end   = strtotime($endDate);
    if ($begin > $end) {
        return 0;
    } else {
        $no_days  = 0;
        $weekends = 0;
        while ($begin <= $end) {
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);
            if ($what_day > 5) { // 6 and 7 are weekend days
                $weekends++;
            };
            $begin += 86400; // +1 day
        };
        $working_days = $no_days - $weekends;
        $working_days = $working_days > 0 ? $working_days - 1 : 0;

        return $working_days;
    }
}

function getImg($url)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}

function dropDown($name, $data, $selected = null, $attributes = [], $is_with_empty_option = false, $title = null)
{
    $title = $title ? say($title) : say('--Pilih --');
    $html = '<select name="' . $name . '"';
    $select = 'selected=';
    if ($attributes) {
        foreach ($attributes as $key => $attribute) {
            $html .= $key . '="' . $attribute . '"';
        }
    }
    $html .= '>';
    if ($is_with_empty_option) {
        $html .= '<option value="">' . $title . '</option>';
    }
    if (is_array($data)) {
        $data = (object) $data;
    }
    foreach ($data as $row) {
        if ($selected) {
            if (is_array($selected)) {
                if (in_array($row->id, $selected)) {
                    $select .= '"selected"';
                }
            } else {
                if ($selected == $row->id) {
                    $select .= '"selected"';
                }
            }
        }

        $html .= '<option value="' . $row->id . '" ' . $select . '>' . $row->name . '</option>';
    }
    $html .= '</select>';
    return $html;
}

function getBr($text1, $text2, $limit = 25)
{
    $br = 0;
    if ($text1 > $text2) {
        $total = $text1 - $text2;
        $br1 = ($text1 % $limit) > 0 ? (($text1 - $text1 % $limit) / $limit) + 1 : $text1 / $limit;
        $limit = $limit + 6;
        $br2 = ($text2 % $limit) > 0 ? (($text2 - $text2 % $limit) / $limit) + 1 : $text2 / $limit;
        $br = $br1 - $br2;
    }
    return $br;
}

function is_connected()
{
    $connected = @fsockopen("www.google.com", 80);
    //website, port  (try 80 or 443)
    if ($connected) {
        $is_conn = true; //action when connected
        fclose($connected);
    } else {
        $is_conn = false; //action in connection failure
    }
    return $is_conn;
}

function guidv4($data = null)
{
    $data = $data ?? random_bytes(16);

    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function parse_xml($string)
{
    $xml = @simplexml_load_string($string);

    if ($string != '') {
        $request = json_decode(json_encode($xml));

        return $request;
    }

    return false;
}

function concatDayAndDateAbsence($date)
{
    if (!empty($date) && $date != "0000-00-00") {
        return DateToDay($date) . ', ' . dateToInd($date);
    } else {
        return '-';
    }
}

/**
 * $message = "Silahkan lakukan pembayaran dengan Virtual Account @paycode lewat channel @name, Berlaku s.d @due_date. cek email untuk proses pembayaran. Info hub @phone";
 * echo replaceString(['@paycode'=> 1,'@name'=> 2,'@due_date'=> 3,'@phone'=> 4],$message)
 */

function replaceString($replaceWith = [], $string = '')
{
    $result = '';
    foreach ($replaceWith as $key => $value) {
        $result = (empty($result)) ? str_replace($key, $value, $string) : str_replace($key, $value, $result);
    }
    return $result;
}

function getQueryLogs($isLogs = false)
{
    try {
        if (env("APP_ENV") == "local") {
            $input = request()->all();
            $sql_ = \DB::getQueryLog();

            if (array_key_exists("all_query", $input)) {
                dump($sql_);
            }

            if (array_key_exists("index_query", $input)) {
                $query = $sql_[$input["index_query"]];
            } else {
                $query = end($sql_);
            }
            if ($query) {
                if (is_array($query)) {
                    $sql = $query['query'];
                    $list = $query['bindings'];
                    $replace = array_values($list);
                    $temp = "";
                    $explode = explode("?", $sql);
                    foreach ($replace as $key => $value) {
                        if (is_string($value)) {
                            $temp .= $explode[$key] . "'" . $value . "'";
                        } else {
                            $temp .= $explode[$key] . $value;
                        }
                    }
                    if (array_key_exists("testing", $input)) {
                        dump($temp);
                    } else {
                        if ($isLogs) {
                            dump($temp);
                        }
                    }
                }
            }
        }
    } catch (\Exception $e) {
        if (env("APP_ENV") == "local") {
            dump($e->getMessage(), $e->getLine());
        }
    }
}

function weekOfMonth($date)
{
    //Get the first day of the month.
    $firstOfMonth = strtotime(date("Y-m-01", $date));
    //Apply above formula.
    return weekOfYear($date) - weekOfYear($firstOfMonth) + 1;
}

function weekOfYear($date)
{
    $weekOfYear = intval(date("W", $date));
    if (date('n', $date) == "1" && $weekOfYear > 51) {
        // It's the last week of the previos year.
        $weekOfYear = 0;
    }
    return $weekOfYear;
}

// use for payroll
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0);
    return $hasil_rupiah;
}

function diff_minutes($date1, $date2)
{
    $datetime1 = strtotime($date1);
    $datetime2 = strtotime($date2);
    $interval  = abs($datetime2 - $datetime1);
    $minutes   = round($interval / 60);

    return $minutes;
}

function time_diff2($start, $end, $format)
{
    $now = new DateTime($start);
    $then = new DateTime($end);
    $diff = $now->diff($then);
    echo $diff->format($format);
}

function randomString2($length = 6)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';
    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }
    return $string;
}

function excelDateFormat($date)
{
    return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date);
}

function excelDateFormatTimestamp($date)
{
    return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($date);
}

function templates_indikator()
{
    $templates = [
        1 => say('Bimbingan Konseling'),
        2 => say('Tilawati'),
        3 => say('Tahfidz'),
        4 => say('Ekskul')
    ];

    return $templates;
}

function getFirstName($name)
{
    $result_name = $name;
    if (strlen($name) > 10) {
        $splitted_name = explode(' ', $name);
        if (strlen($splitted_name[0]) < 3) {
            if (array_key_exists(1, $splitted_name)) {
                $result_name = $splitted_name[0] . ' ' . $splitted_name[1];
            } else {
                $result_name = $name;
            }
        } else {
            $result_name = $splitted_name[0];
        }
    }
    return $result_name;
}

function reduce_array_dimension($array)
{
    $keys = [];
    foreach ($array as $key => $ar) {
        foreach ($ar as $k => $v) {
            $keys[$k] = $v;
        }
    }
    return $keys;
}

function has_task()
{
    $params = func_get_args();
    return \Lib\core\globalTools::has_task_lighter(is_exists(0, $params, false), is_exists(1, $params, false), is_exists(2, $params, true), is_exists(3, $params, false), is_exists(4, $params, []), is_exists(5, $params, false), is_exists(6, $params, []));
}

function has_module($module)
{
    return \Lib\core\globalTools::has_module($module);
}

function is_exists($i, $arg, $default)
{
    if (is_array($arg)) {
        return (array_key_exists($i, $arg)) ? $arg[$i] : $default;
    } else {
        return (isset($arg)) ? $arg->{$i} : $default;
    }
}

function workTotalTime($from, $to)
{
    $date1 = new DateTime($from);
    $date2 = new DateTime($to);
    $diff = date_diff($date1, $date2);
    return $diff->format("%H:%I:%S");
}

function DateToDayAbsance($date)
{
    $HariIndo = array(say('Senin'), say('Selasa'), say('Rabu'), say('Kamis'), say('Jumat'), say('Sabtu'), say('Minggu'));
    $hari = date('N', strtotime($date));
    $result = $HariIndo[(int) $hari - 1];
    return ($result);
}

function __theme($code, $fallback = null)
{
    $app_preferences = session()->get('app_preferences');
    return array_key_exists($code, $app_preferences) ? $app_preferences[$code] : $fallback;
}

function dateFormat($date, $client_id = null) {
    if($client_id && $client_id == 43){
        return date('d/m/y', strtotime($date)) . " - " . date('H:i', strtotime($date));
    }
    $month = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'sept', 'oct', 'nov', 'dec'];
    return date('d-M-Y H:i', strtotime($date));
} 

function next_month($format = "M"){
    return date($format, strtotime(date("Y-".(date(date('n')+1)."-d"))))."’".date('y');
}

function MonthYear($date)
{
    if ($date && date('Y', strtotime($date)) > 1) {
        $BulanIndo = months();

        $tahun = date('Y', strtotime($date));
        $bulan = date('n', strtotime($date));

        $result = $BulanIndo[(int) $bulan] . " " . $tahun;
    } else {
        $result = null;
    }

    return ($result);
}
function isJson($value){
    return is_object(json_decode($value));
}
function statusFamilyChild(){
    $statusFamilyChild = [
        1 => say('Anak Kandung'),
        2 => say('Anak Angkat'),
        3 => say('Anak Tiri')
    ];
    return $statusFamilyChild;
}