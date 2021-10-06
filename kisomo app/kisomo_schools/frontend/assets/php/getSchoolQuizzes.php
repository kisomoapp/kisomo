<?php
    require 'linker.php';
    $topicId=$_POST['topicId'];
    $res = mysqli_query($conn ,"SELECT  q.quiz_id,q.quiz_title 
    FROM `school_subject_topics` t, school_quizzes q
    WHERE q.topic_id=$topicId AND q.topic_id=t.topic_id");

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