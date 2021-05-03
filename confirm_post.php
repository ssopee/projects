<?php
require_once "classes/DBManager.php";
require_once "models/ShareModel.php";

$ShareModel = new ShareModel();
$result = $ShareModel->getAllShare();
print_r($result[1]['confirm_post']);

?>


<head>
    <?php include("components/header.php"); ?>
    <link href="assets/css/confirm_post.css" rel="stylesheet">
</head>

<body>
    <?php include("components/manu.php"); ?>
    <div class="container">
        <div class="row" style="place-content: center;">
            <div style="height:100vh"> </div>
            <div class="col-lg-8 backgroundcolor">
                <div class="plpr">
                    <div class="top">

                        <img src="assets/img/icon_share.png" class="mr-3 mb-1 imgquestion" style="float: left;">
                        <div class="toppic" style="font-weight: 500;font-family: 'Poppins';">Confirm Share</div>
                        <p class="toppic-1  mt-1 mb-6">ตรวจสอบการแบ่งปัน Use Case Diagram
                        </p>

                        <div style="overflow-x:auto;" class="pt-6">
                            <table class="table table-hover">
                                <thead>

                                    <tr>
                                        <th>Use Case Name</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < sizeof($result); $i++) { ?>
                                        <?php if ($result[$i]["confirm_post"] == "") { ?>
                                            <tr>
                                                <td><?= $result[$i]["use_case_name"] ?></td>
                                                <td><?= $result[$i]["date"] ?></td>
                                                <td>
                                                    <a href="confirm_post_detail.php?share_id=<?= $result[$i]["share_id"] ?> ">
                                                        <button type="button" class="btn pt-1 pb-1" style="background-color: #000000;">
                                                            <p class="view mb-0" style="color: #ffffff;">View </p>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>

                                </tbody>



                            </table>
                        </div>






                    </div>

                </div>

            </div>



        </div>
    </div>


    <script>
        function Clicktoask() {
            alert('please login for share');
        }
    </script>
</body>

</html>