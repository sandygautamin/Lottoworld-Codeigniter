<?php
function slugify($text) {
			// replace non letter or digits by -
	$text = preg_replace('~[^\pL\d]+~u', '-', $text);

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);
	// trim
	$text = trim($text, '-');
	// remove duplicate -
	$text = preg_replace('~-+~', '-', $text);
	// lowercase
	$text = strtolower($text);
	if (empty($text)) {
		return 'n-a';
	}
	return $text;
}
function notifity_message() { 
	$CI = & get_instance();
	$message = "";
	$notify_msg = $CI->session->flashdata('notify_msg');		
	if ($notify_msg) {
		if ($notify_msg['error'] == 0) {
			$message = "success";
			} else {
			$message = "error";
		}
	}
	return $message;
	
}

function lan($label,$domain=false){
	echo  $label;
}
	

function _e($label,$domain=false){
	echo  $label;
}

function __($label,$domain=false){
	echo  $label;
}
function convert_number($n){
        // first strip any formatting;
	$n = (0+str_replace(",", "", $n));

	// is this a number?
	if (!is_numeric($n)) return false;

	// now filter it;
	
	if ($n > 1000000000000) return round(($n/1000000000000), 2).' trillion';
	elseif ($n > 1000000000) return round(($n/1000000000), 2).' billion';
	elseif ($n > 1000000) return round(($n/1000000), 2).'M';
	elseif ($n > 1000) return round(($n/1000), 2).'K';

	return number_format($n);
   
}
function all_lottaryies($draws){
	$currDate=new DateTime();
	$upcomingLottaries=[];
	$results=[];
	$previous_lottry=[];
	$prevLotto=[];
	if($draws){
		foreach($draws as $draw):
			if($draw['date']>=$currDate->format("Y-m-d")){
				$upcomingLottaries[$draw['type']]=$draw;
			}
			else {
				if(!in_array($draw['type'],$prevLotto)){
				$previous_lottry[$draw['type']]=$draw;
				$prevLotto[]=$draw['type'];
				}
			}
		endforeach;
		$result=['upcoming_lottary'=>$upcomingLottaries,'previous_lottery'=>$previous_lottry];
	}
	return $result;
}

function getSymbolByCode($code){
	switch($code){
		case 'EUR':
			$code="$";
		break;
		case 'NOK':
			$code="$";
		break;
		
		case 'CAD':
			$code="$";
		break;
		
		case 'USD':
			$code="$";
		break;
		
		case 'PLN':
			$code="$";
		break;
		
		case 'GBP':
			$code="$";
		break;
		
		case 'BRL':
			$code="$";
		break;
		default: 
		$code='';
		break;
	}
	return $code;

}
function getDefaultLottary($where=''){
    $CI = & get_instance();
    if($where!=''){
        $CI->db->where("LotteryName",$where) ;
        $query=$CI->db->get('lotteries');
        $row = ($query->num_rows()>0)?$query->row():FALSE;
        return  $row;
    }
    $query=$CI->db->get('lotteries');
    $result=$query->result();
    $default=[];
    
    if($result){
        foreach($result as $row){
            if(strtolower($row->LotteryName)=='lotto649'){
                $default[]='lotto-649-ca';
            }
            else {
                $default[]=strtolower($row->LotteryName);
            }
           
        } 
    }
    
	return $default;

}

function secondsToWordsNew($seconds)
    {
        $ret = "";

        /*** get the days ***/
        $days = intval(intval($seconds) / (3600*24));
        if($days> 0)
        {
            $ret .= "$days days ";
        }

        /*** get the hours ***/
        $hours = (intval($seconds) / 3600) % 24;
        if($hours > 0)
        {
            $ret .= "$hours hours ";
        }

        /*** get the minutes ***/
        $minutes = (intval($seconds) / 60) % 60;
        if($minutes > 0)
        {
            if($days <= 0){

                $ret .= "$minutes minutes ";

            }
        }

        /*** get the seconds ***/
        $seconds = intval($seconds) % 60;
        if ($seconds > 0) {
            //$ret .= "$seconds seconds";
        }

        return $ret;
    }

	function getDrawTypeTwo($type){
		$key='';
		switch($type){
			case 'powerball':
				$key='powerball';
			break;
			
			case 'superenalotto':
				$key='jolly';
			break;
			
			case 'megamillions':
				$key='megaball';
			break;
			
			case 'euromillions':
				$key='stars';
			break;
			
			case 'eurojackpot':
				$key='euro';
			break;
			case 'la-primitiva':
				$key='complementary';
			break;
			
			case 'bonoloto':
				$key='complementary';
			break;
			default:
			
			break;
		}
		return $key;
	}

	function numberformat($n){
		return number_format($n,2);
	}
	function pr($res=[]){
		echo "<pre>";
		print_r($res);
		echo "</pre>";
		
	}
	
	function getXmlTag($xmlStr, $tagName)
    {
        if (preg_match('/(<' . $tagName . '>)(.*)(<\/' . $tagName . '>)/', $xmlStr, $regexMatch)) {
            return $regexMatch[2];
        } else {
            return null;
        }
    }
	

	function GetLotteryNameFromUrl($url)
{
    $url_parsed   = parse_url($url);
    $path         = $url_parsed["path"];
    $lottery_seo  = strtolower(trim(strstr($path, "-lottery", true), "/"));

    // remove lang
    if (strpos($lottery_seo, '/') !== false) {
        $lottery_seo = trim(strstr($lottery_seo, '/'), '/');
    }

    // TODO get all lottaries name from API
    $lotteryNames = array(
        'newyorklotto' => 'NewYorkLotto',
        'laprimitiva'   => 'LaPrimitiva',
        'uklotto'    => 'UkLotto',
        'elgordo'       => 'ElGordo',
        'bonoloto'       => 'BonoLoto',
        'lotto649'       => 'Lotto649',
        'powerball'      => 'PowerBall',
        'superenalotto'  => 'SuperEnalotto',
        'megamillions'   => 'MegaMillions',
        'euromillions'   => 'EuroMillions',
        'eurojackpot'    => 'EuroJackpot',
        'ozlotto'        => 'OzLotto'
    );

    return $lotteryNames[$lottery_seo];
}

function sortByOrder($a, $b)
{
    return $b->Jackpot - $a->Jackpot;
}

function wp_is_mobile() {
    if ( empty( $_SERVER['HTTP_USER_AGENT'] ) ) {
        $is_mobile = false;
    } elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Mobile' ) !== false // Many mobile devices (all iPhone, iPad, etc.)
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Android' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Silk/' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Kindle' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'BlackBerry' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mobi' ) !== false ) {
            $is_mobile = true;
    } else {
        $is_mobile = false;
    }
 
    /**
     * Filters whether the request should be treated as coming from a mobile device or not.
     *
     * @since 4.9.0
     *
     * @param bool $is_mobile Whether the request is from a mobile device or not.
     */
    return $is_mobile;
}

function ChangeLotteryNameForUrl($Lottery)
{
    $Lottery = strtolower($Lottery);
    if ($Lottery == "laprimitiva") {
        $lotteryname = "laprimitiva";
    } else {
        if ($Lottery == "elgordo") {
            $lotteryname = "elgordo";
        } else {
            if ($Lottery == "uklotto") {
                $lotteryname = "uklotto";
            } else {
                if ($Lottery == "newyorklotto") {
                    $lotteryname = "newyorklotto";
                } else {
                    $lotteryname = $Lottery;
                }
            }
        }
    }

    return $lotteryname;
}


function getDiscount($type,$period,$lotteryName){
	$CI = & get_instance();
	$discounts = array(
        'BonoLoto' => array(
            'single' => array(
                1 => 2,
                2 => 7,
                4 => 10,
            ),
            'group' => array(
                1 => 2,
                2 => 7,
                4 => 10,
            ),
        ),
        'SuperEnalotto' => array(
            'single' => array(
                1 => 0,
                2 => 2,
                4 => 7,
            ),
            'group' => array(
                1 => 0,
                2 => 2,
                4 => 7,
            ),
        ),
        'ElGordo' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'EuroJackpot' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'PowerBall' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'LaPrimitiva' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'MegaMillions' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'Lotto649' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'UkLotto' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'NewYorkLotto' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'OzLotto' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'EuroMillions' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
    );
	$discount = $discounts[$lotteryName][$type][$period];
	return ($discount > 0) ? $period . ' week ' . $discount . '% discount' : $period . ' week';
}

function convert_country_name($country_name)
{
    $lang_code = (defined('ICL_LANGUAGE_CODE')) ? ICL_LANGUAGE_CODE : 'en';
    $countries = array(
        'en' => array('USA' => 'USA', 'Spain' => 'Spain', 'Europe' => 'Europe', 'Italy' => 'Italy', 'Canada' => 'Canada', 'UK' => 'UK', 'Australia' => 'Australia'),
        'ru' => array('USA' => 'США', 'Spain' => 'Испания', 'Europe' => 'Европа', 'Italy' => 'Италия', 'Canada' => 'Канада', 'UK' => 'Великобритания','Australia' => 'Австралия'),
        'fr' => array('USA' => 'USA', 'Spain' => 'Espagne', 'Europe' => 'Europe', 'Italy' => 'Italie', 'Canada' => 'Canada', 'UK' => 'Royaume-Uni'),
        'de' => array('USA' => 'USA', 'Spain' => 'Spanien', 'Europe' => 'Europa', 'Italy' => 'Italien', 'Canada' => 'Kanada', 'UK' => 'Vereinigtes Königreich'),
        'es' => array('USA' => 'EE.UU.', 'Spain' => 'España', 'Europe' => 'Europa', 'Italy' => 'Italia', 'Canada' => 'Canadá', 'UK' => 'UK'),
        'pl' => array('USA' => 'USA', 'Spain' => 'Hiszpania', 'Europe' => 'Europa', 'Italy' => 'Włochy', 'Canada' => 'Kanada', 'UK' => 'UK'),
    );
    return $countries[$lang_code][$country_name];
}

function changeDate($lotteryName, $date)
{
    $lotteries = array('MegaMillions', 'NewYorkLotto', 'PowerBall', 'Lotto649');
    $time      = strtotime($date);

    if (in_array($lotteryName, $lotteries)) {
        return $time - 24*60*60;
    }

    return $time;
}

function getNumbersKey($lotteryType){
    $numbers=[];
    switch($lotteryType){
        
        case 'powerball':
        $numbers=['main','powerball'];
        break;
        
        case 'megamillions':
            $numbers=['main','megaball'];
        break;
        
        case 'euromillions':
            $numbers=['main','stars'];
        break;
        case 'eurojackpot':
            $numbers=['main','euro'];
        break;
        
        case 'superenalotto':
            $numbers=['main','superstar'];
        break;
        
        case 'lotto649':
            $numbers=['main'];
        case 'lotto-649-ca':
            $numbers=['main'];
        break;

        default :
        break;
    }
    return $numbers;
}

function lottery_name_mapping($type,$reverse=false){
    $CI = & get_instance();
    
    if($reverse){
        $lottery_name_mapping=array_flip($CI->config->item('lottery_name_mapping'));
        return isset($lottery_name_mapping[$type])?$lottery_name_mapping[$type]:$type;
    }
    else {
        $lottery_name_mapping=$CI->config->item('lottery_name_mapping');
    return isset($lottery_name_mapping[$type])?$lottery_name_mapping[$type]:$type;
    }
}