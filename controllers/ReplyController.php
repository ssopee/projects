<?php
require_once '../classes/DBManager.php';
require_once '../models/ReplyModel.php';
session_start();

if (isset($_POST)) {
    $params = $_POST;
    $service = $params["service"];
    $ReplyModel = new ReplyModel();
    
    if ($service == 'insert') {
        $lastId = $ReplyModel->insert($params);
        echo $lastId;
    }

    else if ($service == 'update') {
        $ReplyModel->update($params);
    }

    else if ($service == 'delete') {
        $ReplyModel->delete($params);
    }
}
