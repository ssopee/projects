<?php
$errorCode = isset($_GET["error"]) ? $_GET["error"] : 0;
?>

<head>
    <?php include("components/header.php"); ?>
    <link href="assets/css/login.css" rel="stylesheet">
</head>

<body>
    <?php include("components/manu.php"); ?>
    <div class="container">
        <div class="row" style="place-content: center;">
            <div class="col-lg-5 col-sm-7 col-8 backgroundcolor">
                <nav class="nav-menu mt-3">
                    <ul class="pl-0" style="align-items: center;justify-content: center;">

                        <li><a href="login.php">
                                <h4 class="fs">Login </h4>
                            </a></li>
                        <p class="pl-4">
                            <h5>|</h5>
                        </p>
                        <li><a href="register.php">
                                <h4 class="fs">Register</h4>
                            </a></li>
                    </ul>
                </nav>
                <img src="assets/img/Login_ic.png" class="rounded mx-auto d-block imglogin">
                <?php if ($errorCode == 1) { ?>
                    <div class="text-danger pb-1" style="text-align: center;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                        incorrect email or password</div>
                <?php } ?>
                <div class="container">
                    <form role="form" action="controllers/LoginController.php" method="POST">
                        <div class="login-1">
                            <div class="form-group">
                                <h6 class="fs-2">email : </h6>
                                <input type="email" class="form-control fs-1" name="email" id="email" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <h6 class="fs-2">password : </h6>
                                <input type="password" class="form-control fs-1" name="pwd" id="pwd" placeholder="Enter password" required>
                            </div>
                        
                        <div style="text-align: center;"><button type="submit" class="btn btn-dark bts">Submit</button>
                       </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</body>

</html>