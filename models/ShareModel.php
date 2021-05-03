<?php
    class ShareModel {
        public function getAllShare() {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "SELECT share.use_case_name, share.share_id, user.username , DATE_FORMAT(share.date, '%d-%m-%Y') as date , share.confirm_post
            FROM share 
            INNER JOIN user 
            ON user.user_id=share.user_id 
           ORDER BY share.date desc";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getConfirmShare() {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "SELECT share.use_case_name, share.share_id, user.username , DATE_FORMAT(share.date, '%d-%m-%Y') as date , share.confirm_post
            FROM share 
            INNER JOIN user 
            ON user.user_id=share.user_id 
            WHERE share.confirm_post = 1
           ORDER BY share.date desc";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getShareById($Share_id) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "SELECT a.use_case_name , a.description , a.image ,b.user_id , b.username , Date_format(a.date, '%d-%m-%Y') as date
                        FROM share a, user b 
                        where a.user_id = b.user_id AND a.Share_id = $Share_id ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }

        public function getShareByUserId($userId) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "SELECT share_id as id , use_case_name as topic , Date_format(date, '%d-%m-%Y') as date , confirm_post
                        FROM share
                        where  user_id = $userId and confirm_post=1
                        ORDER BY date desc";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }


        public function insertShare($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "INSERT INTO share(use_case_name, description, image, user_id) VALUES('$params[usecase_name]', '$params[description]', '$params[img]', $params[user_id])";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
           
        }

        public function ConfirmPostShareById($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "UPDATE share SET confirm_post = 1 WHERE share.share_id = $params[Share_id];";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
           
        }

        public function updateShareDescById($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "UPDATE share SET DESCRIPTION = '$params[Share_desc]' WHERE Share_id = $params[Share_id] ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

        }

        
        public function deleteShareById($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "DELETE FROM share WHERE share_id = $params[Share_id] ";
            //echo $sql;
            $stmt = $conn->prepare($sql);
            $stmt->execute();  
        }
    }
?>