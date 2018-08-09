<?php
    function getProvince($id=''){
        $condition              = $id!='' ? " where id='{$id}' " : ""; 
        $db					= getDBO();
        $query				= "	select * from cpanel_province {$condition}   ";
        $db->setQuery( $query );
        return $db->loadAssocList();		
    }
?>
