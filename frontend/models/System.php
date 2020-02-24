<?php
namespace frontend\models;
use Yii;
use yii\base\Model;

class System extends Model{
    const HOST_NAME = 'learningbydesignatcmu.com';	// for email
    const SITE_TITLE = 'Learning by design at CMU';
    const SESSION_CODE = 'DC';

    const reCaptcha = '';

    const DEFAULT_LANGUAGE = 'th';
    const NULL = 'SYSTEM_NULL_VALUE';

    const DEFAULT_FONT = 'CSChatThai';
    const FONTS = array(
        'CSChatThai' => 'assets/fonts/font-chatthai.css',
        'Prompt' => 'assets/fonts/font-prompt.css'
    );

    const USE_COOKIE_LOGIN = true;
    const ENABLE_DEBUG = false;

    private static $lang_dict = array();

    public static function include_file ($file_path, $once = false) {
        $currentPath = dirname(__FILE__);
        if($once) {
            include_once $currentPath.'/../'.$file_path;
        } else {
            include $currentPath.'/../'.$file_path;
        }
    }

    public static function require_file ($file_path, $once = false) {
        $currentPath = dirname(__FILE__);
        if($once) {
            require_once $currentPath.'/../'.$file_path;
        } else {
            require $currentPath.'/../'.$file_path;
        }
    }

    public static function session($name, $data = 'SYSTEM_NULL_VALUE') {
        if($data !== 'SYSTEM_NULL_VALUE') {
            $_SESSION[self::SESSION_CODE.'_'.$name] = $data;
        }
        if(isset($_SESSION[self::SESSION_CODE.'_'.$name])) {
            return $_SESSION[self::SESSION_CODE.'_'.$name];
        } else {
            return null;
        }
    }

    public static function remove_session($name) {
        if(self::session($name)) {
            unset($_SESSION[self::SESSION_CODE.'_'.$name]);
        }
    }

    public static function cookie($name, $data = 'SYSTEM_NULL_VALUE', $minute = 525600) {
        $minute = $minute * 60;
        if($data !== self::NULL) {
            $data = json_encode($data);
            setcookie(self::SESSION_CODE.'_'.$name, $data, time() + $minute, "/");
            // accessing cookie immediately after setcookie
            $_COOKIE[self::SESSION_CODE.'_'.$name] = $data;
        }
        if(isset($_COOKIE[self::SESSION_CODE.'_'.$name])) {
            $data = json_decode($_COOKIE[self::SESSION_CODE.'_'.$name]);
            return $data;
        } else {
            return null;
        }
    }

    public static function remove_cookie($name) {
        if(self::cookie($name)) {
            setcookie(self::SESSION_CODE.'_'.$name, null, time() - 3600, "/");
        }
    }

    public static function asset_path($file_path) {
        if(file_exists($file_path)) {
            $filetime = filemtime($file_path);
            return $file_path.'?t='.$filetime;
        } else {
            return $file_path;
        }
    }

    public static function load_asset($file_path) {
        if(file_exists($file_path)) {
            $type = pathinfo($file_path, PATHINFO_EXTENSION);
        } else {
            $type = '';
        }
        $file_path = self::asset_path($file_path);
        if($type == 'js') {
            echo '<script src="'.$file_path.'"></script>';
        } else if($type == 'css') {
            echo '<link rel="stylesheet" href="'.$file_path.'">';
        } else {
            echo 'Invalid file type. ['.$file_path.']';
        }
    }

    public static function redirect($url = '', $delay = 0) {
        echo '<meta http-equiv="refresh" content="'.$delay.'; url='.$url.'" />';
        exit();
    }

    public static function save_success ($message = 'บันทึกข้อมูลสำเร็จ') {
        self::notification($message, 'success');
    }

    public static function save_error ($message = 'เกิดข้อผิดพลาด ไม่สามารถบันทึกข้อมูลได้') {
        self::notification($message, 'error');
    }

    public static function notification($message = '', $type = 'info') {
        self::session('notification', array(
            'type' => $type,
            'message' => $message
        ));
    }

    public static function handle_notification() {
        if(self::session('notification')) {
            echo '<script>';
            echo '$(document).ready(function () {';
            echo 'System.notification(\''.self::session('notification')['type'].'\', \''.self::session('notification')['message'].'\');';
            echo '});';
            echo '</script>';
            self::remove_session('notification');
        }
    }

    public static function assignURL($url, $params = array()) {
        $parts = parse_url($url);
        if(isset($parts['query'])) {
            parse_str($parts['query'], $query);
        } else {
            $query = array();
        }
        foreach($params as $key => $value) {
            $query[$key] = $value;
        }
        // build query string
        $query_string = '';
        $isFirst = true;
        foreach($query as $key => $value) {
            if($isFirst) {
                $query_string .= '?'.$key.'='.$value;
                $isFirst = false;
            } else {
                $query_string .= '&'.$key.'='.$value;
            }
        }
        $parts['query'] = $query_string;

        $url = $parts['scheme'].'://'.$parts['host'].$parts['path'].$parts['query'];
        return $url;
    }

    public static function queryStringToInput($url, $ignore = array(), $type = 'hidden') {
        $html = '';
        $parts = parse_url($url);
        if(isset($parts['query'])) {
            parse_str($parts['query'], $query);
        } else {
            $query = array();
        }
        // build form input
        foreach($query as $key => $value) {
            if(! in_array($key, $ignore)) {
                $html .= '<input type="'.$type.'" name="'.$key.'" value="'.$value.'">';
            }
        }
        return $html;
    }

    public static function createPagination ($current, $total, $ignore = array(), $param = 'p', $max_button = 3) {
        array_push($ignore, $param);
        $start = 1;
        $end = $total;
        if($total > $max_button + 2) {
            if($current > 3) {
                $start = $current - 1;
                if($current > $total - $max_button) {
                    $start = $total - $max_button;
                }
            } else if($current > 2) {
                $start = $current - 2;
            }

            if($start + $max_button < $total) {
                if($current < $max_button + 1) {
                    $end = $start + $max_button;
                } else {
                    $end = $start + $max_button - 1;
                }
            }
        }
        $html = '';
        echo '<nav><ul class="pagination z-pagination justify-content-end">';
        if($start > 2 && $total > $max_button + 2) {
            echo '<li class="page-item">
				<a class="page-link" href="'.self::assignURL(CURRENT_URL, array($param => 1)).'">
					1
				</a>
			</li>';
            echo '<li class="page-item disabled"><a class="page-link">...</a></li>';
        }

        for($i = $start ; $i <= $end ; $i++) {
            if($current == $i) {
                if($total > $max_button + 2) {
                    echo '<li class="page-item active">
					<span class="dropup">
					<button class="dropdown-toggle" type="button" data-toggle="dropdown">'.$i.'</button>
					<div class="dropdown-menu scrollable-menu dropdown-menu-right">';

                    if($total > 50) {
                        echo '<div class="dropdown-search">
						<form method="GET" action="" name="noconfirm">
							<div class="input-group">
								<input type="number" class="form-control" name="'.$param.'" placeholder="Page Number" value="'.$current.'" min="1" max="'.$total.'" required>
								<div class="input-group-btn">
									<button type="submit" class="btn">
										<i class="fa fa-search"></i>
									</button>
								</div>
							</div>';
                        echo self::queryStringToInput(CURRENT_URL, $ignore);
                        echo '</form>
						</div>';
                    }

                    for($j = 1 ; $j <= $total ; $j++) {
                        echo '<a class="dropdown-item" href="'.self::assignURL(CURRENT_URL, array($param => $j)).'">'.$j.'</a>';
                    }
                    echo '</div></span></li>';
                } else {
                    echo '<li class="page-item active"><a class="page-link" href="'.self::assignURL(CURRENT_URL, array($param => $i)).'">'.$i.'</a></li>';
                }
            } else {
                echo '<li class="page-item"><a class="page-link" href="'.self::assignURL(CURRENT_URL, array($param => $i)).'">'.$i.'</a></li>';
            }
        }

        if($end < $total) {
            echo '<li class="page-item disabled"><a class="page-link">...</a></li>';
            echo '<li class="page-item">
				<a class="page-link" href="'.self::assignURL(CURRENT_URL, array($param => $total)).'">
					'.$total.'
				</a>
			</li>';
        }

        echo '</ul></nav>';
        return $html;
    }

    public static function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'ปี',
            'm' => 'เดือน',
            'w' => 'สัปดาห์',
            'd' => 'วัน',
            'h' => 'ชั่วโมง',
            'i' => 'นาที',
            's' => 'วินาที',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . 'ที่ผ่านมา' : 'ตอนนี้';
    }

    public static function convertDateTH ($date, $time = false) {
        $thaimonth=array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
        if($time === true) {
            $date = date('Y-m-d H:i:s', strtotime($date));
            list($date, $time) = explode(' ', $date);
            $date = explode('-', $date);
            $time = ' '.$time;
        } else if($time !== false) {
            $date = date('Y-m-d '.$time, strtotime($date));
            list($date, $time) = explode(' ', $date);
            $date = explode('-', $date);
            $time = ' '.$time;
        } else {
            $date = date('Y-m-d', strtotime($date));
            $date = explode('-', $date);
        }

        $day = 1 * $date[2];
        $month = $thaimonth[1 * $date[1]];
        $year = (1 * $date[0]) + 543;

        return $day.' '.$month .' '.$year.$time;
    }
    public static function convertDateTHShort ($date, $time = false) {
        $thaimonth=array('','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
        if($time === true) {
            $date = date('Y-m-d H:i:s', strtotime($date));
            list($date, $time) = explode(' ', $date);
            $date = explode('-', $date);
            $time = ' '.$time;
        } else if($time !== false) {
            $date = date('Y-m-d '.$time, strtotime($date));
            list($date, $time) = explode(' ', $date);
            $date = explode('-', $date);
            $time = ' '.$time;
        } else {
            $date = date('Y-m-d', strtotime($date));
            $date = explode('-', $date);
        }

        $day = 1 * $date[2];
        $month = $thaimonth[1 * $date[1]];
        $year = (1 * $date[0]) + 543;

        return $day.' '.$month .' '.$year.$time;
    }

    public static function transformArray($arr, $key = 'id') {
        $ret = array();
        for($i = 0 ; $i < count($arr) ; $i++) {
            $ret[$arr[$i]->$key] = $arr[$i];
        }
        return $ret;
    }

    public static function display($var) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }

    public static function dayofweek_thai ($date) {
        $dayname = array('อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัส', 'ศุกร์', 'เสาร์');
        $n = date('w', strtotime($date));
        return $dayname[$n];
    }

    // language
    public static function set_lang($lang_dict) {
        self::$lang_dict = $lang_dict;
    }

    public static function set_lang_config ($lang) {
        self::session('lang', $lang);
    }

    public static function get_lang_config () {
        $lang = self::session('lang');
        if(is_null($lang)) {
            $lang = self::DEFAULT_LANGUAGE;
        }
        return $lang;
    }

    public static function get_text($key) {
        $lang = self::get_lang_config();
        if(isset(self::$lang_dict[$key][$lang])) {
            return self::$lang_dict[$key][$lang];
        } else {
            return 'Undefined';
        }
    }

    public static function set_font_config ($font) {
        self::cookie('font', $font);
    }

    public static function get_font_config () {
        $font = self::cookie('font');
        if(is_null($font)) {
            $font = self::DEFAULT_FONT;
        } else {
            $font = $font;
        }
        return $font;
    }

    public static function debug_control() {
        if(self::ENABLE_DEBUG) {
            if(isset($_POST['debug_font'])) {
                System::set_font_config($_POST['debug_font']);
                System::redirect();
            }

            $current_font = System::get_font_config();
            echo '<div class="debug-control">';
            echo '<button class="control-btn btn btn-primary">';
            echo '<i class="fa fa-cog"></i>';
            echo '</button>';
            echo '<div class="control-content">';
            echo '<form method="post" action="">';
            echo '<label class="bold">Font</label>';
            echo '<select class="form-control" name="debug_font">';
            foreach (self::FONTS as $font_name => $font_url) {
                if($current_font == $font_name) {
                    echo '<option value="'.$font_name.'" selected>'.$font_name.'</option>';
                } else {
                    echo '<option value="'.$font_name.'">'.$font_name.'</option>';
                }
            }
            echo '</select>';
            echo '<hr class="my-2">';
            echo '<input name="submit_debug" value="1" type="hidden">';
            echo '<button type="submit" class="btn btn-primary btn-block">';
            echo '<i class="fa fa-check-circle-o mr-2"></i> Save';
            echo '</button>';
            echo '</form>';
            echo '</div></div>';
        }
    }

    public static function limit_string($string, $length = 50, $tooltip = false) {
        $original_string = $string;
        if(mb_strlen($string) > $length) {
            $string = mb_substr($string, 0, $length).'...';
            if($tooltip) {
                $string = '<span title="'.$original_string.'" data-toggle="tooltip">'.$string.'</span>';
            } else {
                $string = '<span title="'.$original_string.'">'.$string.'</span>';
            }
        }
        return $string;
    }

    public static function compile_email($path, $data = array()) {
        $message = file_get_contents($path);
        foreach ($data as $key => $value) {
            $message = str_replace('{{'.$key.'}}', $value, $message);
        }
        return $message;
    }

    private static $start_exec_time = null;

    public static function repHeader() {
        header('Content-type: application/json; charset=utf-8');
        self::$start_exec_time = microtime(true);
    }

    public static function repSuccess($data) {
        $exec_time = 'repHeader not set.';
        if(! is_null(self::$start_exec_time)) {
            $stop_exec_time = microtime(true);
            $exec_time = ($stop_exec_time - self::$start_exec_time) . ' ms';
        }
        $repData = array(
            'message' => 'Success',
            'status' => true,
            'data' => $data,
            'type' => 'success',
            'execute_time' => $exec_time
        );
        echo json_encode($repData);
        exit();
    }

    public static function repError($message) {
        $exec_time = 'repHeader not set.';
        if(! is_null(self::$start_exec_time)) {
            $stop_exec_time = microtime(true);
            $exec_time = ($stop_exec_time - self::$start_exec_time) . ' ms';
        }
        $repData = array(
            'message' => $message,
            'status' => false,
            'data' => null,
            'type' => 'error',
            'execute_time' => $exec_time
        );
        echo json_encode($repData);
        exit();
    }

    public static function is_image ($file) {
        $info = getimagesize($file["tmp_name"]);
        if($info !== false) {
            return true;
        } else {
            return false;
        }
    }

    public static function build_curl_file($fileobj) {
        $tmp_name = $fileobj['tmp_name'];
        $type = $fileobj['type'];
        $name = basename($fileobj['name']);

        $curl_file = curl_file_create($tmp_name, $type, $name);
        return $curl_file;
    }

    public static function day_diff($start_date, $end_date) {
        $start_date = date_create($start_date);
        $end_date = date_create($end_date);
        $diff = date_diff($start_date, $end_date, false);
        $nDay = $diff->format('%r%a');
        return $nDay;
    }
}
?>