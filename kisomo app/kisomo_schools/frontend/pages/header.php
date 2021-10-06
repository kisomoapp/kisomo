<?php
include ('sessionCheck.php');
?>
<div class="header">
    <div class="header-background">
        <img src="../assets/img/KS0015.jpg" alt=""/>
    </div>
    <div class="header-shadow">
        <div class="header-top">
            <div class="logo header-txt-animation">
                <img src="../assets/img/kisomoicon.png"/>
            </div>
            <div class="dash-btn header-txt-animation dash-logout-btn">
                Logout
            </div>
            <div class="greeting header-txt-animation">
            </div>
        </div>
        <div class="header-bottom">
            <div class="back" id="back-to-previous">
                    <img src="../assets/img/backArrowBlue.png" alt="">
            </div>
            <div class="menu">
                <div class="menu-item" id="menu-item-home">
                    <div class="menu-icon">
                        <?php include('home_icon.php'); ?>
                      <!-- <img src="../assets/img/books-stack-of-three.svg" alt=""/> -->
                    </div>
                    <div class="menu-txt" id="home-icon-txt">
                        Home
                    </div>
                </div>
                <div class="menu-item" id="menu-item-news">
                    <div class="menu-icon">
                        <?php include('news_icon.php'); ?>
                        <!-- <img src="../assets/img/news.svg" alt=""/> -->
                    </div>
                    <div class="menu-txt"  id="news-icon-txt">
                        News
                    </div>
                </div>
                <div class="menu-item" id="menu-item-calendar">
                    <div class="menu-icon">
                         <?php include('calendar_icon.php'); ?>
                    </div>
                    <div class="menu-txt"  id="calendar-icon-txt">
                        Calendar
                    </div>
                </div>
                <div class="menu-item" id="menu-item-quiz">
                    <div class="menu-icon">
                        <?php include('quiz_icon.php'); ?>
                    </div>
                    <div class="menu-txt" id="quiz-icon-txt">
                        Notes
                    </div>
                </div>
                <div class="menu-item" id="menu-item-profile">
                    <div class="menu-icon" >
                        <?php include('profile_icon.php'); ?>
                    <!-- <img src="../assets/img/user.svg" alt=""/> -->
                    </div>
                    <div class="menu-txt"  id="profile-icon-txt">
                        Profile
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
