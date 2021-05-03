
<head>
    <?php include("components/header.php"); ?>
    <link href="assets/css/user_question.css" rel="stylesheet">
    <script src="assets/js/day.min.js"></script>
</head>

<?php
require_once "classes/DBManager.php";
require_once "models/QuestionModel.php";
require_once "models/CommentModel.php";

$question_id = isset($_GET["question_id"]) ? $_GET["question_id"] : "";
$params = array();
$params["question_id"] = $question_id;
$params["user_id"] = $userid_session;
$questionModel = new QuestionModel();
$CommentModel = new CommentModel();
$result = $questionModel->getQuestionById($question_id);
$resultComment = $CommentModel->getAllCommentAndLikeByQuestion($params);
?>


<body>
    <?php include("components/manu.php"); ?>

    <div class="container">
        <div class="row" style="place-content: center;">
            <div style="height:100vh"> </div>
            <div class="col-lg-8 backgroundcolor">
                <div class="plpr top">
                    <img src="assets/img/icon_questionmark.png" class="mb-1 imgshare" style="float: left;">
                    <div class="toppic"></div>
                    <div >

                        <div class="toppic" >
                            <?= $result[0]["question_topic"] ?>

                            <?php if ($userid_session == $result[0]["user_id"] || $userid_session == 1 ) { ?>
                                <div class="dropdown" style="float: right ;margin-top: 0px;">
                                    <i onclick="myFunction(1)" class="bth fa fa-bars dropbtn" aria-hidden="true"></i>
                                    <div id="myDropdown-1" class="dropdown-content textbox-1">

                                        <a href="#" onclick="editQuestion()"><i class="fa fa-pencil-square-o" style="padding-right: 6px;"></i>Edit</a>
                                        <a href="#" onclick="deleteQuestion()"><i class="fa fa-trash" aria-hidden="true" style="padding-right: 6px;"></i>Delete</a>

                                    </div>
                                </div>
                            <?php } ?>


                        </div>
                    </div>
                    <div class="toppic-1">
                        <span>Date : </span>
                        <span><?= $result[0]["date"] ?> </span>
                        <span>By</span>
                        <span><?= $result[0]["username"] ?></span>
                    </div>

                    <hr>
                    <?php if (isset($result[0]["image"]) && $result[0]["image"] != "") { ?>
                        <img src="uploads/question/<?= $result[0]["user_id"] ?>/<?= $result[0]["image"] ?>" class="rounded mx-auto d-block" style="width: 30%;">
                    <?php } ?>
                    <h2 id="question-show" class="dotted  description" ><?= $result[0]["description"] ?></h2>
                    <div id="question-edit-layer" class="text-right" style="display:none;margin-top: 20px;">
                        <textarea class="form-control mb-3"  id="question-edit" name="" cols="30" rows="3"><?= $result[0]["description"] ?></textarea>
                        <button onclick="saveQuestion()" class="btn btn-dark " style="background-color: #000000;padding-top: 3px;padding-bottom: 3px;padding-left: 12px;">Save</button>
                    </div>
                    <hr style="margin-bottom: 10px;">
                    <img src="assets/img/icons_comment.png" class="icomment">
                    <h2 class="comment">Comment</h2>
                    <hr style="margin-top: 10px;margin-bottom: 10px;">


                    <div class="content-item pt-0" id="comments" style="box-shadow: none;">

                        <!-- COMMENT 1 - START -->
                        <div id="comment-section">
                            <?php for ($i = 0; $i < sizeof($resultComment); $i++) {
                                $com_id = $resultComment[$i]["comment_id"];
                            ?>
                                <div class="media box" id="comment-section-<?= $com_id ?>" style="border-top: outset; padding: 10px ;margin-bottom: 8px">
                                    <img src="assets/img/icon_user.png" class="iuser">
                                    <div class="ml-6">
                                        <h4 class="media-heading textbox">
                                            <?= $resultComment[$i]["username"] ?>
                                            <?php if ($userid_session == $resultComment[$i]["user_id"] || $userid_session == 1 ) { ?>
                                                <div class="dropdown" style="float: right ;bottom: 10px;">
                                                    <i onclick="myFunction(<?= $com_id ?>)" class="fa fa fa-ellipsis-h dropbtn " aria-hidden="true"></i>
                                                    <div id="myDropdown-<?= $com_id ?>" class="dropdown-content textbox-1">
                                                        <a href="#editComment" onclick="editComment(<?= $com_id ?>)"><i class="fa fa-pencil-square-o" style="padding-right: 6px;height: 15px;margin-top: 4px;"></i>Edit</a>
                                                        <a href="#deleteComment" onclick="deleteComment(<?= $com_id ?>)"><i class="fa fa-trash" aria-hidden="true" style="padding-right: 6px;height: 15px;margin-top: 4px;"></i>Delete</a>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </h4>
                                        <div  class="textbox-1" id="comment-show-<?= $com_id ?>"><?= $resultComment[$i]["user_comment"] ?></div>
                                        <div id="comment-edit-layer-<?= $com_id ?>" class="text-right" style="display:none;">
                                            <textarea class="form-control mb-3" id="comment-edit-<?= $com_id ?>" name="" cols="30" rows="3" style="font-size: 16px;"><?= $resultComment[$i]["user_comment"] ?></textarea>
                                            <button onclick="saveComment(<?= $com_id ?>)" class="btn btn-dark " style="background-color: #000000;padding-top: 2px;padding-bottom: 2px;padding-left: 6px;margin-top: 0px;margin-bottom: 15px;padding-right: 6px;">Save</button>
                                        </div>
                                        <ul class="list-unstyled list-inline pull-left mb-0" >
                                            <li style="display: inline-flex;" class="idate"><i class="fa fa-calendar"></i>&nbsp;<?= $resultComment[$i]["date"] ?></li>
                                            <li style="display: inline-flex;" class="idate-1">
                                                <i id="thumbs-up-<?= $com_id ?>" class="fa fa-thumbs-up" style="<?= $resultComment[$i]["like_id"] > 0 ? "color: blue" : "" ?>"></i>&nbsp;
                                                <span id="count-comment-<?= $com_id ?>"><?=$resultComment[$i]["count_comment"]>0 ? $resultComment[$i]["count_comment"] : 0 ?></span>
                                            </li>
                                        </ul>
                                        <ul class="like">
                                            <li class="" style="display: inline-flex;"><a href="#likeButton" onclick="likeButtonClick(event, <?= $com_id ?>)" style="text-decoration: none;"><?= $resultComment[$i]["like_id"] > 0 ? "Unlike" : "Like" ?></a></li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- COMMENT 1 - END -->
                        <div>
                            <fieldset>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-lg-12" style="top: 10px;">
                                        <textarea class="form-control" id="comment-input" placeholder="Your message" required="" style="border-radius: 1rem;border-color: #b8b8c7;"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" onclick="addComment()" class="btn btn-dark pull-right" style=" font-family: 'Poppins';font-size: 15px;margin-top: 10px;background-color: #000000;border-color: #000000;width: 82px;padding-top: 3px;padding-bottom: 3px;padding-left: 10px;padding-right: 10px;margin-bottom: 20.;margin-bottom: 30px;">Submit</button>
                        </div>

                    </div>
                </div>


                <div class="col"></div>
            </div>
        </div>
    </div>


    <!-- Print -->
    <script>
        var userId = <?= $userid_session ?>;
        var username = '<?= $username_session ?>';

        function printImg(url) {
            var win = window.open('');
            win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
            win.focus();
        }

        function editQuestion() {
            var qEditElemLayer = document.getElementById('question-edit-layer');
            var qShowElem = document.getElementById('question-show');
            qEditElemLayer.style.display = 'block';
            qShowElem.style.display = 'none';
            //scroll to new comment
            $('html, body').animate({
                scrollTop: $('#question-edit-layer').offset().top - 200
            }, 1000);
        }

        function saveQuestion() {
            var qEditElemLayer = document.getElementById('question-edit-layer');
            var qEditElem = document.getElementById('question-edit');
            var qShowElem = document.getElementById('question-show');
            if (qEditElem.value != "") {
                $.ajax({
                    url: 'controllers/QuestionController.php',
                    method: 'POST',
                    data: {
                        'question_desc': qEditElem.value,
                        'question_id': '<?= $question_id ?>',
                        'service': 'update'
                    },
                    success: function() {
                        console.log('update success');
                    }
                });

                qShowElem.innerText = qEditElem.value;
                qEditElemLayer.style.display = 'none';
                qShowElem.style.display = 'block';
            } else {
                alert('please edit');
            }
        }

        function deleteQuestion() {
            var confirmValue = confirm('Are you sure to delete ?');
            if (confirmValue) {
                //send to DB for delete
                $.ajax({
                    url: 'controllers/QuestionController.php',
                    method: 'POST',
                    data: {
                        'question_id': '<?= $question_id ?>',
                        'image_name' : '<?= $result[0]["image"] ?>',
                        'user_id' :'<?= $result[0]["user_id"] ?>',
                        'service': 'delete'
                    },
                    success: function() {
                        window.location.href = 'question.php'; //redirect page
                    }
                });
            }
        }

        function editComment(id) {
            var cEditElemLayer = document.getElementById('comment-edit-layer-' + id);
            var cShowElem = document.getElementById('comment-show-' + id);
            cEditElemLayer.style.display = 'block';
            cShowElem.style.display = 'none';
            
        }

        function saveComment(id) {
            var cEditElemLayer = document.getElementById('comment-edit-layer-' + id);
            var cEditElem = document.getElementById('comment-edit-' + id);
            var cShowElem = document.getElementById('comment-show-' + id);
            if (cEditElem.value != "") {
                $.ajax({
                    url: 'controllers/CommentController.php',
                    method: 'POST',
                    data: {
                        'user_comment': cEditElem.value,
                        'comment_id': id,
                        'service': 'updateComment'
                    },
                    success: function() {
                        console.log('update success');
                    }
                });

                cShowElem.innerText = cEditElem.value;
                cEditElemLayer.style.display = 'none';
                cShowElem.style.display = 'block';
            } else {
                alert('please comment');
            }
        }

        function deleteComment(id) {
            var cElemSection = document.getElementById('comment-section-' + id);
            var confirmValue = confirm('Are you sure to delete comment ?');
            if (confirmValue) {
                //send to DB for delete
                $(cElemSection).fadeOut('slow')
                $.ajax({
                    url: 'controllers/CommentController.php',
                    method: 'POST',
                    data: {
                        'comment_id': id,
                        'service': 'deleteComment'
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });

            }
        }

        function likeButtonClick(event, id) {
            if (userId > 0) {
                var thumbsupElem = document.getElementById(`thumbs-up-${id}`);
                var targetElem = event.target;
                var countcommentElem = document.getElementById(`count-comment-${id}`);   //<span>2</span>
                var countCommentValue = parseInt(countcommentElem.innerText); // 2
                if (targetElem.innerText == 'Like') {
                    $.ajax({
                        url: 'controllers/LikeController.php',
                        method: 'POST',
                        data: {
                            'user_id': userId,
                            'comment_id': id,
                            'service': 'Like'
                        },
                        success: function(data) {
                            thumbsupElem.style.color = 'blue';
                            targetElem.innerText = 'Unlike';
                            countCommentValue = countCommentValue + 1; //3
                            countcommentElem.innerText = countCommentValue;
                        }
                    });
                } else {
                    $.ajax({
                        url: 'controllers/LikeController.php',
                        method: 'POST',
                        data: {
                            'user_id': userId,
                            'comment_id': id,
                            'service': 'Delete'
                        },
                        success: function(data) {
                            thumbsupElem.style.color = '#666666';
                            targetElem.innerText = 'Like';
                            countCommentValue = countCommentValue - 1; //3
                            countcommentElem.innerText = countCommentValue;
                        }
                    });


                }
            } else {
                alert('please login for like');
            }

        }

        function myFunction(id) {
            closeDropdown();
            document.getElementById('myDropdown-' + id).classList.toggle("show");
        }

        function closeDropdown() {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                closeDropdown();
            }
        }

        function addComment() {
            if (userId > 0) {
                var addCommentElem = document.getElementById('comment-input');
                var commentSectionElem = document.getElementById('comment-section');
                var commentValue = addCommentElem.value;
                var commentDate = dayjs().format('DD-MM-YYYY');
                if (commentValue != "") {
                    $.ajax({
                        url: 'controllers/CommentController.php',
                        method: 'POST',
                        data: {
                            'user_id': userId,
                            'question_id': '<?= $question_id ?>',
                            'date': commentDate,
                            'user_comment': commentValue,
                            'service': 'insertCommentQuestion'
                        },
                        success: function(data) {
                            var lastId = data;
                            var html = `<div class="media box" id="comment-section-${lastId}" style="border-top: outset; padding: 10px ;margin-bottom: 8px">
                                            <img src="assets/img/icon_user.png" alt="" class="iuser">
                                            <div class="ml-6">
                                                <h4 class="media-heading textbox">
                                                    ${username}
                                                    <div class="dropdown" style="float: right ;bottom: 10px;">
                                                        <i onclick="myFunction(${lastId})" class="fa fa fa-ellipsis-h dropbtn " aria-hidden="true"></i>
                                                        <div id="myDropdown-${lastId}" class="dropdown-content textbox-1">
                                                            <a href="#editComment" onclick="editComment(${lastId})"><i class="fa fa-pencil-square-o" style="padding-right: 6px;height: 15px;margin-top: 4px;"></i>Edit</a>
                                                            <a href="#deleteComment" onclick="deleteComment(${lastId})"><i class="fa fa-trash" aria-hidden="true" style="padding-right: 6px;height: 15px;margin-top: 4px;"></i>Delete</a>
                                                        </div>
                                                    </div>
                                                </h4>
                                                <div class="textbox-1" id="comment-show-${lastId}">${commentValue}</div>
                                                <div id="comment-edit-layer-${lastId}" class="text-right" style="display:none;">
                                                    <textarea class="form-control mb-3" id="comment-edit-${lastId}" name="" cols="30" rows="3" style="font-size: 16px;">${commentValue}</textarea>
                                                    <button onclick="saveComment(${lastId})" class="btn btn-dark " style="background-color: #000000;padding-top: 2px;padding-bottom: 2px;padding-left: 6px;margin-top: 0px;margin-bottom: 15px;padding-right: 6px;">Save</button>
                                                </div>
                                                <ul class="list-unstyled list-inline pull-left mb-0">
                                                    <li style="display: inline-flex;" class="idate"><i class="fa fa-calendar"></i>&nbsp;${commentDate}</li>
                                                    <li style="display: inline-flex;" class="idate-1">
                                                         <i id="thumbs-up-${lastId}" class="fa fa-thumbs-up"></i>&nbsp;
                                                        <span id="count-comment-${lastId}">0</span>
                                                    </li>
                                                </ul>
                                                <ul class="like">
                                                <li class="" style="display: inline-flex;"><a href="#likeButton" onclick="likeButtonClick(event, ${lastId})" style="text-decoration: none;">Like</a></li>
                                                </ul>
                                            </div>
                                        </div>`
                            commentSectionElem.insertAdjacentHTML('afterbegin', html);
                            addCommentElem.value = '';
                            //scroll to new comment
                            $('html, body').animate({
                                scrollTop: $(`#comment-section-${lastId}`).offset().top - 200
                            }, 1000);

                        }
                    });
                } else {
                    alert('please comment');
                }
            } else {
                alert('please login for comment');
            }
        }


    </script>


</body>

</html>