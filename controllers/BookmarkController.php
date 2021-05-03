<?php 
   require_once '../classes/DBManager.php';
   require_once '../models/BookmarkModel.php';

    if(isset($_POST)) {
        $service = isset($_POST["service"])? $_POST["service"]:"";
        $params = $_POST;
        $BookmarkModel = new BookmarkModel();
        if($service == "insertUsecase") {
            $BookmarkModel->BookmarkUsecaseByID($params);
        }

        else if($service == "deleteUsecase") {
            $BookmarkModel->deleteBookmarkUsecaseByID($params);
        }

        else if($service == "insertShare") {
            $BookmarkModel->BookmarkShareByID($params);
        }

        else {
            $BookmarkModel->deleteBookmarkShareByID($params);
        }
    }
?>