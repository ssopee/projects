<?php
require_once "classes/DBManager.php";
require_once "models/QuestionModel.php";

$QuesModel = new QuestionModel();
$result = $QuesModel->getAllQuestion();

?>

<head>
    <?php include("components/header.php"); ?>
    <link href="assets/css/confirm_qustion.css" rel="stylesheet">
</head>

<body>
    <?php include("components/manu.php"); ?>
    <div class="container">
        <div class="row" style="place-content: center;">
            <div style="height:100vh"> </div>
            <div class="col-lg-8 backgroundcolor">
                <div class="plpr">
                <div class="top">
                        <img src="assets/img/icon_questionmark.png" class="mr-3 mb-1 imgquestion" style="float: left;">
                        <div class="toppic" style="font-weight: 500;font-family: 'Poppins';">Confirm Question</div>
                        <div class="toppic-1  mt-1 mb-6">ตรวจสอบคำถามเกี่ยวกับ Use Case Diagram
                           
                        </div>
                    </div>
                    <div class="pt-6">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Topic</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < sizeof($result); $i++) { ?>
                                    <?php if ($result[$i]["confirm_question"] == "") { ?>
                                        <tr>
                                            <td><?=$result[$i]["question_topic"] ?></td>
                                            <td><?=$result[$i]["date"] ?> </td>

                                            <td>
                                                <a href="confirm_qustion_detail.php?question_id=<?= $result[$i]["question_id"] ?> ">
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
    <script>
        function Clicktoask() {
            alert('please login for ask');
        }
    </script>

</body>

</html>