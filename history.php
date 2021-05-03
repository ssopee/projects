<head>
    <?php include("components/header.php"); ?>
    <link href="assets/css/history.css" rel="stylesheet">
</head>


<?php
require_once "classes/DBManager.php";
require_once "models/QuestionModel.php";
require_once "models/ShareModel.php";
require_once "models/BookmarkModel.php";
require_once "models/CommentModel.php";

$type = isset($_GET["type"]) ? $_GET["type"] : "Question";
$result = array();
$topicName = "";
$link = "";

if ($type == "Share") {
    $ShareModel = new ShareModel();
    $result = $ShareModel->getShareByUserId($userid_session);
    $topicName = "Use Case Name";
    $link = "user_share.php?share_id=";
} else if ($type == "Comment") {
    $CommentModel = new CommentModel();
    $result = $CommentModel->getCommentHistory($userid_session);
    $topicName = "Comment";
    $link = "usecase_detail.php?usecase_id=";
} else if ($type == "Answer") {
    $CommentModel = new CommentModel();
    $result = $CommentModel->getCommentQuestionHistory($userid_session);
    $topicName = "Answer";
    $link = "user_question.php?question_id=";
} else if ($type == "Bookmarks") {
    $BookmarkModel = new BookmarkModel();
    $result = $BookmarkModel->getBookmarkHistory($userid_session);
    $topicName = "Use Case Name";
    $link = "usecase_detail.php?usecase_id=";
} else {
    $QuesModel = new QuestionModel();
    $result = $QuesModel->getQuestionByUserId($userid_session);
    $topicName = "Question topic";
    $link = "user_question.php?question_id=";
}
?>

<body></body>
<?php include("components/manu.php"); ?>

<div class="container">
    <div class="row" style="place-content: center;">
        <div style="height:100vh"></div>
        <div class="col-lg-8 backgroundcolor">
            <div class="plpr">
                <div class="top">
                    <div>
                        <img src="assets/img/icon_history.png" class="mr-3 mb-1 imghistory">
                        <h4 class="toppic" style="font-family:'Poppins'">History</h4>
                        <p class="toppic-1  mt-1 mb-6">ประวัติการดำเนินการบนเว็บไซต์</p>
                    </div>
                    <div class="toppic-2 ">
                        <span><a href="history.php"><button type="button" class="btn btn-dark Historylist">
                                    <div class="fs">Question</div>
                                </button></a></span>
                        <span><a href="history.php?type=Share"><button type="button" class="btn btn-dark Historylist">
                                    <div class="fs">Share</div>
                                </button></a></span>
                        <span><a href="history.php?type=Comment"><button type="button" class="btn btn-dark Historylist">
                                    <div class="fs">Comment</div>
                                </button></a></span>
                        <span><a href="history.php?type=Answer"><button type="button" class="btn btn-dark Historylist">
                                    <div class="fs">Answer</div>
                                </button></a></span>
                        <span> <a href="history.php?type=Bookmarks"><button type="button" class="btn btn-dark Historylist">
                                    <div class="fs">Bookmarks</div>
                                </button></a></span>
                    </div>

                    <nav class="nav-menu mt-6" style="overflow-x:auto;">
                        <h1 class="toppic-2 "><?= $type ?></h1>
                        <table class="table table-hover" style="text-align: left;">
                            <thead>
                                <tr>
                                    <th class="toppic-3 p-6" width="70%"><?= $topicName ?></th>
                                    <th class="toppic-3 p-6" width="20%">Date</th>
                                    <th class="toppic-3" width="10%"></th>
                                </tr>
                            </thead>
                            <tbody class="toppic-4">
                                <?php for ($i = 0; $i < sizeof($result); $i++) { ?>
                                    <tr>
                                        <td><?= $result[$i]["topic"] ?></td>
                                        <td><?= $result[$i]["date"] ?></td>
                                        <?php
                                        if ($type == "Bookmarks" || $type == "Comment") {
                                            if ($result[$i]["usecase_id"] != "") {
                                                $link = "usecase_detail.php?usecase_id=";
                                                $result[$i]["id"] = $result[$i]["usecase_id"];
                                            } else {
                                                $link = "user_share.php?share_id=";
                                                $result[$i]["id"] = $result[$i]["share_id"];
                                            }
                                        }
                                        ?>

                                        <td>
                                            <a href="<?= $link . $result[$i]["id"] ?>" style="font-family:Prompt, sans-serif;font-weight: 400;color: #ffffff;padding-left: 0px;padding-right: 0px;font-size: 14px;">
                                                <button type="button" class="btf btn btn-dark " style="background-color: #000000;border-color: #000000;font-family: 'Poppins';">
                                                    View
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </nav>
                </div>
            </div>
        </div>

    </div>

</div>





</body>

</html>