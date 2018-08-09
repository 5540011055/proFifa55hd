<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1920px; height: 600px; overflow: hidden; visibility: hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        
        <div data-u="slides" id="jssor_1_in" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1920px; height: 600px; overflow: hidden;">
            <?php
				$db->setQuery("SELECT id,subject,display_image,url FROM banner_information WHERE status = '1' ORDER BY seq ASC LIMIT 20");
                $rs = $db->loadAssocList();

                if($rs){
                	for($i=0;$i<count($rs);$i++){
						//$images  = getImageRatio($rs[$i]['display_image'],1300,500);
                		$images  = $rs[$i]['display_image'];
						
                		$url     =  ($rs[$i]['url']) ? $rs[$i]['url'] : 'javascript:void(0);' ;
						$curser =  ($rs[$i]['url']) ? 'cursor: pointer;' : 'cursor: default;';
               ?>
           
	            <div data-p="225.00" style="display: none;">
	               <a href="<?=@$url?>" style="<?=@$curser?>"> 
	                	<img data-u="image" src="<?=$images?>" />
	               </a> 
	            </div>
            
            <?php  } // End for
                } // End if
             ?> 
             
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
            <!-- bullet navigator item prototype -->
            <div data-u="prototype" style="width:16px;height:16px;"></div>
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora22l" style="top:0px;left:8px;width:40px;height:58px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora22r" style="top:0px;right:8px;width:40px;height:58px;" data-autocenter="2"></span>
    </div>
