<?php
class ReplyModel
{

    public function insert($params)
    {
        $db = new DBManager();
        $conn = $db->getConnection();

        $sql = "INSERT INTO reply(user_reply, user_id , comment_id) 
                    VALUES('$params[user_reply]', $params[user_id], $params[comment_id])";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $lastId = $conn->lastInsertId();

        return $lastId;
    }

    public function update($params)
    {
        $db = new DBManager();
        $conn = $db->getConnection();

        $sql = "UPDATE comment SET user_comment = '$params[user_comment]' WHERE comment_id = $params[comment_id] ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    public function delete($params)
    {
        $db = new DBManager();
        $conn = $db->getConnection();

        $sql = "DELETE FROM comment WHERE comment_id = $params[comment_id] ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    
}
