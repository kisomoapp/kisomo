<?php
?>
<!DOCTYPE html>
<head>
    <title>Kisomo</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <link rel="stylesheet" href="../assets/css/app.css"/>
</head>
<body>
    <div class="home-container">
        <?php include('header.php'); ?>
        <div class="contents-container">
            <div class="subject-container hide-element">
                <div class="section-heading">Subjects</div>
                <div class="subj-list">

                </div>
            </div>
            <div class="extra-container hide-element">
                <div class="section-heading">Popular topics</div>
                <div class="course-carousel">
                    <div class="slider">
                        
                    </div>
                    <div class="carousel-controls">
                        <div class="arrow left-arrow ">
                            <img src="../assets/img/left.png"/>
                        </div>
                        <div class="arrow right-arrow">
                            <img src="../assets/img/right.png"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery.js" type='text/javascript' ></script>
    <script type="text/javascript" src="../assets/js/jquery-cookie/jquery.cookie.js"></script>
    <script src="../assets/js/app.js" type='text/javascript'></script>

</body>
</html>