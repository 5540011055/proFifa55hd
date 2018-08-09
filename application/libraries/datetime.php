<?php

    class DateTimeUtil{
        
        public function shortMonth($mo){
                $m = array( "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค." );
                return $m[$mo-1];
        }
        
        public function longMonth($mo){
                $m = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                return $m[$mo-1];
        }
        
        public function shortThaiDateTime(&$data){
                if(!$data){
                        $data = "-";
                }
                else if($data == "0000-00-00 00:00:00"){
                        $data = "-";
                }
                else if($data == "0000-00-00"){
                        $data = "-";
                }
                else if($data == "00:00:00"){
                        $data = "-";
                }
                else {
                $m = array( "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค." );
                $day = date("d",strtotime($data));
                $month = date("m",strtotime($data));
                $year = date("Y",strtotime($data));
                $time = date("H:i:s",strtotime($data));
                $year = ceil($year+543);
                $month = $m[ceil($month-1)];
                $data = sprintf("%d %s %s %s",$day,$month,substr($year,2,2),$time);
                }
        }
        
        public function shortThaiDate(&$data){
                if(!$data){
                        $data = "-";
                }
                else if($data == "0000-00-00 00:00:00"){
                        $data = "-";
                }
                else if($data == "0000-00-00"){
                        $data = "-";
                }
                else if($data == "00:00:00"){
                        $data = "-";
                }
                else {
                $m = array( "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค." );
                $day = date("d",strtotime($data));
                $month = date("m",strtotime($data));
                $year = date("Y",strtotime($data));
                $year = ceil($year+543);
                $month = $m[ceil($month-1)];
                $data = sprintf("%d %s %s",$day,$month,substr($year,2,2));
                }
        }

        public function fullThaiDateTime(&$data){
                if(!$data){
                        $data = "-";
                }
                else if($data == "0000-00-00 00:00:00"){
                        $data = "-";
                }
                else if($data == "0000-00-00"){
                        $data = "-";
                }
                else {
                $m = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                $day = date("d",strtotime($data));               
                $month = date("m",strtotime($data));
                $year = date("Y",strtotime($data));
                $time = date("H:i:s",strtotime($data));
                $year = ceil($year+543);
                $month = $m[ceil($month-1)];
                $data = sprintf("%d %s %s %s",$day,$month,$year,$time);
                }
        }
        
        public function fullThaiDate(&$data){
                if(!$data){
                        $data = "-";
                }
                else if($data == "0000-00-00 00:00:00"){
                        $data = "-";
                }
                else if($data == "0000-00-00"){
                        $data = "-";
                }
                else {
                $m = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                $day = date("d",strtotime($data));
                $month = date("m",strtotime($data));
                $year = date("Y",strtotime($data));
                $year = ceil($year+543);
                $month = $m[ceil($month-1)];
                $data = sprintf("%d %s %s",$day,$month,$year);
                }
        }

        
        public function showStatus(&$data){
                        switch($data)
                        {
                                case 0:
                                $data = JaText::_("Save draft");
                                break;
                                case 1:
                                $data = JaText::_("Public");
                                break;
                                case 2:
                                $data = JaText::_("Remove");
                                break;
                        }
        }
        
        public function createShortActivityThaiDate($start,$finish){
                if(!$finish){
                        $finish = "-";
                }
                else if($finish == "0000-00-00 00:00:00"){
                        $finish = "-";
                }
                else if($finish == "0000-00-00"){
                        $finish = "-";
                }
                else if($finish == "00:00:00"){
                        $finish = "-";
                }
                else {
                $m = array( "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค." );
                $day = date("d",strtotime($finish));
                $month = date("m",strtotime($finish));
                $year = date("Y",strtotime($finish));
                $year = ceil($year+543);
                $month = $m[ceil($month-1)];
                }

                if($start <> $finish){

                        $day2 = date("d",strtotime($start));
                        $month2 = date("m",strtotime($start));
                        $year2 = date("Y",strtotime($start));
                        $year2 = ceil($year2+543);
                        $month2 = $m[ceil($month2-1)];

                        if($month2 <> $month or $year2 <> $year){
                                $data = sprintf("%02d %s %s",$day2,$month2,$year2);
                        }else{
                                $data = $day2;
                        }

                        $data .= " ถึง ";
                }else{
                        $data = "";
                }
                $data .= sprintf("%02d %s %s",$day,$month,$year);
                return $data;

        }
        
    }

    
    
    function getDateTimeObject(){
        if(!isset($_ENV['system-DateTimeUtil'])){
            $obj                    = new DateTimeUtil();
            $_ENV['system-DateTimeUtil']    = &$obj;
        }
        return $_ENV['system-DateTimeUtil'];
    }
    
    
    function shortMonth($mo){
        $obj                    = getDateTimeObject();
        return $obj->shortMonth($mo);
    }
    
    
    function longMonth($mo){
        $obj                    = getDateTimeObject();
        return $obj->longMonth($mo);
    }
    
    
    function shortThaiDateTime(&$data){
        $obj                    = getDateTimeObject();
        $obj->shortThaiDateTime($data);
    }
    
    
    function shortThaiDate(&$data){
        $obj                    = getDateTimeObject();
        $obj->shortThaiDate($data);
    }
    
    
    function fullThaiDateTime(&$data){
        $obj                    = getDateTimeObject();
        $obj->fullThaiDateTime($data);
    }
    
    
    function fullThaiDate(&$data){
        $obj                    = getDateTimeObject();
        $obj->fullThaiDate($data);
    }
    
    
    
?>