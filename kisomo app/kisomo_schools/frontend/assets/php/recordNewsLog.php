<?php
    session_start();
    //log
    date_default_timezone_set("Africa/Nairobi");
    include 'logsRecorder.php';
    $action="opened school news";
   
    if(isset($_SESSION['lock_news_timer']))
    {
        if(!($_SESSION['lock_news_timer']==1))
        {

            $_SESSION['news_opened_at']=date("Y-m-d h:i:sa");
            recordNewsLog($action);
        }
    }
    else
    {
        $_SESSION['news_opened_at']=date("Y-m-d h:i:sa");
        recordNewsLog($action);  
    }

    //

?>