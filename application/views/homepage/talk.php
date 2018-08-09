<div class="header-top">
       <div class="auto-container clearfix">
           <!-- Top Left -->
           <div class="top-left">
               <ul class="clearfix">
                   <li> &nbsp;&nbsp;<?=$this->lang->line("talk");?> </li>
               </ul>
           </div>
           
           <!-- Top Right -->
           <div class="top-right">
               <ul class="clearfix">
                   <li>
                   		<marquee id="maquee-talk" truespeed="1" scrolldelay="50" scrollamount="2" onmouseover="this.stop();" onmouseout="this.start();">
                   			
                   			<?php
                   			
                   			$db = getDBO();
                   			$db->setQuery("SELECT title FROM talk_information WHERE status = '1' ORDER BY id DESC ");
                   			 
                   			$rs = $db->loadAssocList();
                   			
                   			$msg = "";
                   			 
                   			for($i=0;$i<count($rs);$i++){
                   			
                   			?>
                   			
                   			<span>
                   			 	<?php 
                   			 			//$msg = $rs[$i]["title"];
                   			 			
                   			 			if($i>=0){
                   			 				$msg.= '&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-star orangge"></i> &nbsp;&nbsp;&nbsp;'.$rs[$i]["title"];
                   			 			}
                   			 			
                   			 			echo $msg;
                   			 	 ?>

                   			</span>
                   			
                   			<?php } ?>
                   			
                   		</marquee>
                   </li>   
               </ul>
           </div>
           
       </div>
   </div>