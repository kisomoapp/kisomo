<?php
?>
<!DOCTYPE html>
<head>
    <title>Kisomo::Quiz</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <link rel="stylesheet" href="../assets/css/app.css"/>
</head>
<body>
    <div class="home-container">
        <?php include('header.php'); ?>
        <div class="contents-container">
            <div class="content-wrapper">
                <div class="wrap-quiz hide-element">
                    
                    <div class="quiz-mark-box">
                        <div class="quiz-mark-title">Result</div>
                        <div class="mark-box"></div>
                        <div class="remark"></div>
                    </div> <br>
                    <div class="correction-title"><u>Correction</u></div>
                    <ul class="qn-s-list">
                            <!-- <li class="qn-in-s">
                                <div class="qn-s-contents">
                                    <div class="qn-s-no">
                                        Question 1:
                                    </div>
                                    <div class="qn-s-content">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea officiis possimus commodi cum
                                         ex repellat?
                                    </div>
                                </div>
                                <div class="qn-s-contents">
                                        <div class="qn-s-no qn-s-ans">
                                            Answer
                                        </div>
                                        <div class="qn-s-content">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        </div>
                                </div>
                            </li> -->
                            
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