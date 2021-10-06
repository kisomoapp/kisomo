<?php
    session_start();
    require 'linker.php';
    include 'logsRecorder.php';
    
    if(isset($_POST['score']) && isset($_POST['quizId']) && isset($_SESSION['userId']))
    {
        $score=$_POST['score'];

        // log
        setQuizCompleted($score);
        // end of log

        $userId=$_SESSION['userId'];
        $quizId=$_POST['quizId']; 
        $res=mysqli_query($conn,"INSERT INTO `quiz_scores`( `user_id`, `quiz_id`, `score`)
                            VALUES($userId,$quizId,'$score')");
        if($res)
        {
            echo "success";
        }
        else
        {
            echo "error";
        }
    }
    else
    {
        echo "value missing";
    }

?>
