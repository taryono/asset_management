<?php
use Illuminate\Database\Eloquent\Collection;
function say($text)
{
    return trans($text);
}

function rupiahFormat($amount)
{
    return "Rp. " . number_format(floatval($amount), 2);
}

function isDev()
{
    return env("local");
}

function create($attributes)
{
    return (new \Lib\Button($attributes))->create();
}

function edit($attributes)
{
    return (new \Lib\Button($attributes))->edit();
}

function show($attributes)
{
    return (new \Lib\Button($attributes))->show();
}

function preview($attributes)
{
    return (new \Lib\Button($attributes))->preview();
}

function cetak($attributes)
{
    return (new \Lib\Button($attributes))->print();
}

function hapus($attributes)
{
    return (new \Lib\Button($attributes))->destroy();
}

function kembali($attributes)
{
    return (new \Lib\Button($attributes))->back();
}

function submit($attributes = null)
{
    return (new \Lib\Button($attributes))->submit();
}

function can($access)
{
    return auth()->user()->can($access);
}

function generate_tree($pages, $r = false)
{
    $html = "";
    $down02 = $r ? "drop-down02" : "";
    $menu02 = $r ? "sub-menu02" : "";
    foreach ($pages as $page) {
        if ($page->children->count() > 0) {
            $html .= '<li class="nav-item dropdown ' . $down02 . '">';
            $html .= '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            ' . $page->name . '
                        </a>';
            $html .= '<ul class="dropdown-menu ' . $menu02 . '" aria-labelledby="navbarDropdown">';
            $html .= generate_tree($page->children, true);
            $html .= '</ul></li>';
        } else {
            if (!$r) {
                $html .= '<li class="nav-item">';
                $html .= '<a class="nav-link" aria-current="page" href="' . (isset($page->post) ? url('pages') . '/' . $page->post->slug : "#") . '">' . $page->name . '</a>';
                $html .= '</li>';
            } else {
                $html .= '<li><a class="dropdown-item" href="' . (isset($page->post) ? url('pages') . '/' . $page->post->slug : "#") . '">' . $page->name . '</a></li>';
            }
        }
    }

    return $html;
}

function nested_page($pages, $page_id = null, $delimiter = "")
{
    $html = "";
    foreach ($pages as $page) {
        if ($page->children->count() > 0) {
            $html .= '<option value="' . $page->id . '" ' . ($page->id == $page_id ? 'selected' : '') . '>' . $delimiter . $page->name . '</option>';
            $html .= nested_page($page->children, $page_id, $delimiter . '-');
        } else {
            $html .= '<option value="' . $page->id . '" ' . ($page->id == $page_id ? 'selected' : '') . '>' . $delimiter . $page->name . '</option>';
        }
    }
    return $html;
}

function select_parents($page = null)
{
    $html = '<select class="form-control selectpicker" name="parent_id">';
    $html .= '<option value="">-- Pilih Perent --</option>';
    $html .= nested_page(\Models\Page::whereNull('parent_id')->get(), $page ? $page->parent_id : null);
    $html .= '</select>';
    return $html;
}

function dropdown()
{
    $html = '<div class="collapse navbar-collapse" id="navbarSupportedContent"><ul class="navbar-nav me-auto mb-2 mb-lg-0">';
    $html .= generate_tree(\Models\Page::whereNull('parent_id')->orderBy('sequence', 'asc')->get());
    $html .= '</ul></div>';
    return $html;
}

function assets($path, $secure = null)
{
    return str_replace('/dev.php', '', asset($path, $secure));
}

function months()
{
    return array(
        1 => say("Januari"),
        2 => say("Februari"), 3 => say("Maret"),
        4 => say("April"),
        5 => say("Mei"),
        6 => say("Juni"),
        7 => say("Juli"),
        8 => say("Agustus"),
        9 => say("September"),
        10 => say("Oktober"),
        11 => say("November"),
        12 => say("Desember"),
    );
}

function DateToTimeIndo($date)
{
    $BulanIndo = months();
    if ($date && date('Y', strtotime($date)) > 1) {

        $tahun = date('Y', strtotime($date));
        $bulan = date('m', strtotime($date));
        $tgl = date('d', strtotime($date));
        $time = date('H:i', strtotime($date));

        $result = $tgl . " " . $BulanIndo[(int) $bulan] . " " . $tahun . " " . $time;
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

function dateToIndWithoutYear($date)
{
    if ($date && date('Y', strtotime($date)) > 1) {
        $BulanIndo = array(
            "", say("Januari"), say("Februari"), say("Maret"), say("April"), say("Mei"), say("Juni"), say("Juli"), say("Agustus"), say("September"), say("Oktober"), say("November"), say("Desember"),
        );
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
        $BulanIndo = array(
            "", say("Januari"), say("Februari"), say("Maret"), say("April"), say("Mei"), say("Juni"), say("Juli"), say("Agustus"), say("September"), say("Oktober"), say("November"), say("Desember"),
        );

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
        $BulanIndo = akronim_months();

        $bulan = date('n', strtotime($date));
        $tgl = date('d', strtotime($date));

        $result = $tgl . " " . $BulanIndo[(int) $bulan];
    } else {
        $result = null;
    }

    return ($result);
}

function DateToDay($date)
{
    $HariIndo = hari();
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
    $HariIndo = hari();
    $result = array_key_exists($day, $HariIndo) ? $HariIndo[$day] : '';
    return $result;
}

function days()
{
    return array(1 => say('Senin'), 2 => say('Selasa'), 3 => say('Rabu'), 4 => say('Kamis'), 5 => say('Jumat'), 6 => say('Sabtu'), 7 => say('Minggu'));
}

function hari()
{
    return array(1 => say('Senin'), 2 => say('Selasa'), 3 => say('Rabu'), 4 => say('Kamis'), 5 => say('Jumat'), 6 => say('Sabtu'), 7 => say('Minggu'));
}

function NumToDay($num)
{
    if ($num < 8) {
        $day = hari();
        $result = $day[$num];
    } else {
        $result = null;
    }

    return ($result);
}

function akronim_months()
{
    return array(
        say("Jan"), say("Feb"), say("Mar"),
        say("Apr"), say("Mei"), say("Jun"),
        say("Jul"), say("Agu"), say("Sep"),
        say("Okt"), say("Nov"), say("Des"),
    );
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
        1000000000000000000 => 'quintillion',
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

function numberToMonth($no)
{
    $no = intval($no);
    $bulan = months();
    return (array_key_exists($no, $bulan)) ? $bulan[$no] : "";
}

function numberToMonthC($no)
{
    $bulan = akronim_months();
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
        if (!in_array($period->format('N'), $workingDays)) {
            continue;
        }

        if (in_array($period->format('Y-m-d'), $holidayDays)) {
            continue;
        }

        if (in_array($period->format('*-m-d'), $holidayDays)) {
            continue;
        }

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

function countIntervalBetweenTimeIndo($from, $to)
{
    if (!$to) {
        $to = now();
    }
    $time = \Carbon\Carbon::make($from)->diff($to);
    if ($time->y > 0) {
        return $time->y . ' tahun yang lalu';
    } else if ($time->y == 0 && $time->d > 0) {
        return $time->d . ' hari yang lalu';
    } else if ($time->y == 0 && $time->d == 0 && $time->i > 0) {
        return $time->i . ' menit yang lalu';
    }
}

function countIntervalBetweenTimeIndo2($from, $to)
{
    if (!$to) {
        $to = now();
    }
    $time = \Carbon\Carbon::make($from)->diff($to);

    return $time->h . ' jam ' . $time->i . ' menit';
}

function getMonthIndo()
{
    $bulan = months();

    return $bulan;
}

function numberToMonthYear($date)
{
    $month = ucwords(strtolower(numberToMonthC(date('n', strtotime($date)))));
    $year = date('Y', strtotime($date));
    $result = $month . " " . $year;
    return $result;
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
        2 => say('Perempuan'),
    ];
    return $jk[$j];
}
    
function religion($j)
{
    $religi = [
        '' => '',
        0 => '',
        1 => say('Islam'),
        6 => say('Katolik'),
        4 => say('Hindu'),
        5 => say('Buddha'),
        3 => say('Protestan'),
    ];
    return $religi[$j];
}

function marital($j)
{
    $marital = [
        '' => '',
        0 => '',
        1 => say('Menikah'),
        2 => say('Belum Menikah'),
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
        4 => 'O',
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
        20 => '(Dua puluh)',
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
            if (array_key_exists(0, $headers)) {
                return stripos($headers[0], "200 OK") ? true : false;
            }

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
    if ($a1 > $b1) {
        return 1;
    } else if ($a1 < $b1) {
        return -1;
    } else {
        return 0;
    }

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
    $result = $HariIndo[(int) $hari - 1];
    return ($result);
}

function DateToEn($date)
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

function fix_keys($array)
{
    foreach ($array as $k => $val) {
        if (is_array($val)) {
            $array[$k] = fix_keys($val);
        }
        //recurse
    }
    return array_values($array);
}

function month_range($date_start, $date_end)
{
    $start = (new DateTime($date_start))->modify('first day of this month');
    $end = (new DateTime($date_end))->modify('first day of next month');
    $interval = DateInterval::createFromDateString('1 month');
    $period = new DatePeriod($start, $interval, $end);
    $data = array();

    foreach ($period as $dt) {
        $data_month = array(
            'month' => $dt->format("m"),
            'year' => $dt->format("Y"),
        );
        array_push($data, $data_month);
    }
    return $data;
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
 
function weeks()
{
    $weeks = [
        1 => say('Minggu ke - 1'),
        2 => say('Minggu ke - 2'),
        3 => say('Minggu ke - 3'),
        4 => say('Minggu ke - 4'),
    ];

    return $weeks;
}

function cashes($key = null)
{
    $data = [
        1 => say('Debet'),
        2 => say('Kredit'),
    ];

    return ($key) ? $data[$key] : $data;
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
    $end = strtotime($endDate);
    if ($begin > $end) {
        return 0;
    } else {
        $no_days = 0;
        $weekends = 0;
        while ($begin <= $end) {
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);
            if ($what_day > 5) { // 6 and 7 are weekend days
                $weekends++;
            }
            ;
            $begin += 86400; // +1 day
        }
        ;
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

function diff_minutes($date1, $date2)
{
    $datetime1 = strtotime($date1);
    $datetime2 = strtotime($date2);
    $interval = abs($datetime2 - $datetime1);
    $minutes = round($interval / 60);

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

function randomString($length = 6)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';
    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }
    return $string;
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

function is_exists($i, $object, $default = null, $set_values = [], $format = null, $color_function = null)
{
    $result = null;
    $index = null;
    try {
        if(is_null($object)){
            return $default;
        }

        if( $object instanceof Collection){
            return join(",", $object->pluck($i,'id')->all());
        }

        if (isset($object)) {
            if (is_array($object)) {
                $result = (array_key_exists($i, $object)) ? $object[$i] : $default;
            } else if (is_object($object)) {
                $result = (isset($object) && $object) ? $object->{$i} : $default;
            } else {

            }
        }
    } catch (\Throwable $th) {
        dump($th->getMessage());
    }

    if ($color_function) {
        $index = $result;
    }

    if($set_values){
        if(is_callable($set_values)){
            $result = $set_values($result );
        }else {
            if(is_array($set_values)){
                $result = (array_key_exists($result, $set_values)) ? $set_values[$result] : $default;
            }
        }
    }

    /** this will formatted value using helper function e.g: DateToIndo,etc */
    if ($format) { 
        if(is_callable($format)){
            if($result){
                $result = $format($result);
            }
        }else{

            if(function_exists($format)){
                if($result){
                    $result = $format($result);
                }
            }
        }
    }

    if ($color_function) {
        /** this will take bg label from database */
        if ($color_function === true) { 
            if (is_object($object)) {
                $result = bg_color($object, $result);
            }

        } else {

            if (is_array($color_function)) {
                /** this will take bg label from assigned array */
                $bg = array_key_exists($index, $color_function) ? $color_function[$index] : "bg-green";
                $result = '<span class="badge"  style="background-color:' . $bg . ';color:white;font-weight:bold;">' . $result . '</span>';
            } else {
                /** this will take bg label from helper function by key */
                if (function_exists($color_function)) {
                    $bg = $color_function($index);
                    $result = '<span class="badge" style="background-color:' . $bg . ';color:white;font-weight:bold;">' . $result . '</span>';
                }
            }
        }
    }
    return $result;
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
    $HariIndo = hari();
    $hari = date('N', strtotime($date));
    $result = $HariIndo[(int) $hari - 1];
    return ($result);
}
 
function dateFormat($date, $client_id = null)
{
    if ($client_id && $client_id == 43) {
        return date('d/m/y', strtotime($date)) . " - " . date('H:i', strtotime($date));
    }
    $month = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'sept', 'oct', 'nov', 'dec'];
    return date('d-M-Y H:i', strtotime($date));
}

function next_month($format = "M")
{
    return date($format, strtotime(date("Y-" . (date(date('n') + 1) . "-d")))) . "’" . date('y');
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
 
function get_property($object, $property, $default = '')
{
    if (isset($object)) {
        return $object->{$property};
    }
    return $default;
}

function getRangeFormat($params)
{
    // 06/14/2022 - 06/14/2022

    $explode = explode("-", $params);
    $first_date = $explode[0];
    $end_date = $explode[1];
    return [date('Y-m-d', strtotime($first_date)), date('Y-m-d', strtotime($end_date))];
} 

function text(...$params)
{  
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, null)))->text();
}

function number(...$params)
{
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, null)))->number();
}

function tanggal(...$params)
{
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, [])))->tanggal();
}

function select(...$params)
{
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, [])))->setData(data_get($params,3, []))->select();
}

function color(...$params)
{
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, null)))->colour();
}

function textarea(...$params)
{
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, null)))->textarea();
}

function checkbox(...$params)
{
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, null)))->checkbox();
}

function text_div(...$params)
{
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, null)))->formGroup();
}

function email_div(...$params)
{
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, null)))->formGroup('email');
}

function password_div(...$params)
{
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, null)))->formGroup('password');
}

function number_div(...$params)
{
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, null), data_get($params,2, null)))->formGroup("number");
}

function date_div(...$params)
{   
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, null)))->formGroup("date");
}

function select_div(...$params)
{    
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, [])))->setData(data_get($params,3, []))->formGroup("select");
}

function color_div(...$params)
{
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, null)))->formGroup("colour");
}

function textarea_div(...$params)
{
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, null)))->formGroup("textarea");
}

function radio_div(...$params)
{   
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, null)))->formGroup("radio",data_get($params,3, []), true);    
}

function checkbox_div(...$params)
{   
    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, null)))->formGroup("checkbox", data_get($params,3, []), true);    
}

function form($type, ...$params)
{   
    if($type == "select"){
        return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, [])))->setData(data_get($params,2, []))->formGroup($type);
    }

    return (new \Lib\Template(data_get($params,0, null), data_get($params,1, []), data_get($params,2, null)))->formGroup($type, data_get($params,3, []), true);    
}

function bg_color($object, $text)
{    
    return '<span class="badge" style="background-color:' . ($object->bg_color ? $object->bg_color:"green").';color:white;font-weight:bold;">' . ($text ? $text : $object->name) . '</span>';
}

function is_true($bool, $true, $false, $bg_color = null)
{
    $bool = $bool > 0 ? 1 : 0;
    $result = ($bool) ? $true : $false;

    if ($bg_color) {
        if (is_array($bg_color)) {
            $result = '<span class="badge" style="background-color:' . $bg_color[$bool] . ';color:white;font-weight:bold;">' . $result . '</span>';
        } else {
            if(is_callable($bg_color)){
                $result = $bg_color($bool);
            }else{

                if (function_exists($bg_color)) {
                    $result = $bg_color($bool);
                } else {
                    $result = $bool ? '<span class="badge" style="background-color:green;color:white;font-weight:bold;">' . $result . '</span>' : '<span class="badge"  style="background-color:red;color:white;font-weight:bold;">' . $result . '</span>';
                }
            }
        }
    }
    return $result;
}

function select_data($relations, $object, $excepts = [], $options = [])
{
    $array = [];
    foreach ($relations as $i => $val) {
        if (array_key_exists($val, $excepts)) {
            if (in_array($val, $options)) {
                $temp = [];

                foreach ($excepts[$val] as $key => $except) {
                    if (strpos($except, "_id")) {
                        $except = str_replace("_id", "", $except);
                        if (is_exists('name', $object->{$except})) {
                            $temp[] = is_exists('name', $object->{$except}, "NA");
                        }
                    } else {
                        $temp[] = (string) is_exists($val, $object, "NA");
                    }
                }
                $array[$val] = $temp;
            } else {
                $array[$val] = (string) is_exists($object->{$val}, $excepts[$val], 'NA');
            }
        } else {
            if (strpos($val, "_id")) {
                $val = str_replace("_id", "", $val);
                $array[$val] = (string) is_exists('name', $object->{$val}, "NA");
            } else {
                $array[$val] = ($object->{$val} == null) ? "NA" : is_exists($val, $object, "NA");
            }

        }

    }
    return $array;
}