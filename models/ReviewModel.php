<?php 
    class ReviewModel {
        public function getReviewByUsecaseAndUser($params) {
            $db = new DBManager();
            $conn = $db->getConnection();
            $sql = "SELECT score
                    FROM review 
                    WHERE usecase_id = $params[usecase_id]  AND user_id = $params[user_id]";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getAvgScoreAndSum($usecase_id) {
            $db = new DBManager();
            $conn = $db->getConnection();
            $sql = "select count(*) as count, avg(score) as avg_score from review where usecase_id = $usecase_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        
        public function insertReviewUsecase($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "INSERT INTO review(usecase_id , user_id , score) VALUES($params[usecase_id], $params[user_id],$params[score])";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }

        public function updateReviewUsecase($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "UPDATE review SET score=$params[score] WHERE usecase_id = $params[usecase_id]  AND user_id = $params[user_id]";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }


        //share


        public function getReviewByShareAndUser($params) {
            $db = new DBManager();
            $conn = $db->getConnection();
            $sql = "SELECT score
                    FROM review 
                    WHERE share_id = $params[share_id]  AND user_id = $params[user_id]";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getShareAvgScoreAndSum($share_id) {
            $db = new DBManager();
            $conn = $db->getConnection();
            $sql = "SELECT count(*) as count, avg(score) as avg_score FROM review WHERE share_id = $share_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        
        public function insertReviewShare($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "INSERT INTO review(share_id , user_id , score) VALUES($params[share_id], $params[user_id],$params[score])";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }

        public function updateReviewShare($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "UPDATE review SET score=$params[score] WHERE share_id = $params[share_id]  AND user_id = $params[user_id]";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }


    }
?>