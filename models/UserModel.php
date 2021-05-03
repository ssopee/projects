<?php
    class UserModel {
        public function insertUser($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "INSERT INTO user(username, email, password) VALUES('$params[username]', '$params[email]', '$params[pwd]')";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }

        public function getUserByEmailPwd($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "SELECT * FROM user WHERE email='$params[email]' and password='$params[pwd]'  ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>
