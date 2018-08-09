<form action="<?=base_url().$_CMD.'/'.$task?>" method="post" name="adminTable" id="adminTable">
    <input type="hidden" name="local_id" value="<?=Site::$local_id?>" />
    <table width="850" border="0" align="center" cellpadding="0" cellspacing="2" class="admintable">
        <tbody>
            
            <tr>
                <td width="210" align="right" class="sub_key" >
                    เมนู
                </td>
                <td class="sub_key">
                    <?PHP
                        $menuPath               = 'images/template/menu/';
                    ?>
                    <select name="menu" onchange="$('#menu-img').attr('src',this.value);">
                        <?PHP
                            $db                 = getDBO();
                            $db->setQuery(" SELECT * FROM cpanel_template WHERE local_id='". Site::$local_id."' ");
                            $rs                 = $db->loadAssocList();
                            $defaultPath        = $rs ? $rs[0]['menu_path'] : '';
                            $files              = scandir($menuPath);
                            if( $files ){
                                foreach( $files     AS $f ){
                                    if( $f!='.'     &&  $f!='..'    && @is_file($menuPath.$f) ){
                                        if($defaultPath==''){
                                            $defaultPath        = $menuPath.$f;
                                        }
                                        $selected           = $defaultPath==$menuPath.$f ? 'selected="selected"':'';
                                    ?>
                                        <option value="<?=$menuPath.$f?>" <?=$selected?>><?=$f?></option>
                                    <?
                                    }
                                }
                            }
                        ?>
                    </select>
                </td>
            </tr>
            
            
            <tr>
                <td width="210" align="right" class="sub_key" ></td>
                <td class="sub_key">
                    <img id="menu-img" src="<?=$defaultPath?>" />
                </td>
            </tr>
            
            
            
            <tr>
                <td width="210" align="right" class="sub_key" >
                    jQuery template
                </td>
                <td class="sub_key">
                    <?PHP
                        $cssPath                    = 'js/jquery/css/';
                        $cssPath_ls                 = scandir($cssPath);
                        if( $cssPath_ls ){
                            $query_selected         = $rs[0]['jquery'];
                            foreach( $cssPath_ls    AS $ls ){
                                if($ls!='.' && $ls!='..' && is_dir($cssPath.$ls)){
                                    $selected       = $query_selected==$ls ? ' checked="checked" ' : '' ;
                                    echo '  <span style="font-size:14px;line-height:20px;">
                                                <input type="radio" name="jquery" value="'.$ls.'" '.$selected.' > '.$ls.'
                                            </span>';
                                    br();
                                }
                            }
                        }
                    ?>
                </td>
            </tr>
            
            
            
            <tr>
                <td height="25" align="right" valign="top" class="sub_key" colspan="2">            
                    <button class="button button-blue" type="submit" id="Save" name="Save"><?=lang('Save','Save')?></button>                       
                    <button class="button button-red" type="button" id="Back" name="Back" onclick="window.history.back();">
                        <?=lang('cancel', 'cancel')?>
                    </button>
                </td>
            </tr>
            
        </tbody>
    </table>
    
</form>
