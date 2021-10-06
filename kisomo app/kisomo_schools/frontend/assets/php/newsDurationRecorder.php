<?php
    session_start();
    include 'logsRecorder.php';
    if(isset($_SESSION['lock_news_timer']))
    {
        if($_SESSION['lock_news_timer']==1)
        {
            recordNewsLogDuration();
        }
    }
?>