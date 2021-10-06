<?php

session_start();
require 'linker.php';
if(isset($_SESSION['userId']))
{
    $userId=$_SESSION['userId'];
    $res = mysqli_query($conn ,"SELECT sc.score,sq.quiz_title from student_scores sc,school_quizzes sq,users u where sc.quiz_id=sq.quiz_id
    and sc.user_id=u.user_id and sc.user_id=$userId");
    $res_from_gen = mysqli_query($conn ,"SELECT qs.score,q.quiz_title from quiz_scores qs,quizzes q,users u where qs.quiz_id=q.quiz_id
    and qs.user_id=u.user_id and qs.user_id=$userId");

    if( mysqli_num_rows($res) > 0 or mysqli_num_rows($res_from_gen) > 0  )
    {
        $output = "";
        if( mysqli_num_rows($res) > 0 )
        {
            while( ($row = mysqli_fetch_array($res))!=null )
            {
                $score=$row['score'];
                $title=$row['quiz_title'];
                $output.="
                                <li class='record'>$title<div class='li-score'>$score%</div></li>
                            ";
            }
            echo $output;
        }
        if( mysqli_num_rows($res_from_gen) > 0 )
        {
            while( ($row = mysqli_fetch_array($res_from_gen))!=null )
            {
                $score=$row['score'];
                $title=$row['quiz_title'];
                $output.="
                                <li class='record'>$title<div class='li-score'>$score%</div></li>
                            ";
            }
            echo $output;
        }
    }
    else
    {
        echo "empty";
    }

}
?>
