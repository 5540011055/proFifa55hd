<?php
    require_once 'util/Util.php';
    $msg                    = '';
    $noError                = true;
    if(!file_exists('./tmp') ){
        $noError            = false;
        $msg                .='
            - tmp directory not found.<br />
        ';
    }else{
       //exit(getPermission(fileperms('./tmp')));
        echo octdec(0777).'';
    }
    
    
    
    
    
    
    
    
    if(!$noError){
        echo '
            <link rel="stylesheet" href="js/ui/css/start/jquery-ui-1.8.21.custom.css" />
            <div class="ui-widget-content ">
                <div class="ui-state ui-corner-all" style="padding: 2px;font-size: 14px;">
                    <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: 2px"></span>
                    <strong>Error:</strong> 
                        <pre>
                        '.$msg.'
                        </pre>
                    </p>
                </div>
            </div>
        ';
        exit();
    }
    
    
    
    
    function getPermission($perms){
        if (($perms & 0xC000) == 0xC000) {
            // Socket
            $info = 's';
        } elseif (($perms & 0xA000) == 0xA000) {
            // Symbolic Link
            $info = 'l';
        } elseif (($perms & 0x8000) == 0x8000) {
            // Regular
            $info = '-';
        } elseif (($perms & 0x6000) == 0x6000) {
            // Block special
            $info = 'b';
        } elseif (($perms & 0x4000) == 0x4000) {
            // Directory
            $info = 'd';
        } elseif (($perms & 0x2000) == 0x2000) {
            // Character special
            $info = 'c';
        } elseif (($perms & 0x1000) == 0x1000) {
            // FIFO pipe
            $info = 'p';
        } else {
            // Unknown
            $info = 'u';
        }

        // Owner
        $info .= (($perms & 0x0100) ? 'r' : '-');
        $info .= (($perms & 0x0080) ? 'w' : '-');
        $info .= (($perms & 0x0040) ?
                    (($perms & 0x0800) ? 's' : 'x' ) :
                    (($perms & 0x0800) ? 'S' : '-'));

        // Group
        $info .= (($perms & 0x0020) ? 'r' : '-');
        $info .= (($perms & 0x0010) ? 'w' : '-');
        $info .= (($perms & 0x0008) ?
                    (($perms & 0x0400) ? 's' : 'x' ) :
                    (($perms & 0x0400) ? 'S' : '-'));

        // World
        $info .= (($perms & 0x0004) ? 'r' : '-');
        $info .= (($perms & 0x0002) ? 'w' : '-');
        $info .= (($perms & 0x0001) ?
                    (($perms & 0x0200) ? 't' : 'x' ) :
                    (($perms & 0x0200) ? 'T' : '-'));

        return $info;

    }
?>
