<form action="<?=base_url().$_CMD.'/'.$task?>" method="post" name="adminTable" id="adminTable">
    <input type="hidden" name="local_id" value="<?=Site::$local_id?>" />
    <table width="850" border="0" align="center" cellpadding="0" cellspacing="2" class="admintable">
        <tbody>
            
            
            <tr>
                <td width="150" align="right" class="sub_key">Title :</td>
                <td class="sub_key">
                    <?=getDescription('title', 'title', @$frm['title'])?>
                </td>
            </tr>
            
            
            <tr>
                <td width="150" align="right" class="sub_key">Footer :</td>
                <td class="sub_key">
                    <?=getDescription('footer', 'footer', @$frm['footer'])?>
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
