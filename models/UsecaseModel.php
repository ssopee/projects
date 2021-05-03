<?php
    class UsecaseModel {
        public function getUsecaseByCategoryId($category_id) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "SELECT b.category_name, a.usecase_id , a.usecase_name , b.icon
                        FROM usecasediagram a , usecase_category b  
                    WHERE a.category_id = $category_id AND b.category_id = $category_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }

        public function getUsecaseById($usecase_id) {
            $db = new DBManager();
            $conn = $db->getConnection();
            $sql = "SELECT a.usecase_name , a.image , a.ref_link , b.icon
                    FROM usecasediagram a , usecase_category b  
                    WHERE a.usecase_id = $usecase_id  AND a.category_id = b.category_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        

        
    }
?>