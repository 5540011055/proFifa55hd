<?PHP
    function getAllCategory_personal( $currentId, $tableName, $currentParentId=-1, $cateId=-1){        
        $db					= getDBO();
        $db->setQuery(" SELECT           id 
                        FROM            {$tableName} 
                        WHERE           status='1'                  AND 
                                        parent_id='{$currentId}'    AND
                                        local_id='".Site::$local_id."'
                        ORDER BY        id DESC 
                        ");
        $rs					= $db->loadAssocList();
        $len					= count($rs);
        if(count($len)){
            $output				= Array();
            $store				= Array();
            for( $i=0;  $i<$len;  $i++ ){
                    $store[]			= Array(
                            'id'		=> $rs[$i]['id'],
                            'level'		=> 1
                    );
            }
            while( count($store)>0 ){
                    $buf                        = array_pop($store);
                    $output[]		= $buf;
                    $db->setQuery(" SELECT          id 
                                    FROM            {$tableName} 
                                    WHERE           status='1'                  AND 
                                                    parent_id='{$buf['id']}'    AND
                                                    local_id='".Site::$local_id."'        
                                    ORDER BY        id DESC 
                                    ");
                    $rs				= $db->loadAssocList();
                    $len			= count($rs);
                    for( $i=0;   $i<$len;  $i++ ){
                            $row		= Array(
                                    'id'        => $rs[$i]['id'],
                                    'level'	=> ($buf['level']+1)
                            );
                            array_push($store, $row );
                    }
            }
            $html				= "";
            $len				= count($output);
            $html				.='
                    <select name="parent_id" id="parent_id" style="min-width:300px;" >
                            <option  value="0" '.($currentParentId==0?' selected="selected" ':'').'>'.lang('select category', 'select category').'</option>
            ';
            for(  $i=0;   $i<$len;   $i++  ){
                $db->setQuery(" SELECT              id, cate_name 
                                FROM                {$tableName}  
                                WHERE               id='{$output[$i]['id']}'    AND
                                                    local_id='".Site::$local_id."'
                                ");
                $rs				= $db->loadAssocList();
                $rs				= $rs[0];
                $tab				= '';
                for($loop=0;$loop<($output[$i]['level']-1);$loop++){$tab.='&mdash;';}
                $selected			= $rs['id']==$currentParentId ? ' selected="selected" ' : '' ;
                $disabled			= $rs['id']==$cateId ? ' disabled="disabled" ' : '' ;
                $html					.='
                        <option value="'.$rs['id'].'" '.$selected.' '.$disabled.'  >&nbsp;'.$tab.' '.$rs['cate_name'].'</option>
                ';		
            }
            return $html;
        }else{
            return "";
        }
    }
    
    
    
    
    
    
    function getAllCategory_personal_multiRows( $currentId, $tableName, $currentParentId=-1, $cateId=-1){        
        $db					= getDBO();
        $db->setQuery(" SELECT          id, cate_name
                        FROM            {$tableName} 
                        WHERE           status='1'                  AND 
                                        parent_id='{$currentId}'    AND
                                        local_id='".Site::$local_id."'
                        ORDER BY        id DESC 
                        ");
        $rs					= $db->loadAssocList();
        $len					= count($rs);
        if(count($len)){
            $output				= Array();
            $store				= Array();
            for( $i=0;  $i<$len;  $i++ ){
                    $store[]			= Array(
                            'id'		=> $rs[$i]['id'],
                            'cate_name'         => $rs[$i]['cate_name'],
                            'level'		=> 1
                    );
            }
            while( count($store)>0 ){
                    $buf                        = array_pop($store);
                    $output[]		= $buf;
                    $db->setQuery(" SELECT          id, cate_name
                                    FROM            {$tableName} 
                                    WHERE           status='1'                  AND 
                                                    parent_id='{$buf['id']}'    AND
                                                    local_id='".Site::$local_id."'        
                                    ORDER BY        id DESC 
                                    ");
                    $rs				= $db->loadAssocList();
                    $len			= count($rs);
                    for( $i=0;   $i<$len;  $i++ ){
                            $row		= Array(
                                    'id'        => $rs[$i]['id'],
                                    'cate_name' => $rs[$i]['cate_name'],
                                    'level'	=> ($buf['level']+1)
                            );
                            array_push($store, $row );
                    }
            }
            /*
            $html				= "";
            $len				= count($output);
            $html				.='
                    <select name="parent_id" id="parent_id" style="min-width:300px;" >
                            <option  value="">'.lang('select category', 'select category').'</option>
            ';
            for(  $i=0;   $i<$len;   $i++  ){
                $db->setQuery(" SELECT              id, cate_name 
                                FROM                {$tableName}  
                                WHERE               id='{$output[$i]['id']}'    AND
                                                    local_id='".Site::$local_id."'
                                ");
                $rs				= $db->loadAssocList();
                $rs				= $rs[0];
                $tab				= '';
                for($loop=0;$loop<($output[$i]['level']-1);$loop++){$tab.='&mdash;';}
                $selected			= $rs['id']==$currentParentId ? ' selected="selected" ' : '' ;
                $disabled			= $rs['id']==$cateId ? ' disabled="disabled" ' : '' ;
                $html					.='
                        <option value="'.$rs['id'].'" '.$selected.' '.$disabled.'  >&nbsp;'.$tab.' '.$rs['cate_name'].'</option>
                ';		
            }
            return $html;
             * 
             */
            return $output;
        }else{
            return "";
        }
    }
?>