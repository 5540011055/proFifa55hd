<div class="ui-widget">
    <div class="ui-state-error ui-corner-all" style="padding: 2px;font-size: 14px;">
        <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: 2px"></span>
        <strong><?=(@$messageType?@$messageType:'Error! ')?>:</strong> <?=@$msg?></p>
    </div>
</div>
<br /><br />

<style>
            .redirect{
                padding: 0px 3px 2px 3px;
                color: #888;
                margin: 0;
                padding: 0;
                border: 0;
                outline: 0;
                font-size: 12px;
                vertical-align: baseline;
            }
            #redirect-sec{
                font-size: 18px;
                font-weight: bold;
                color:blue;
            }
        </style>
        <br />
        <div class="redirect" style="text-align:center;">
          Please wait &nbsp; <span id="redirect-sec">6</span>&nbsp;Second&nbsp;<br />
          go to the next page or click here&nbsp;
            <button style="cursor:pointer" class="button button-blue" onClick="window.location='<?=$page?>';">
                <?=lang('Continue','Continue')?>
            </button>
        </div>
        <script>
            function nextPage(delay){
                $('#redirect-sec').text(--delay);
                if(delay>0){
                    setTimeout("nextPage("+delay+");",1200);
                }else{
                    window.location="<?=$page?>";
                }
            }
            $(function(){
                setTimeout("nextPage(6);", 1200);
            })
        </script>