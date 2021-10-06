<?php
    session_start();
    require 'linker.php';
    $fullname=$_SESSION['studentName'];
    $userId=$_SESSION['userId'];
    $res=mysqli_query($conn,"SELECT  `score` 
                        FROM `student_scores` WHERE user_id=$userId");
    $res_from_gen=mysqli_query($conn,"SELECT  `score` 
    FROM `quiz_scores` WHERE user_id=$userId");

    $countQuizAttempted=0;
    $totalScore=0;
    if(mysqli_num_rows($res)>0 or mysqli_num_rows($res_from_gen)>0)
    {
        if(mysqli_num_rows($res)>0)
        {
            while(($row = mysqli_fetch_array($res))!=null )
            {
                $countQuizAttempted+=1;
                $score=(int)$row['score'];
                $totalScore=$totalScore + $score;
            }
        }
        if(mysqli_num_rows($res_from_gen)>0)
        {
            while(($row = mysqli_fetch_array($res_from_gen))!=null )
            {
                $countQuizAttempted+=1;
                $score=(int)$row['score'];
                $totalScore=$totalScore + $score;
            }
        }
        $average=number_format((float)$totalScore/$countQuizAttempted,2,'.','');
        $result= array('average' => $average,'quiz_no'=>$countQuizAttempted,'studentName'=>$fullname);
        echo json_encode($result);
    }
    else
    {
        $result= array('average' => 0,'quiz_no'=>0,'studentName'=>$fullname);
        echo json_encode($result);
    }
?>