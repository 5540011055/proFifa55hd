<?
	class Calendar{
		
		public static function getMonthName($index, $lang="th"){
			return  Calendar::$month[$index][strtolower($lang)];
		}	// END Function
		
		// Class variables
		private static $month 			= array(	0	=>	array(	"th"	=> 	"มกราคม",
                                                                                                "en"	=> 	"January"),
                                                                        1	=>	array(	"th"    =>	"กุมภาพันธ์"	,
                                                                                                "en"	=>	"February"),
                                                                        2	=>	array(	"th"		=>	"มีนาคม",
                                                                                                "en"	=>	"March"),
                                                                        3	=>	array(	"th"		=>	"เมษายน",
                                                                                                "en"	=>	"April"),
                                                                        4	=>	array(	"th"		=>	"พฤษภาคม",
                                                                                                "en"	=>	"May"),
                                                                        5	=>	array(	"th"		=>	"มิถุนายน",
                                                                                                "en"	=>	"June"),
                                                                        6	=>	array(	"th"		=>	"กรกฎาคม",
                                                                                                "en"	=>	"July"),
                                                                        7	=>	array(	"th"		=>	"สิงหาคม",
                                                                                                "en"	=>	"August"),
                                                                        8	=>	array(	"th"		=>	"กันยายน",
                                                                                                "en"	=>	"September"),
                                                                        9	=>	array(	"th"		=>	"ตุลาคม",
                                                                                                "en"	=>	"October"),
                                                                        10	=>	array(	"th"		=>	"พฤศจิกายน",
                                                                                                "en"	=>	"November"),
                                                                        11	=>	array(	"th"		=>	"ธันวาคม",
                                                                                                "en"	=>	"December")
                                                                        );
	}
        
        
        
        
        
        
        
?>