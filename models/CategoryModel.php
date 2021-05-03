<?php
    class CategoryModel {
        public function getAllCategory() {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "SELECT * FROM usecase_category ORDER BY category_name";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>