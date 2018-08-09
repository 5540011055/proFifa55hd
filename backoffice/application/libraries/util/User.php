<?php
    class User{
        
        function User($userId){
            $this->ID       = $userId;
        }
        
        
        public function setUserId( $userId ){
            $this->ID       = $userId;
        }
        public function getUserId(){
            return $this->ID;
        }
        
        
        public function getAvatar(){
            $db         = getDBO();
            $db->setQuery(" SELECT avatar  FROM users WHERE id='{$this->ID}' and status='1'; ");
            $rs         = $db->loadAssocList();
            return $rs[0]['avatar'];
        }
        
        
        public function getEmail(){
            $db         = getDBO();
            $db->setQuery(" SELECT email  FROM users WHERE id='{$this->ID}' and status='1'; ");
            $rs         = $db->loadAssocList();
            return $rs[0]['email'];
        }
        
        
        public function getName(){
            $db         = getDBO();
            $db->setQuery(" SELECT fullname  FROM users WHERE id='{$this->ID}' and status='1'; ");
            $rs         = $db->loadAssocList();
            return $rs[0]['fullname'];
        }
        
        public function getIPAddress(){
            $db         = getDBO();
            $db->setQuery(" SELECT ip_login  FROM users WHERE id='{$this->ID}' and status='1'; ");
            $rs         = $db->loadAssocList();
            if( $rs[0]['ip_login']!="::1" ){
                $buf    = explode('.', $rs[0]['ip_login']);
                if( count($buf)==4 ){
                    $buf[1] = 'xxx';
                    $buf[2] = 'xxx';
                    $rs[0]['ip_login']      = implode(".", $buf);
                }
            }
            return $rs[0]['ip_login'];
        }
        
        
        public function getDepartmentName(){
            return getDepartmentName($this->getLocalId());
        }
        
        
        public function getLocalId(){
            $db         = getDBO();
            $db->setQuery(" SELECT local_id  FROM users WHERE id='{$this->ID}' and status='1'; ");
            $rs         = $db->loadAssocList();
            return $rs[0]['local_id'];
        }
        
        
        
        
        // Class variables
        private $ID;
        
    }
?>
