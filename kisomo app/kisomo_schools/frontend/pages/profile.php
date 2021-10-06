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
             <div class="wrap-profile">
                  <div class="profile-shadow">
                      <div class="profile-edit-box">
                          <div>Edit Profile</div><br>
                          <div>
                              <input type="text" class="student-email-txt" placeholder="set new email"/>
                          </div>
                          <div>
                              <input type="password" class="student-password-txt" placeholder="set new password"/>
                          </div>
                          <div class="message signin-message">
                          </div>
                          <div class="profile-btn edit-save-btn">
                                SAVE
                          </div>
                      </div>
                      <div class="profile-learn-box">
                            <ul>
                            </ul>
                            <br><br><br><br><br>
                        </div>  
                  </div>
                  <div class="profile-content">
                        <div class="profile-title"><b>MY PROFILE</b></div>
                        <div class="username"></div>
                        <div class="edit-profile-btn profile-btn">Edit</div>
                        <div class="learn-title">
                            LEARN DETAILS
                        </div>
                        <div class="learn-details">
                            <div class="quiz-taken underline">Quizzes taken: <div class="quiz-taken-stat">0</div></div>
                            <div class="average-score underline">Average score in quizzes:<div class="quiz-taken-stat-av">0%</div></div>
                            <div class="wrap-view-quiz-btn">
                                <div class="view-scores-btn profile-btn">View quiz scores</div>
                            </div>
                        </div>
                        <div class="logout-btn profile-btn">LOGOUT</div>
                  </div>
             </div>
        </div>
    </div>
    <script src="../assets/js/jquery.js" type='text/javascript' ></script>
    <script type="text/javascript" src="../assets/js/jquery-cookie/jquery.cookie.js"></script>
    <script src="../assets/js/app.js" type='text/javascript'></script>
</body>
</html>