<div class="tab-content default-tab" style="display: block; ">
    <h4></h4>
    <p style="padding:0px;">
        
        <form name="Adminform" id="Adminform" action="<?=Site::$fullAdminURL.getParam(1).'/'.getParam(2)?>/" method="GET">
            <input type="hidden" name="search" value="<?=request('search')?>" style="width:280px;" />
            <input type="hidden" name="page" id="page" value="<?=request('page')?>">
            <?=$gridTable?>   
        </form>
    
        <div style="float:right;">
            <?=$paginator?>
        </div>

    
        <div class="clear"></div>
        
    </p>
</div> 