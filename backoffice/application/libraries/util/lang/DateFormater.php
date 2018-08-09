<?
	class DateFormater{
		public static function format($start, $end=null){
			if($end==null){
				$startTime							= strtotime($start);
				$date									= date("d", $startTime);
				$month								= date("m", $startTime);
				$year									= ''.(intval(date("Y", $startTime)) + 543);
				
				$month								= DateFormater::getFullThaiMonth($month);
				$year									= substr($year, 2);
				return "{$date} {$month} {$year}";
			}
			
			return null;
		}	
		
		// month start 0 to 11
		public static function getFullThaiMonth($m){
			if (!class_exists("Filter"))
				import ("_oat_.util.filter.Filter");
			Filter::valueFilter($m,		array(	0		=> "มกราคม",			6		=> "กรกฎาคม",
																	1		=> "กุมภาพันธ์",		7		=> "สิงหาคม",
																	2		=> "มีนาคม",			8		=> "กันยายน",
																	3		=> "เมษายน",			9		=> "ตุลาคม",
																	4		=> "พฤษภาคม	",		10	=> "พฤศจิกายน",
																	5		=> "มิถุนายน",			11	=> "ธันวาคม"));
			return $m;
		}
		
		
		public static function getShortThaiMonth($m){
			if (!class_exists("Filter"))
				import ("_oat_.util.filter.Filter");
			Filer::valueFilter($m,		array(	0		=> "ม.ค.",			6		=> "ก.ค.",
																	1		=> "ก.พ.",			7		=> "ส.ค.",
																	2		=> "มี.ค.",			8		=> "ก.ย.",
																	3		=> "เม.ย.",			9		=> "ต.ค.",
																	4		=> "พ.ค.	",		10	=> "พ.ย.",
																	5		=> "มิ.ย.",			11	=> "ธ.ค."));
			return $m;
		}
		
		
		
		
		
		
		
	}
?>