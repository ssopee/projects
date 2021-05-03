<?php
require_once "classes/DBManager.php";
require_once "models/ShareModel.php";

$ShareModel = new ShareModel();
$result = $ShareModel->getConfirmShare();

?>


<head>
    <?php include("components/header.php"); ?>
    <link href="assets/css/share.css" rel="stylesheet">
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
                        <div class="toppic">แบ่งปัน Use Case Diagram</div>
                        <div class="toppic-1  mt-1 mb-6">คุณก็สามารถแบ่งปันได้
                            <?php if ($userid_session > 0) { ?>
                                <button type="button" class="btn btn-dark pt-0 pb-0 pl-1 pr-1 " <?= $userid_session > 0 ? '' : 'disabled' ?> style="background-color: #000000;">
                                    <a href="<?= $userid_session > 0 ? 'share_form.php' : '#notshare' ?>">
                                        <div class="bt" style="color: #ffffff; font-family: 'Poppins';">Click to share</div>
                                    </a>
                                </button>
                                </h3>
                            <?php } ?>

                            <?php if ($userid_session <= 0) { ?>
                                <button type="button" class="btn btn-dark pt-0 pb-0 pl-1 pr-1">
                                    <a href="#notshare" onclick="Clicktoask()">
                                        <div class="bt" style="color: #ffffff; font-family: 'Poppins';">Click to share</div>
                                    </a>
                                </button>
                                </h3>
                            <?php } ?>
                        </div>

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
                                    <?php foreach ($result as $row) { ?>
                                        <tr>
                                            <td><?= $row["use_case_name"] ?></td>
                                            <td><?= $row["date"] ?></td>
                                            <td>
                                                <a href="user_share.php?share_id=<?= $row["share_id"] ?> ">
                                                    <button type="button" class="btn pt-1 pb-1" style="background-color: #000000;">
                                                    <p class="view mb-0" style="color: #ffffff;">View </p>
                                                </button>
                                                </a>
                                            </td>
                                        </tr>
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