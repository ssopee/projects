<?php
    class QuestionModel {
        public function getAllQuestion() {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "SELECT a.question_id , a.question_topic , b.username , Date_format(a.date, '%d-%m-%Y') as date ,a.confirm_question
                        FROM question a, user b 
                        where a.user_id=b.user_id
                    ORDER BY a.date desc";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getConfirmQuestion() {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "SELECT a.question_id , a.question_topic , b.username , Date_format(a.date, '%d-%m-%Y') as date ,a.confirm_question
                        FROM question a, user b 
                        where a.user_id=b.user_id and a.confirm_question = 1
                    ORDER BY a.date desc";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getQuestionById($question_id) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "SELECT a.question_topic , a.description , a.image ,b.user_id , b.username , Date_format(a.date, '%d-%m-%Y') as date
                        FROM question a, user b 
                        where a.user_id=b.user_id AND a.question_id= $question_id ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }

        public function getQuestionByUserId($userId) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "SELECT question_id as id , question_topic as topic , Date_format(date, '%d-%m-%Y') as date , confirm_question
                        FROM question 
                        where  user_id = $userId and confirm_question=1
                        ORDER BY date desc";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function insertQuestion($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "INSERT INTO question(question_topic, description, image, user_id) VALUES('$params[topic]', '$params[description]', '$params[img]', $params[user_id])";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }

        public function updateQuestionDescById($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "UPDATE question SET description = '$params[question_desc]' WHERE question_id = $params[question_id] ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

        }

        public function ConfirmQuestionById($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "UPDATE question SET confirm_question = 1 WHERE question.question_id = $params[question_id];";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

        }

        public function deleteQuestionById($params) {
            $db = new DBManager();
            $conn = $db->getConnection();

            $sql = "DELETE FROM question WHERE question_id = $params[question_id] ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();  
        }

   
         


       
    }
?>