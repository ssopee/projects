<?php
require_once "classes/DBManager.php";
require_once "models/CategoryModel.php";

$catModel = new CategoryModel();
$result = $catModel->getAllCategory();
?>

<head>
    <?php include("components/header.php"); ?>
    <link href="assets/css/usecase_category.css" rel="stylesheet">
</head>

<body>
    <?php include("components/manu.php"); ?>
    <div class="container">
        <div class="row" style="place-content: center;">
            <div style="height:100vh"></div>
            <div class="col-lg-8 backgroundcolor">
                    <div class="plpr">
                    <div class="top">
                        <img src="assets/img/search1.png"  class="mr-3 mb-1 imgusecase" style="float: left;">
                        <h4 class="toppic" style="font-family:'Poppins'">Use Case Diagram</h4>
                        <p class="toppic-1  mt-1 mb-6"> รวบรวม Use Case Diagram แบ่งเป็นหมวดหมู่ของระบบต่าง ๆ </p>
                    </div>
                    <input class="form-control" id="myInput" type="text" placeholder="Search...">
                    <br>
                    <ul class="list-group mb-5" id="myList">
                        <?php for ($i = 0; $i < sizeof($result); $i++) { ?>
                            <li class="list-group-item nav-menu ">
                                <a href="usecase_list.php?category_id=<?= $result[$i]["category_id"] ?>">
                                    <p class="mb-0"> <?= $result[$i]["category_name"] ?> </p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myList li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>