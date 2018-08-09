<form action="<?=base_url().  getParam(1).'/'.$task?>" method="post" name="adminTable" id="adminTable">
    
    <input name="id" type="hidden" id="id" value="<?=@$frm['id']?>">
    
    
    <table width="850" border="0" align="center" cellpadding="0" cellspacing="2" class="admintable">
        <tbody>
           

            <tr>
                <td width="150" align="right" class="sub_key">ชื่อผู้ใช้งาน :</td>
                <td class="sub_key">
                    	<input type="text" name="username" value="<?=$frm['username']?>" class="required text" size="70"
                        title="**ใช้ตัวอักษรอย่างน้อย 5 ตัวอักษรและ <u>ไม่เป็นอักษรภาษาไทย</u> "   />         
                </td>
            </tr>
            
            
            <?PHP
                if( getParam(2)=='add' ){
                ?>
                    <tr>
                        <td width="150" align="right" class="sub_key">รหัสผ่าน :</td>
                        <td class="sub_key">
                            <input name="password" 
                                   type="password" 
                                   id="password" 
                                   size="70" 
                                   class="required text" 
                                   onkeyup="$('#password_backup').val($(this).val());"
                                   style="width:380px;"
                                   title="**หากอยู่ในสถานะแสดงรหัสผ่าน รหัสผ่านจะไม่สามารถแก้ไขได้"/>             
                            
                            <input name="password_backup" 
                                   type="text" 
                                   id="password_backup" 
                                   size="70"
                                   readonly="readonly"
                                   style="display:none; font-size:14px; width:380px; color:gray;"
                                   title="**หากอยู่ในสถานะแสดงรหัสผ่าน รหัสผ่านจะไม่สามารถแก้ไขได้""/>             
                            
                            <div class="button button-red" id="div-show-password" onclick="showPassword(this);">แสดงรหัสผ่าน</div>
                            <script>
                                function showPassword(obj){
                                    if( $('#password').css('display')=='none' ){
                                        $('#div-show-password').text('แสดงรหัสผ่าน');
                                        $('#div-show-password').removeClass('button-blue');
                                        $('#div-show-password').addClass('button-red');
                                        $('#password_backup').hide();
                                        $('#password').show();
                                    }else{
                                        $('#div-show-password').text('ซ่อนรหัสผ่าน');
                                        $('#div-show-password').removeClass('button-red');
                                        $('#div-show-password').addClass('button-blue');
                                        $('#password_backup').show();
                                        $('#password').hide();
                                    }
                                }
                            </script>
                        </td>
                    </tr>
                    
                <?
                }
            ?>
                    
                    
            <tr>
                <td width="150" align="right" class="sub_key" colspan="2">&nbsp;
                </td>
            </tr>        
            
            
            <tr>
                <td width="150" align="right" class="sub_key">ชื่อ-นามสกุล :</td>
                <td class="sub_key">
                    <input name="fullname" 
                           type="text" 
                           id="fullname" 
                           value="<?=@$frm['fullname']?>" 
                           size="70" 
                           class="required text" />                    
                </td>
            </tr>
            
            
            
            <tr>
                <td width="150" align="right" class="sub_key" style="vertical-align:top;">ที่อยู่ :</td>
                <td class="sub_key"  style="vertical-align:top;">
                    <textarea name="address" style="height:80px;"><?=@$frm['address']?></textarea>
                </td>
            </tr>
            
            
            
            <tr>
                <td width="150" align="right" class="sub_key">Email :</td>
                <td class="sub_key">
                    <input name="email" 
                           type="text" 
                           id="email" 
                           value="<?=@$frm['email']?>" 
                           size="70" 
                           class="required email" />                    
                </td>
            </tr>
            
            
            
            <tr>
                <td width="150" align="right" class="sub_key">โทรศัพท์ :</td> 
                <td class="sub_key">
                    <input name="phone" 
                           type="text" 
                           id="phone" 
                           value="<?=@$frm['phone']?>" 
                           size="70" 
                           class="" />                    
                </td>
            </tr>
            
            
            
            
            <tr>
                <td width="150" align="right" class="sub_key">จังหวัด :</td> 
                <td class="sub_key">
                    <select name="province" onchange="changeProvince(this.value);" class="required" id="province">
                        <option value="">เลือกจังหวัด</option>
                        <?PHP
                            $db             = getDBO();
                            $db->setQuery(" SELECT      *   
                                            FROM        cpanel_province
                                            ORDER BY    name ASC");
                            $province       = $db->loadAssocList();
                            foreach( $province      AS $p ){
                                $selected   = @$frm['province']==$p['id']?' selected="selected" ':'';
                            ?>
                                <option value="<?=$p['id']?>" <?=$selected?> ><?=$p['name']?></option>
                            <?
                            }
                        ?>
                    </select>
                </td>
            </tr>
            
            
            <tr>
                <td width="150" align="right" class="sub_key">อำเภอ :</td> 
                <td class="sub_key">
                    <select name="amphur" class="required" id="amphur">
                        <option value="">เลือกอำเภอ</option>
                        <?PHP
                            if(@$frm['province']){
                                $db->setQuery(" SELECT      *   
                                                FROM        cpanel_amphur
                                                WHERE       provinceID='{$frm['province']}'
                                                ORDER BY    name ASC");
                                $province       = $db->loadAssocList();
                                foreach( $province      AS $p ){
                                    $selected   = @$frm['amphur']==$p['id']?' selected="selected" ':'';
                                ?>
                                    <option value="<?=$p['id']?>" <?=$selected?> ><?=$p['name']?></option>
                                <?
                                }
                            }
                        ?>
                    </select>
                </td>
            </tr>
            
            
            <tr>
                <td width="150" align="right" class="sub_key">รหัสไปรษณีย์ :</td> 
                <td class="sub_key">
                    <input type="text" name="postcode" value="<?=@$frm['postcode']?>" />
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
    var a ={
        aa : [
            {id:"",name:""},
            {id:"",name:""},
            {id:"",name:""},
            {id:"",name:""}
        ]
    };
    var amphur          = {
        <?PHP
            foreach( $province      AS $p ){
                $val        = "'{$p['id']}':[";
                $db->setQuery("SELECT * FROM cpanel_amphur WHERE provinceID='{$p['id']}' ");
                $amp_ls     = $db->loadAssocList();
                $amp        = Array();
                foreach( $amp_ls        AS $v ){
                    $amp[]  ="{id:'{$v['id']}',name:'{$v['name']}'}";
                }
                $amp        = implode(',', $amp);
                $val        .=$amp.'],';
                echo $val;
            }
        ?>
    };
    $(function(){
        $('#adminTable').validate();
    });
    function changeProvince(provinceId){
        $('#amphur option').remove();
        for( i=0;  i<amphur[provinceId].length; i++ ){
            $('#amphur').append('<option value="'+amphur[provinceId][i].id+'">'+amphur[provinceId][i].name+'</option>');
        }
        
    }
</script>