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
        
        $db->setQuery("SELECT COUNT(id) AS total FROM {$_ENV['table_answer']} WHERE tid='{$_id}' AND status<>'2' AND checked='0' ");
        $totalAnswer_waitApprove        = $db->loadAssocList();
        $totalAnswer_waitApprove        = @$totalAnswer_waitApprove[0]['total'];
        
        $db->setQuery("SELECT COUNT(id) AS total FROM {$_ENV['table_answer']} WHERE tid='{$_id}' AND status='1' AND checked='1' ");
        $totalAnswer_Approve    = $db->loadAssocList();
        $totalAnswer_Approve    = $totalAnswer_Approve[0]['total'];
        
        $db->setQuery("SELECT COUNT(id) AS total FROM {$_ENV['table_answer']} WHERE tid='{$_id}' AND checked='1'  AND status='0'  ");
        $totalAnswer_noApprove  = $db->loadAssocList();
        $totalAnswer_noApprove  = @$totalAnswer_noApprove[0]['total'];
        
        $id                 = ' <a  href="javascript:;" 
                                    onClick="showTopicDialog('.$_id.', \''.base_url().getParam(1). '/getTopic_ajax/'.$_id.'\');"
                                    >
                                    <table style="width:100%;border-collapse:separate; font-size:16px;" title="คลิกเพื่อดูข้อมูลความคิดเห็น" >
                                        <tr>
                                            <th style="width:30%; color:red; font-size:16px;">'.($totalAnswer_waitApprove?$totalAnswer_waitApprove:'-').'</th>
                                            <th style="width:30%; color:green;">'.($totalAnswer_Approve?$totalAnswer_Approve:'-').'</th>
                                            <th style="width:30%; color:red;">'.(intval($totalAnswer_noApprove)?intval($totalAnswer_noApprove):'-').'</th>
                                        </tr>
                                    </table>
                                </a>';
    }
    
    
    
    function showSpamTopicDetail(&$id){
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
        $id                 = ' <a  href="javascript:;" 
                                    onClick="showTopicDialog('.$_id.', \''.base_url().getParam(1). '/getTopic_ajax/'.$_id.'\');"
                                    >
                                    '.$subject.'
                                </a>';
    }
    
    
    
    function showTopicDetail_without_comment(&$id){
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
        $id                 = ' <a  href="javascript:;" 
                                    onClick="showTopicDialog('.$_id.', \''.base_url().getParam(1). '/getTopic_ajax/'.$_id.'\');"
                                    title="คลิกเพื่อดูข้อมูล">
                                       <img src="'.base_url().'images/icon-view.png" />&nbsp;'.$id.'</a>
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
                                        <span title="คลิกเพื่อดูรายละเอียด">'.$id.'</span>                                        
                                </a>';
    }
    
    
?>
