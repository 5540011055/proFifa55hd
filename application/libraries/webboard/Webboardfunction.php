<?php
    /* Fake class */
    class Webboardfunction{}
    
    
    function showTopicDetail(&$id){
       /*
        *  $id                 = '<img src="'.base_url().'images/view.gif" 
                                    width="16" 
                                    height="16" 
                                    style="cursor:pointer" 
                                    onClick="showTopicDialog('.$id.', \''.  base_url(). getParam(1). '/getTopic_ajax/'.$id.'\');" />';
        */
        $_id                = intval($id);
        $subject            = str_replace($_id, '', $id);
        $id                 = $subject;
        $db                 = getDBO();
        $db->setQuery("SELECT COUNT(id) AS total FROM {$_ENV['table_answer']} WHERE tid='{$_id}' AND status<>'2' ");
        $totalAnswer        = $db->loadAssocList();
        $totalAnswer        = $totalAnswer[0]['total'];
        $db->setQuery("SELECT COUNT(id) AS total FROM {$_ENV['table_answer']} WHERE tid='{$_id}' AND ( status='0' OR checked='0' ) ");
        $totalAnswer_noApprove  = $db->loadAssocList();
        $totalAnswer_noApprove  = $totalAnswer_noApprove[0]['total'];
        $db->setQuery("SELECT COUNT(id) AS total FROM {$_ENV['table_answer']} WHERE tid='{$_id}' AND status='1' AND checked='1' ");
        $totalAnswer_Approve    = $db->loadAssocList();
        $totalAnswer_Approve    = $totalAnswer_Approve[0]['total'];
        $id                 = ' <a   href="javascript:;" 
                                    onClick="showTopicDialog('.$_id.', \''.base_url().getParam(1). '/getTopic_ajax/'.$_id.'\');">
                                        <u>'.$id.'</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span style="float:right;">
                                            <span style="color:blue">(ความคิดเห็น: <b><u>'.$totalAnswer.'</u></b>, อนุมัติ: <span style="color:green"><b><u>'.$totalAnswer_Approve.'</u></b></span>, ไม่อนุมัติ: <span style="color:red"><b><u>'. intval($totalAnswer_noApprove).'</u></b></span>)</span>               
                                        </span>
                                </a>';
    }
    
    
    
    function getWebboardStatus(&$status){
        $status             = explode('_', $status);
        $checked            = $status[0];
        $status             = $status[1];
        if(!$checked){
            $status         = '<span style="color:orange;font-weight:bold;">ยังไม่อนุมัติ</span>';
        }else{
            switch($status){
                case 0      :
                    $status             = '<span style="color:red;font-weight:bold;">ไม่อนุมัติ</span>';
                    break;
                case 1      :
                    $status             = '<span style="color:green;font-weight:bold;">อนุมัติแล้ว</span>';
                    break;
                case 2      :
                    $status             = '<span style="color:red;font-weight:bold;">Deleted</span>';
                    break;
                default     :
                    $status             = '<span style="color:red;font-weight:bold;">-</span>';
                    break;
            }
        }
    }
    
    
    
    function showCommentDetail(&$id){
        $_id                = intval($id);
        $subject            = str_replace($_id, '', $id);
        $id                 = $subject;
        $id                 = ' <a   href="javascript:;" 
                                    onClick="showTopicDialog('.$_id.', \''.base_url().getParam(1). '/getComment_ajax/'.$_id.'\');">
                                        <u>'.$id.'</u>                                        
                                </a>';
    }
    
    
    
    
?>
