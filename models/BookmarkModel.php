<?php
    class BookmarkModel {

        public function getBookmarkUsecaseByID($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

          
            $sql = "SELECT * FROM bookmark WHERE usecase_id=$params[usecase_id] AND user_id=$params[user_id] ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        
        public function BookmarkUsecaseByID($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "INSERT INTO bookmark(usecase_id , user_id) VALUES($params[usecase_id], $params[user_id])";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }

        public function deleteBookmarkUsecaseByID($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

          
            $sql = "DELETE FROM bookmark WHERE usecase_id=$params[usecase_id] AND user_id=$params[user_id] ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }

        //Bookmark History
        public function getBookmarkHistory($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

          
            $sql = "SELECT group1.topic,  DATE_FORMAT(group1.date, '%d-%m-%Y') as date, group1.usecase_id, group1.share_id  from (
                SELECT b.usecase_name as topic , a.date , b.usecase_id  ,a.share_id
                FROM bookmark a LEFT JOIN usecasediagram b ON a.usecase_id= b.usecase_id WHERE a.user_id = $params AND a.usecase_id= b.usecase_id 
                UNION ALL
                SELECT d.use_case_name as topic ,c.date ,  c.usecase_id , d.share_id 
                FROM bookmark c RIGHT JOIN share d ON c.share_id = d.share_id WHERE c.user_id = $params AND c.share_id = d.share_id) group1
                order by group1.date desc";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        
        //Share

        public function getBookmarkShareByID($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

          
            $sql = "SELECT * FROM bookmark WHERE share_id=$params[share_id] AND user_id=$params[user_id] ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        
        public function BookmarkShareByID($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "INSERT INTO bookmark(share_id , user_id) VALUES($params[share_id], $params[user_id])";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }

        public function deleteBookmarkShareByID($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

          
            $sql = "DELETE FROM bookmark WHERE share_id=$params[share_id] AND user_id=$params[user_id] ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }

        
 
    }
?>