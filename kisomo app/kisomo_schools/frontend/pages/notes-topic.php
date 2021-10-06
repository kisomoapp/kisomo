<?php
?>
<!DOCTYPE html>
<head>
    <title>Kisomo::content</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <link rel="stylesheet" href="../assets/css/app.css"/>
    <link rel="stylesheet" href="../assets/css/notes.css"/>
</head>
<body>
    <div class="home-container">
        <?php include('header.php'); ?>
        <div class="contents-container">
            <div class="content-wrapper">
                <div class="s-icon-name">
                </div>
                <div class="s-stream-title section-header">
                    Select stream
                </div>
                <ul class="streams">
                    
                </ul>
                <div class="topics">
                    <div class="topic-in-class hide-element">
                        <div class="t-subject-name"></div>
                        <div class="arrow-separator">  
                            <img src="../assets/img/right-arrow.png" alt="">
                        </div>
                        <div class="t-stream-name"></div>
                        <div class="search-box"><input type="text" placeholder="search topic" id="search-txt"/></div>
                    </div>
                    <ul class="topic-list hide-element">

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery.js" type='text/javascript' ></script>
    <script type="text/javascript" src="../assets/js/jquery-cookie/jquery.cookie.js"></script>
    <script src="../assets/js/app.js" type='text/javascript'></script>
</body>
</html>