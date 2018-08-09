<?php
    function getLocalTambon($local_id){
        $db                 = getDBO();
        $db->setQuery(" SELECT * FROM  local_tambon WHERE  tambon_id='{$local_id}' ");
        $rs                 = $db->loadAssocList();
        return @$rs[0];
    }
    
    
    function getLocalTambonName($local_id){
        $rs                 = getLocalTambon($local_id);
        return @$rs['tambon_name'];
    }
    
    
    
    function getLocalTambonURL($local_id){
        $rs                 = getLocalTambon($local_id);
        return @$rs['tambon_address'];
    }
?>
