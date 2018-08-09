<form action="<?=base_url().  getParam(1).'/'.$task?>" method="post" name="adminTable" id="adminTable">
    
    <input name="id" type="hidden" id="id" value="<?=@$frm['id']?>">
    
    
    <table width="850" border="0" align="center" cellpadding="0" cellspacing="2" class="admintable">
        <tbody>
           

            <tr>
                <td width="150" align="right" class="sub_key">Current Password :</td>
                <td class="sub_key">
                    <input type="password" name="password_old" value="" />           
                </td>
            </tr>
            <tr>
                <td width="150" align="right" class="sub_key" colspan="2">&nbsp;</td>
            </tr>
           
            
            <tr>
                <td width="150" align="right" class="sub_key">New Password</td>
                <td class="sub_key">
                    <input type="password" name="password_new" value="" />           
                </td>
            </tr>
            
            <tr>
                <td width="150" align="right" class="sub_key">New Password Confirm</td>
                <td class="sub_key">
                    <input type="password" name="password_new_again" value="" />           
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

