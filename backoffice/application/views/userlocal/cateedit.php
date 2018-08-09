<form action="<?=base_url().$_CMD.'/'.$task?>" method="post" name="adminTable" id="adminTable">
    
    <input name="id" type="hidden" id="id" value="<?=@$frm['id']?>">
    <table width="850" border="0" align="center" cellpadding="0" cellspacing="2" class="admintable">
        <tbody>
            
            
            <tr>
                <td width="150" align="right" class="sub_key"><?=lang('Main category', 'Main category')?> :</td>
                <td class="sub_key">
                    <?=@$getAllCategory?>
                </td>
            </tr>
            
            
            
            <tr>
                <td width="150" align="right" class="sub_key"><?=lang('subject')?> :</td>
                <td class="sub_key">
                    <input name="cate_name" 
                           type="text" 
                           id="subject" 
                           value="<?=@$frm['cate_name']?>" 
                           size="70" 
                           maxlength="100" 
                           class="required text" />
                    
                </td>
            </tr>
            
                 
            
            <tr>
                <td align="right" class="sub_key"><?=lang('status')?> :</td>
                <td class="sub_key">
                    <select name="status" id="status" class="required">
                        <option value="1" <?=(@$frm['status']==1?'selected="selected"':'')?> >แสดงผล</option>
                        <option value="0" <?=(@$frm['status']==0?'selected="selected"':'')?> >ไม่แสดงผล</option>                        
                    </select>
                </td>
            </tr>
            
            
            
            <tr>
                <td height="25" align="right" valign="top" class="sub_key" colspan="2">            
                    <button class="button button-blue" type="submit" id="Save" name="Save"><?=lang('Save','Save')?></button>                       
                    <button class="button button-red" type="button" id="Back" name="Back" onclick="window.history.back();"><?=lang('cancel', 'cancel')?></button>
                </td>
            </tr>
            
        </tbody>
    </table>
    
</form>



<script>
    $(function(){
        $('#adminTable').validate();
    });
</script>