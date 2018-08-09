<?php

    function showCategoryName_stat(&$id){
        $id			= explode("-", $id);
        $tableName		= $id[1];
        $id                     = $id[0];
        $db                     = getDBO();
        $db->setQuery(" SELECT statscate_name FROM {$tableName} WHERE statscate_id='{$id}' ");
        $rs                     = $db->loadAssocList();
        $id			= $rs[0]['statscate_name']?$rs[0]['statscate_name']:'-';
    }
    
    
    function getAllCategory_stat( $currentId, $tableName, $currentParentId=-1, $cateId=-1){        
        $db					= getDBO();
        $db->setQuery("SELECT statscate_id FROM  {$tableName} WHERE parent_id='{$currentId}' ORDER BY statscate_id DESC ");
        $rs					= $db->loadAssocList();
        $len					= count($rs);
        if(count($len)){
            $output				= Array();
            $store				= Array();
            for( $i=0;  $i<$len;  $i++ ){
                    $store[]			= Array(
                            'statscate_id'  => $rs[$i]['statscate_id'],
                            'level'         => 1
                    );
            }
            while( count($store)>0 ){
                    $buf				= array_pop($store);
                    $output[]		= $buf;
                    $db->setQuery("SELECT statscate_id FROM  {$tableName} WHERE parent_id='{$buf['statscate_id']}'   ORDER BY statscate_id DESC ");
                    $rs					= $db->loadAssocList();
                    $len					= count($rs);
                    for( $i=0;   $i<$len;  $i++ ){
                            $row			= Array(
                                    'statscate_id'  => $rs[$i]['statscate_id'],
                                    'level'         => ($buf['level']+1)
                            );
                            array_push($store, $row );
                    }
            }
            $html				= "";
            $len				= count($output);
            $html				.='
                    <select name="parent_id" id="parent_id" style="min-width:300px;" class="required">
                            <option  value="">'.lang('select category', 'select category').'</option>
            ';
            for(  $i=0;   $i<$len;   $i++  ){
                $db->setQuery("SELECT statscate_id, statscate_name FROM {$tableName}  WHERE statscate_id='{$output[$i]['statscate_id']}' ");
                $rs				= $db->loadAssocList();
                $rs				= $rs[0];
                $tab				= '';
                for($loop=0;$loop<($output[$i]['level']-1);$loop++){$tab.='&mdash;';}
                $selected			= $rs['statscate_id']==$currentParentId ? ' selected="selected" ' : '' ;
                $disabled			= $rs['statscate_id']==$cateId ? ' disabled="disabled" ' : '' ;
                $html					.='
                        <option value="'.$rs['statscate_id'].'" '.$selected.' '.$disabled.'  >&nbsp;'.$tab.' '.$rs['statscate_name'].'</option>
                ';		
            }
            return $html;
        }else{
            return "";
        }
    }
    
    
    
    function getAllCID_stat( $currentId, $tableName, $cateId=-1){        
        return str_replace('parent_id', 'statscate_id', getAllCategory_stat($currentId, $tableName, $cateId));
    }
?>
