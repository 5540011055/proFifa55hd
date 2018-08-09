<?
	class Filter{
		public static function getStatusName($status, $lang){
			$data		= array(	0		=>	array(	"th"		=> "แบบร่าง",
																		"us"	=> "draft"),
											1		=>	array(	"th"		=> "แสดงผล",
																		"us"	=> "show"),
											2		=>	array(	"th"		=> "ลบ",
																		"us"	=> "deleted"));
			IF($status<0 || $status>2):
				return null;
			ENDIF;
			return $data[$status][strtolower($lang)];
		}	// End function getStatusName
		
		
		/*
		 *		@PARAM		Mixed, Array[]
		 */
		public static function valueFilter(&$target, $arr=array()){
			foreach($arr				as		$k=>$v){
					IF ($target==$k): 
						$target		= $v;
						break;
					ENDIF;
			}
		}// End Function valueFilter
		
	}
?>