<head>
    <?php include("components/header.php"); ?>
    <link rel="stylesheet" href="assets/css/starDropdown.css">
    <link href="assets/css/usecase_detail.css" rel="stylesheet">
    <script src="assets/js/day.min.js"></script>

</head>

<?php
require_once "classes/DBManager.php";
require_once "models/UsecaseModel.php";
require_once "models/BookmarkModel.php";
require_once "models/ReviewModel.php";
require_once "models/CommentModel.php";

$usecase_id = isset($_GET["usecase_id"]) ? $_GET["usecase_id"] : -1;
$params = array();
$params["usecase_id"] = $usecase_id;
$params["user_id"] = $userid_session;

$UsecaseModel = new UsecaseModel();
$bookmarkModel = new BookmarkModel();
$reviewModel = new ReviewModel();
$CommentModel = new CommentModel();

$result = $UsecaseModel->getUsecaseById($usecase_id);
$resultBookmark = $bookmarkModel->getBookmarkUsecaseByID($params);
$resultReview = $reviewModel->getReviewByUsecaseAndUser($params);
$resultAvg = $reviewModel->getAvgScoreAndSum($usecase_id);
$resultComment = $CommentModel->getAllCommentAndLikeByUseCase($params);
?>

<body>
    <?php include("components/manu.php"); ?>
    <div class="container">
        <div class="row" style="place-content: center;">
            <div style="height:100vh"> </div>
            <div class="col-lg-8 backgroundcolor">
                <div class="plpr top">
                    <img src="assets/img/icon_category/<?= $result[0]["icon"] ?>" class="mb-1 imgshare" style="float: left;">
                    <div class="toppic">

                        <?= $result[0]['usecase_name']  ?>

                        <div class="dropdown" style="float: right ;margin-top: 0px;">

                            <i onclick="myFunction(1)" class="bth fa fa-bars dropbtn" aria-hidden="true"></i>

                            <div id="myDropdown-1" class="dropdown-content textbox-2">
                                <a href="#" onclick="printImg('assets/img/usecase/<?= $result[0]["image"] ?>')"><i class="fa fa-print" style="padding-right: 6px;height: 15px;margin-top: 4px;"></i>Print</a>
                                <a href="<?= $result[0]["ref_link"] ?>" target="_blank"><i class="fa fa-picture-o" aria-hidden="true" style="padding-right: 6px;height: 15px;margin-top: 4px;"></i>Source</a>
                                <a href="assets/img/usecase/<?= $result[0]["image"] ?>" download><i class="fa fa-download" style="padding-right: 6px;height: 15px;margin-top: 4px;"> </i>Download</a>
                                <?php if ($userid_session > 0) { ?>
                                    <a href="#" onclick="saveBookmark()"><i id="bookmark-icon" class="fa <?= sizeof($resultBookmark) > 0 ? "fa-bookmark" : "fa-bookmark-o" ?>" style="padding-right: 6px;height: 15px;margin-top: 4px;"></i>Bookmarks</a>
                                <?php } ?>
                            </div>
                        </div>


                        <div class="row justify-content-left ">
                            <div class=" stars pl-0">
                                <input class="star star-5" id="star-5" type="radio" name="star" <?= !empty($resultReview) && $resultReview[0]["score"] == 5 ? "checked" : "" ?> onchange="clickStar(event, 5)" />
                                <label class="star star-5" for="star-5" style="cursor: pointer;"></label>
                                <input class="star star-4" id="star-4" type="radio" name="star" <?= !empty($resultReview) && $resultReview[0]["score"] == 4 ? "checked" : "" ?> onchange="clickStar(event, 4)" />
                                <label class="star star-4" for="star-4" style="cursor: pointer;"></label>
                                <input class="star star-3" id="star-3" type="radio" name="star" <?= !empty($resultReview) && $resultReview[0]["score"] == 3 ? "checked" : "" ?> onchange="clickStar(event, 3)" />
                                <label class="star star-3" for="star-3" style="cursor: pointer;"></label>
                                <input class="star star-2" id="star-2" type="radio" name="star" <?= !empty($resultReview) && $resultReview[0]["score"] == 2 ? "checked" : "" ?> onchange="clickStar(event, 2)" />
                                <label class="star star-2" for="star-2" style="cursor: pointer;"></label>
                                <input class="star star-1" id="star-1" type="radio" name="star" <?= !empty($resultReview) && $resultReview[0]["score"] == 1 ? "checked" : "" ?> onchange="clickStar(event, 1)" />
                                <label class="star star-1" for="star-1" style="padding-left: 0px;cursor: pointer;"></label>
                            </div>
                            <div class="calign-items-center d-flex pl-0 avg">
                                <span id="avg-text"><?= number_format($resultAvg[0]["avg_score"], 1) ?>/5 </span>&nbsp;
                                <span id="count-text">(<?= $resultAvg[0]["count"] ?> คน)</span>
                            </div>

                        </div>

                    </div>
                    <hr class="hr-1">
                    <img src="assets/img/usecase/<?= $result[0]["image"] ?>" class="rounded mx-auto d-block" style="width: 70%;">
                    <hr style="margin-bottom: 10px;">
                    <img src="assets/img/icon_chat.png" class="icomment">
                    <h2 class="comment">Comment</h2>
                    <hr style="margin-top: 10px;margin-bottom: 0px;">


                    <div class="content-item" id="comments" style="box-shadow: none;padding-top: 15px;">

                        <!-- COMMENT 1 - START -->
                        <div id="comment-section">
                            <?php for ($i = 0; $i < sizeof($resultComment); $i++) {
                                $com_id = $resultComment[$i]["comment_id"];
                            ?>
                                <div class="media box" id="comment-section-<?= $com_id ?>" style="border-top: outset; padding: 10px ;margin-bottom: 8px">
                                    <img src="assets/img/icon_user.png" alt="" class="iuser">
                                    <div class="ml-6">
                                        <h4 class="media-heading textbox">
                                            <?= $resultComment[$i]["username"] ?>
                                            <?php if ($userid_session == $resultComment[$i]["user_id"] || $userid_session == 1) { ?>
                                                <div class="dropdown" style="float: right ;bottom: 10px;">
                                                    <i onclick="myFunction(<?= $com_id ?>)" class="fa fa fa-ellipsis-h dropbtn "  aria-hidden="true"></i>
                                                    <div id="myDropdown-<?= $com_id ?>" class="dropdown-content textbox-2">
                                                        <a href="#editComment" onclick="editComment(<?= $com_id ?>)"><i class="fa fa-pencil-square-o" style="padding-right: 6px;height: 15px;margin-top: 4px;"></i>Edit</a>
                                                        <a href="#deleteComment" onclick="deleteComment(<?= $com_id ?>)"><i class="fa fa-trash" aria-hidden="true" style="padding-right: 6px;height: 15px;margin-top: 4px;"></i>Delete</a>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </h4>
                                        <div id="comment-show-<?= $com_id ?>" class="textbox-1" ><?= $resultComment[$i]["user_comment"] ?></div>
                                        <div id="comment-edit-layer-<?= $com_id ?>" class="text-right" style="display:none;">
                                            <textarea class="form-control mb-3" id="comment-edit-<?= $com_id ?>" name="" cols="30" rows="3"><?= $resultComment[$i]["user_comment"] ?></textarea>
                                            <button onclick="saveComment(<?= $com_id ?>)" class="btn btn-dark " style="background-color: #000000;padding-top: 3px;padding-bottom: 3px;padding-left: 12px;margin-top: 0px;margin-bottom: 15px;">Save</button>
                                        </div>
                                        <ul class="list-unstyled list-inline pull-left mb-0">
                                            <li style="display: inline-flex;" class="idate"><i class="fa fa-calendar"></i>&nbsp;<?= $resultComment[$i]["date"] ?></li>
                                            <li style="display: inline-flex;" class="idate-1">
                                                <i id="thumbs-up-<?= $com_id ?>" class="fa fa-thumbs-up" style="<?= $resultComment[$i]["like_id"] > 0 ? "color: blue" : "" ?>"></i>&nbsp;
                                                <span id="count-comment-<?= $com_id ?>"><?= $resultComment[$i]["count_comment"] > 0 ? $resultComment[$i]["count_comment"] : 0 ?></span>
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
                                        <textarea class="form-control" id="comment-input" placeholder="Your message" required="" style="border-radius: 1rem;border-color: #b8b8c7; "></textarea>
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


    <script>
        var hasBookmark = <?= sizeof($resultBookmark) ?>;
        var hasReview = <?= sizeof($resultReview) ?>;
        var userId = <?= $userid_session ?>;
        var username = '<?= $username_session ?>';


        function printImg(url) {
            var win = window.open('');
            win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
            win.focus();
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
                            'usecase_id': '<?= $usecase_id ?>',
                            'date': commentDate,
                            'user_comment': commentValue,
                            'service': 'insertCommentUsecase'
                        },
                        success: function(data) {
                            var lastId = data;
                            var html =  `<div class="media box" id="comment-section-${lastId}" style="border-top: outset; padding: 10px ;margin-bottom: 8px">
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
                                                    <button onclick="saveComment(${lastId})" class="btn btn-dark " style="background-color: #000000;padding-top: 3px;padding-bottom: 3px;padding-left: 12px;margin-top: 0px;margin-bottom: 15px;">Save</button>
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

        function saveBookmark() {
            var service = 'insertUsecase';
            if (hasBookmark > 0) {
                service = 'deleteUsecase'
            }

            $.ajax({
                url: 'controllers/BookmarkController.php',
                method: 'POST',
                data: {
                    'user_id': '<?= $userid_session ?>',
                    'usecase_id': '<?= $usecase_id ?>',
                    'service': service
                },
                success: function() {
                    var bookmarkIconElem = document.getElementById('bookmark-icon');
                    if (service == 'insertUsecase') {
                        hasBookmark = 1;
                        bookmarkIconElem.classList.remove('fa-bookmark-o');
                        bookmarkIconElem.classList.add('fa-bookmark');
                    } else {
                        hasBookmark = 0;
                        bookmarkIconElem.classList.remove('fa-bookmark');
                        bookmarkIconElem.classList.add('fa-bookmark-o');
                    }
                }
            });
        }

        function getAvgScoreAndCount() {
            var avgTextElem = document.getElementById('avg-text');
            var countTextElem = document.getElementById('count-text');

            $.ajax({
                url: 'controllers/ReviewController.php',
                method: 'POST',
                data: {
                    'usecase_id': '<?= $usecase_id ?>',
                    'service': 'getAvg'
                },
                success: function(resp) {
                    var obj = JSON.parse(resp);
                    avgTextElem.innerText = parseFloat(obj[0].avg_score).toFixed(1) + '/5';
                    countTextElem.innerText = '(' + obj[0].count + ' คน)';
                }
            });
        }

        function clickStar(event, score) {
            if (userId <= 0) {
                alert('please login for review');

                var starList = document.getElementsByName('star');
                for (var i = 0; i < starList.length; i++) {
                    starList[i].checked = false;
                }
            } else {
                var service = 'insertUsecase';
                if (hasReview > 0) {
                    service = 'updateUsecase';
                }
                $.ajax({
                    url: 'controllers/ReviewController.php',
                    method: 'POST',
                    data: {
                        'user_id': '<?= $userid_session ?>',
                        'usecase_id': '<?= $usecase_id ?>',
                        'score': score,
                        'service': service
                    },
                    success: function(data) {
                        if (service == 'insertUsecase') {
                            hasReview = 1
                        }
                        getAvgScoreAndCount();
                    }
                });
            }
        }

        function likeButtonClick(event, id) {
            if (userId > 0) {
                var thumbsupElem = document.getElementById(`thumbs-up-${id}`);
                var targetElem = event.target;
                var countcommentElem = document.getElementById(`count-comment-${id}`); //<span>2</span>
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
    </script>

</body>

</html>