<?PHP
    $tableName          = "cpanel_configuration_general";
    $db                 = getDBO();
    $db->setQuery("SELECT * FROM {$tableName} WHERE local_id='".Site::$local_id."' ");
    $rs                 = $db->loadAssocList();
    $rs                 = $rs[0];
    $field              = $db->getTableFields(Array($tableName));
    $field              = $field[$tableName];                
    $key                = array_keys($field);
    $key_type           = array_values($field);
    $len                = count($key);
?>
<form action="<?=base_url().$_CMD.'/'.$task?>" method="post" name="adminTable" id="adminTable">
    <input type="hidden" name="local_id" value="<?=Site::$local_id?>" />
    <table width="850" border="0" align="center" cellpadding="0" cellspacing="2" class="admintable">
        <tbody>
            <?PHP
                for( $i=0;  $i<$len;  $i++ ){
                    if( $key[$i]=='id' || $key[$i]=='local_id' ){
                        continue;
                    }
                    if(strstr($key_type[$i], 'enum')){
                        $key_type[$i]   = str_replace('enum', '', $key_type[$i]);
                        $key_type[$i]   = str_replace('\'', '', $key_type[$i]);
                        $enum           = explode(',', $key_type[$i]);
                        echo '
                            <tr>
                                <td width="210" align="right" class="sub_key" style="vertical-align:middle; font-size:12px; font-weight:bold;">
                                    '.lang($key[$i], ($key[$i])).': 
                                </td>
                                <td class="sub_key">';
                        echo '<select name="'.$key[$i].'" id="'.$key[$i].'">';
                        for( $enumindex=0;  $enumindex<count($enum);  $enumindex++ ){
                            if($enum[$enumindex]!=""){
                                $selected           = $rs[$key[$i]]==$enum[$enumindex] ? ' selected="selected" ' : '' ;
                                echo '<option value="'.$enum[$enumindex].'" '.$selected.'>'.$enum[$enumindex].'</option>';
                            }
                        }
                        echo '</select>';
                        echo '
                                </td>
                            </tr>
                        ';
                    }else{
                        echo '
                            <tr>
                                <td width="210" align="right" class="sub_key" style="vertical-align:middle; font-size:12px; font-weight:bold;">
                                    '.lang($key[$i], ($key[$i])).': 
                                </td>
                                <td class="sub_key">';
                        
                        if($key[$i] == "company_address_footer" || $key[$i] == "company_phone_footer" || $key[$i] == "company_email_footer"){
                        	$com_address = '<font style="color:#2e6499;"><i>*กรุณาระบุ # หากต้องการเว้นบรรทัด</i></font>';
                        }else{
                        	$com_address = "";
                        }
                        
                        if($key[$i] == "company_email"){
                        	$company_email = '<font style="color:red;"><i>*กรุณาระบุ ,เพื่อคั่นระหว่างหลายอีเมล์</i></font>';
                        }else{
                        	$company_email = '';
                        }
                      
                        
                        switch($key_type[$i]){                            
                            case 'int'      :
                            case 'float'    :
                            case 'double'   :
                            	echo '<input style="width:450px; font-size:14px;" name="'.$key[$i].'" id='.$key[$i].' type="text" value="'.$rs[$key[$i]].'">';
                                break;
                            
                            case 'text'     :
                                echo '
                                    <textarea style="font-size:14px;" rows="10" name="'.$key[$i].'" id='.$key[$i].'>'.$rs[$key[$i]].'</textarea>
                                    <script>$(function(){textCounter("#'.$key[$i].'");});</script>
                                ';
                                break;
                            case 'char'     :
                            case 'varchar'  :
                            default         :
                            	echo '<input style="width:480px; font-size:14px; " name="'.$key[$i].'" id='.$key[$i].' type="text"  value="'.$rs[$key[$i]].'"> '.@$com_address.@$company_email.'
                                        <script>$(function(){textCounter("#'.$key[$i].'");});</script>
                                    ';
                                break;
                        }
                        echo '
                                </td>
                            </tr>
                        ';
                    }
                }
            ?>
            
            
            
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



<style>
    .counter{
        color: #CCC;
        font-style: italic;
        padding-left:5px;
    }
    .counter span{
        color: #df8f8f;
        font-weight: bold;
    }
</style>


<script>
    $(function(){
        $('#adminTable').validate();
    });
    function textCounter(target){
        $(target).parent().append($('<div  class="counter">จำนวนทั้งหมด <span id="counter-'+$(target).attr('id')+'">'+  $(target).val().length+'</span> ตัวอักษร</div>'));
        $(target).keyup(function(){
            $('#counter-'+$(target).attr('id')).text($(target).val().length);
        });
    }
</script>
