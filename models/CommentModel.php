<?php
class CommentModel
{

    public function deleteComment($params)
    {
        $db = new DBManager();
        $conn = $db->getConnection();

        $sql = "DELETE FROM comment WHERE comment_id = $params[comment_id] ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    public function updateComment($params) {
        $db = new DBManager();
        $conn = $db->getConnection();

        $sql = "UPDATE comment SET user_comment = '$params[user_comment]' WHERE comment_id = $params[comment_id] ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

    }

    //UseCase
    public function insertCommentUseCase($params)
    {
        $db = new DBManager();
        $conn = $db->getConnection();

        $sql = "INSERT INTO comment(user_comment, user_id, usecase_id) 
                VALUES('$params[user_comment]', $params[user_id], $params[usecase_id])";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $lastId = $conn->lastInsertId();

        return $lastId;
    }

    public function getAllCommentAndLikeByUseCase($params)
    {
        $db = new DBManager();
        $conn = $db->getConnection();

        $sql = "SELECT group1.*, c.like_id, d.count_comment from (
                    SELECT a.comment_id ,a.user_comment , a.user_id , DATE_FORMAT(a.date, '%d-%m-%Y') as date , b.username
                        FROM comment a , user b
                    WHERE a.user_id = b.user_id 
                            AND usecase_id = $params[usecase_id]
                    ORDER BY a.date DESC ) group1
                left join likebt c on group1.comment_id = c.comment_id and c.user_id = $params[user_id]
                left join (select count(1) count_comment, comment_id from likebt group by comment_id) d on group1.comment_id = d.comment_id
            order by comment_id desc";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    //Share
    public function insertCommentShare($params)
    {
        $db = new DBManager();
        $conn = $db->getConnection();

        $sql = "INSERT INTO comment(user_comment, user_id, share_id) 
                VALUES('$params[user_comment]', $params[user_id], $params[share_id])";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $lastId = $conn->lastInsertId();

        return $lastId;
    }
    
    public function getAllCommentAndLikeByShare($params)
    {
        $db = new DBManager();
        $conn = $db->getConnection();

        $sql = "SELECT group1.*, c.like_id, d.count_comment from (
            SELECT a.comment_id ,a.user_comment , a.user_id , DATE_FORMAT(a.date, '%d-%m-%Y') as date , b.username
                FROM comment a , user b
            WHERE a.user_id = b.user_id 
                    AND share_id = $params[share_id]
            ORDER BY a.date DESC ) group1
        left join likebt c on group1.comment_id = c.comment_id and c.user_id = $params[user_id]
        left join (select count(1) count_comment, comment_id from likebt group by comment_id) d on group1.comment_id = d.comment_id
    order by comment_id desc";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    

    //Question
    public function insertCommentQuestion($params)
    {
        $db = new DBManager();
        $conn = $db->getConnection();

        $sql = "INSERT INTO comment(user_comment, user_id, question_id) 
                VALUES('$params[user_comment]', $params[user_id], $params[question_id])";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $lastId = $conn->lastInsertId();

        return $lastId;
    }

    public function getAllCommentAndLikeByQuestion($params)
    {
        $db = new DBManager();
        $conn = $db->getConnection();

        $sql = "SELECT group1.*, c.like_id, d.count_comment from (
                    SELECT a.comment_id ,a.user_comment , a.user_id , DATE_FORMAT(a.date, '%d-%m-%Y') as date , b.username
                        FROM comment a , user b
                    WHERE a.user_id = b.user_id 
                            AND question_id = $params[question_id]
                    ORDER BY a.date DESC ) group1
                left join likebt c on group1.comment_id = c.comment_id and c.user_id = $params[user_id]
                left join (select count(1) count_comment, comment_id from likebt group by comment_id) d on group1.comment_id = d.comment_id
            order by comment_id desc";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //Comment History only usecase and share
    public function getCommentHistory($params) {
        $db = new DBManager();
        $conn = $db->getConnection();

      
        $sql = "SELECT group1.comment_id,
        DATE_FORMAT(group1.date, '%d-%m-%Y') as date,  
        group1.usecase_id,
        group1.share_id,
        group1.user_comment  as topic ,
        if(group1.usecase_id is null, b.use_case_name, a.usecase_name) AS usecase_name
         from (SELECT comment_id, date as date, usecase_id, share_id ,user_comment
            from comment 
        where user_id = $params and (usecase_id is not null or share_id is not null)) group1
        left join usecasediagram a on group1.usecase_id = a.usecase_id
        left join share b on group1.share_id = b.share_id
        order by group1.date desc";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }


    public function getCommentQuestionHistory($params) {
        $db = new DBManager();
        $conn = $db->getConnection();

      
        $sql = "SELECT group1.comment_id,
        DATE_FORMAT(group1.date, '%d-%m-%Y') as date,  
            group1.question_id as id,
            a.question_topic ,
             group1.user_comment AS topic
             from (SELECT comment_id, date as date, question_id , user_comment
            from comment 
        where user_id = $params and (question_id is not null)) group1
        left join question a on group1.question_id = a.question_id
        order by group1.date desc";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
}
