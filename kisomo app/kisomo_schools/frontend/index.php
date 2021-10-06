<?php
include ('indexCheck.php');
?>
<!DOCTYPE html>
<head>
    <title>Kisomo</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <link rel="stylesheet" href="assets/css/app.css"/>
</head>
<body>
    <div class="s-container-wrapper">
        <div class="sign-in-contaner">
            <div class="sign-in-logo">
                <img src="assets/img/kisomoicon.png">
            </div>
            <div class="welc-kisomo">WELCOME TO KISOMO</div>
            <div class="sign-in-box">
                <div class="input-group">
                    <input type="text" id="username-sign-input-txt" class='sign-input-txt' placeholder="Your login ID"/>
                    <input type="password" id="passwd-sign-input-txt" class='sign-input-txt' placeholder="Your password"/>
                    <div class="message signin-message"></div>
                    <div class="wrapp-sign-btn"><div class="sign-btn" id="index-sign-btn">Sign in</div></div>

                    <!-- <div class="signup-box">
                        <div class="signup-txt">Don't have account?</div>
                        <div class="signup-link"><a href="http://localhost/kisomo%20app/kisomo_schools/frontend/pages/signup">signup</a></div>
                    </div>
                    <div class="signup-box pay-box">
                         <div class="signup-link pay-link"><a href="http://localhost/kisomo%20app/kisomo_schools/frontend/pages/pay">how to make payment</a></div>
                    </div> -->
                    

                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.js" type='text/javascript' ></script>
    <script type="text/javascript" src="assets/js/jquery-cookie/jquery.cookie.js"></script>
    <script src="assets/js/app.js" type='text/javascript'></script>
</body>
</html>