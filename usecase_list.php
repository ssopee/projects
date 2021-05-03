<?php
require_once "classes/DBManager.php";
require_once "models/UsecaseModel.php";

$category_id = isset($_GET["category_id"]) ? $_GET["category_id"] : -1;
$UsecaseModel = new UsecaseModel();
$result = $UsecaseModel->getUsecaseByCategoryId($category_id);
?>



<head>
    <?php include("components/header.php"); ?>
    <link href="assets/css/usecase_list.css" rel="stylesheet">
    <style>
        img {
            float: left;
        }
    </style>
</head>

<body>
    <?php include("components/manu.php"); ?>
    <div class="container">
        <div class="row" style="place-content: center;">
            <div style="height:100vh"></div>
            <div class="col-lg-8 backgroundcolor">
                <div class="plpr">
                    <div class="top">
                        <img src="assets/img/icon_category/<?= $result[0]["icon"] ?>" class="mr-1 imglist" style="float: left;">
                        <h4 class="toppic" style="font-family:'Poppins'"><?= $result[0]['category_name']  ?> </h4>
                        <p class="toppic-1  mt-1 mb-6"> รวบรวม Use Case Diagram พร้อมแหล่งที่มา </p>
                        <div class="mtpt">
                            <ul class="list-group" id="myList">
                                <?php for ($i = 0; $i < sizeof($result); $i++) { ?>
                                    <li class="list-group-item nav-menu">
                                        <a href="usecase_detail.php?usecase_id=<?= $result[$i]["usecase_id"] ?>">
                                            <p class="mb-0"><?= $result[$i]["usecase_name"] ?> </p>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>