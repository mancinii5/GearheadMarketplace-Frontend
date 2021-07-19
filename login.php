<?php

?>

<html>
<head>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" type="text/css" href="css/log.css">
</head>
<?php include_once('header.php'); ?>
<body style="background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)), url('/assets/images/IMG_1626.jpeg') fixed center no-repeat;
     background-size: cover;">
<div id="loginCard" class="d-flex justify-content-center h-100">
    <div class="card">
        <div class="card-header">
            <div style="text-align: center;"><h3>Login</h3></div>
        </div>
        <div class="card-body">
            <form id="loginTry" method="post" action="loginsplash.php">
                <input type="hidden" id="admin" placeholder="false" name="admin" value="false">
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><img class="img-fluid" src="assets/icons/user.svg"></span>
                    </div>
                    <input type="text" class="form-control" placeholder="email" name="email"/>
                </div>
                </br>
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><img class="img-fluid" src="assets/icons/key.svg"></span>
                    </div>
                    <input type="password" class="form-control" placeholder="password" name="password"/>
                </div>
                </br>
                <div class="row align-items-center remember">
                    <input type="checkbox">Remember Me
                </div>
                <div class="form-group">
                    <input type="submit" value="Login" class="btn float-right login_btn">
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-center links">
                Don't have an account?<a href="signup.php">Sign Up</a>
            </div>
            <div class="d-flex justify-content-center">
                <a href="#">Forgot your password?</a>
            </div>
        </div>
    </div>
</div>
</body>
<?php include_once('footer.php'); ?>
</html>
<script>
    // let backendURL = 'http://0.0.0.0:8000/';
    var status;
    let backendURL = 'https://backend-gearheadmarketplace.herokuapp.com/';
    // console.log(backendURL)
    $("form#loginTry").submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this)
        var convertedData = {}
        //building a compatible data object for our post request
        //{key: value, key: value}
        for(let f of formData.entries()) {
            convertedData[f[0]] = f[1]
        }
        $.ajax({
            type: 'post',
            url: backendURL + 'login/',
            // url: 'https://backend-gearheadmarketplace.herokuapp.com',
            data: JSON.stringify(convertedData),
            dataType: "json",
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
            },
            success: function (data) {
                if(data !="Username or password is wrong") {
                    // Return a dict with user_name, and isAdmin value
                    // console.log(JSON.stringify(data));
                    $('#admin').val(data['isAdmin']);
                    $('form#loginTry').unbind('submit').submit()
                }
            }
        })
    })
</script>