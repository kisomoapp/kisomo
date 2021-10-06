<?php

    session_start();
    include 'logsRecorder.php';

    // modudle
    if(isset($_SESSION['module_opened_at']) && isset($_SESSION['currently_recorded_module']))
    {
        if($_SESSION['currently_recorded_module']!="")
        {
            autoModuleDurationRecorder();
        }
    }

    // topic
    if(isset($_SESSION['topic_opened_at']))
    {
      topicDurationAutoRecorder();
    }

    // quiz
    if(isset($_SESSION['quiz_opened_at']))
    {
        autoQuizDurationRecorder();
    }

    // news
    if(isset($_SESSION['lock_news_timer']))
    {
        if($_SESSION['lock_news_timer']==1)
        {
            autoNewsLogDurationRecorder();
        }
    }

    // calendar
    if(isset($_SESSION['lock_calendar_timer']))
    {
        if($_SESSION['lock_calendar_timer']==1)
        {
            autoCalendarLogDurationRecorder();  
        }
    }

?>