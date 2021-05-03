<?php
require_once "classes/DBManager.php";
require_once "models/QuestionModel.php";

$QuesModel = new QuestionModel();
$result = $QuesModel->getConfirmQuestion();

?>

<head>
    <?php include("components/header.php"); ?>
    <link href="assets/css/question.css" rel="stylesheet">
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
                        <div class="toppic">คำถามเกี่ยวกับ Use Case Diagram</div>
                        <div class="toppic-1  mt-1 mb-6">คุณก็สามารถตั้งคำถามได้
                            <?php if ($userid_session > 0) { ?>
                                <button type="button" class="btn pt-0 pb-0 pl-1 pr-1" style="background-color: #000000;">
                                    <a href="<?= $userid_session > 0 ? 'question_form.php' : '#Cant_ask_question' ?>">
                                        <div class="bt" style="color: #ffffff; font-family: 'Poppins';">Click to question</div>
                                    </a>
                                </button>
                            <?php } ?>
                            <?php if ($userid_session <= 0) { ?>
                                <button type="button" class="btn btn-dark pt-0 pb-0 pl-1 pr-1 ">
                                    <a href="#Cant_ask_question" onclick="Clicktoask()">
                                        <div class="bt" style="color: #ffffff; font-family: 'Poppins';">Click to question</div>
                                    </a>
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                    <div style="overflow-x:auto;" class="pt-6">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Topic</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $row) { ?>
                                    <tr>
                                        <td><?= $row["question_topic"] ?></td>
                                        <td><?= $row["date"] ?> </td>

                                        <td>
                                            <a href="user_question.php?question_id=<?= $row["question_id"] ?> ">
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
    <script>
        function Clicktoask() {
                alert('please login for ask');
        }
    </script>

</body>

</html>