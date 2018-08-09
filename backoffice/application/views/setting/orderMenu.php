<form action="<?=base_url().$_CMD.'/'.$task?>" method="post" name="adminTable" id="adminTable">
    <input type="hidden" name="local_id" value="<?=Site::$local_id?>" />
    <table width="850" border="0" align="center" cellpadding="0" cellspacing="2" class="admintable">
        <tr>
            <td width="210" align="right" class="sub_key" style="vertical-align:middle; font-size:16px; font-weight:bold;">
                <?=lang('No.')?>
            </td>
            <td class="sub_key"  style="vertical-align:middle; font-size:16px; font-weight:bold;"><?=lang('Menu name')?></td>
        </tr>
        <?PHP
            if(!count($rs)){
            ?>
                <tr>
                    <td width="210" align="right" class="sub_key" style="vertical-align:middle; font-size:12px; font-weight:bold;">
                        -
                    </td>
                    <td class="sub_key">ไม่มีข้อมูล</td>
                </tr>
            <?
            }
            else{
                foreach($rs AS $row){
                ?>
                    <tr>
                        <td width="210" align="right" class="sub_key" style="vertical-align:middle; font-size:12px; font-weight:bold; " >
                            <input type="hidden" name="menuname[]" value="<?=$row['menuname']?>" />
                            <input type="text" 
                                   name="sort_order[]" 
                                   value="<?=@intval($row['sort_order'])?>" 
                                   style="text-align:right; width:70px; font-size:14px;; font-weight:bold; color:blue;" />
                        </td>
                        <td class="sub_key" style="padding-left:10px; vertical-align:middle;"><?=lang($row['menuname'])?></td>
                    </tr>
                <?
                }
            }
        ?>
        <tr>
            <td  colspan="2"  style="vertical-align:middle; text-align:right">
                <button type="subbmit" class="button button-blue">บันทึก</button>
                <button type="button" class="button button-red" onclick="window.location='<?=base_url().$_CMD?>';">ยกเลิก</button>
            </td>
        </tr>
    </table>
    
</form>