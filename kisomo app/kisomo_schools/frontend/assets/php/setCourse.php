<?php
    date_default_timezone_set("Africa/Nairobi");
    include 'logsRecorder.php';
    $path=$_POST['path'];
    $title=$_POST['title'];
    $topicDescription=$_POST['topicDescription'];

    $_SESSION['topic_logged']=$title;
    $action="opened $title";

    if(isset($_SESSION['currently_recorded_topic']))
    {
      if($_SESSION['currently_recorded_topic'] != $title)
      {
        recordStudentTopicLogs($action);
        $_SESSION['currently_recorded_topic']=$title;
        $_SESSION['topic_opened_at']=date("Y-m-d h:i:sa");
      }
 
    }
    else
    {
      recordStudentTopicLogs($action);
      $_SESSION['currently_recorded_topic']=$title;
      $_SESSION['topic_opened_at']=date("Y-m-d h:i:sa");
    }

    $output="";
    $output.=" 
                   <div class='topic-cont-bg'>
                       <img src='$path' alt=''>
                   </div> 
                   <div class='topic-content-desc'>
                        $topicDescription
                   </div><br>
                   <div class='section-header'>
                     <b>Watch Videos</b>
                   </div>
                   <ul class='topic-modules'>
                       
                   </ul>
                   <br>
                   <div class='section-header'>
                      <b>Quizzes</b>
                  </div>
                  <ul class='quiz-list'>
                  </ul>
                ";
    echo $output;
?>
