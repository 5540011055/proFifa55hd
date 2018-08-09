<?PHP
    header("Location: {$page}");
    exit();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>City Administrative System</title>
        <script type="text/javascript" src="<?=base_url()?>js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>js/ui/js/jquery-ui-1.8.21.custom.min.js"></script>
        <link rel="stylesheet" href="<?=base_url()?>js/ui/css/start/jquery-ui-1.8.21.custom.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url()?>styles/button.css" type="text/css">
    </head>
    <body>
        <div class="ui-widget">
            <div class="ui-state-focus ui-corner-all" style="padding: 2px;font-size: 14px;">
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: 2px"></span>
                <!--<strong>Message:</strong>--> <?=@$msg?></p>
            </div>
        </div>
        <br />
        
        
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
          Please wait &nbsp;<span id="redirect-sec">6</span>&nbsp;วินาที&nbsp;<br />
            เพื่อไปยังหน้าถัดไปหรือกดที่นี่ &nbsp;
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
    
    
    </body>
</html>