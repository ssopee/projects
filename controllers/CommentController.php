<?php
require_once '../classes/DBManager.php';
require_once '../models/CommentModel.php';
session_start();

if (isset($_POST)) {
    $params = $_POST;
    $service = $params["service"];
    $CommentModel = new CommentModel();
    
    if ($service == 'insertCommentUsecase') {
        $lastId = $CommentModel->insertCommentUseCase($params);
        echo $lastId;
    }

    if ($service == 'insertCommentShare') {
        $lastId =  $CommentModel->insertCommentShare($params);
        echo $lastId;
    }

    if ($service == 'insertCommentQuestion') {
        $lastId = $CommentModel->insertCommentQuestion($params);
        echo $lastId;
    }

    if ($service == 'updateComment') {
        $CommentModel->updateComment($params);
    }

    if ($service == 'deleteComment') {
        $CommentModel->deleteComment($params);
    }
}
