<?php 
   require_once '../classes/DBManager.php';
   require_once '../models/ReviewModel.php';

    if(isset($_POST)) {
        $service = isset($_POST["service"])? $_POST["service"]:"";
        $params = $_POST;
        $reviewModel = new ReviewModel();
        
        if($service == 'getAvg') {
            $result = $reviewModel->getAvgScoreAndSum($params["usecase_id"]);
            echo json_encode($result);
        }
        else if($service == "insertUsecase") {
            $reviewModel->insertReviewUsecase($params);
        }
        else if($service == "updateUsecase") {
            $reviewModel->updateReviewUsecase($params);
        }

        //share

        else if($service == 'getShareAvg') {
            $result = $reviewModel->getShareAvgScoreAndSum($params["share_id"]);
            echo json_encode($result);
        }
        else if($service == "insertShare") {
            $reviewModel->insertReviewShare($params);
        }
        else if($service == "updateShare") {
            $reviewModel->updateReviewShare($params);
        }
    }
?>