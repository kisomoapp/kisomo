<?php
    require 'linker.php';
    $topicId=$_POST['topicId'];
    $res = mysqli_query($conn ,"SELECT  quiz_id,quiz_title 
    FROM quizzes where course_id=$topicId");

if( mysqli_num_rows($res) > 0 ){

    $output = "";

    while( ($row = mysqli_fetch_array($res))!=null ){

        $quizTitle = $row['quiz_title'];
        $quizId = $row['quiz_id'];

        $output .= "<li class='quiz' id='quize-$quizId'>$quizTitle</li>";
    }
    echo $output;

}else{
    echo "empty";
}
?>