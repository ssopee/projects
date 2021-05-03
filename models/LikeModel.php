<?php
class LikeModel
{
    public function insertLike($params)
    {
        $db = new DBManager();
        $conn = $db->getConnection();

        $sql = "INSERT INTO likebt(user_id,comment_id) 
                VALUES($params[user_id],$params[comment_id])";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    public function DeleteLike($params)
    {
        $db = new DBManager();
        $conn = $db->getConnection();

        $sql = "DELETE FROM likebt WHERE user_id = $params[user_id] AND comment_id = $params[comment_id] ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

}
