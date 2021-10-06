<?php
    include 'logsRecorder.php';
    recordLoggedInDuration();
    recordModuleDuration();
    recordQuizDuration();
    if(isset($_SESSION['lock_news_timer']))
    {
        if($_SESSION['lock_news_timer']==1)
        {
            recordNewsLogDuration();
        }
    }
    if(isset($_SESSION['lock_calendar_timer']))
    {
        if($_SESSION['lock_calendar_timer']==1)
        {
            recordCalendarLogDuration();
        }
    }
    session_destroy();
    echo "success";
?>