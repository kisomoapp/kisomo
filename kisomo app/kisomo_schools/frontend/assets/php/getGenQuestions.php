<?php

    date_default_timezone_set("Africa/Nairobi");
    include 'logsRecorder.php';

    require 'linker.php';
    $total_qns=0;
    $quizzeId=$_POST['selectedQuizId'];

    // start of quiz
    $title=$_POST['selectedQuizTitle'];
    $_SESSION['quiz_logged']=$title;
    $action="opened quiz, $title";

    if(isset($_SESSION['currently_recorded_quiz']))
    {
      if($_SESSION['currently_recorded_quiz'] != $title)
      {
        recordStudentQuizLogs($action);
        $_SESSION['currently_recorded_quiz']=$title;
        $_SESSION['quiz_opened_at']=date("Y-m-d h:i:sa");
      }
 
    }
    else
    {
        recordStudentQuizLogs($action);
      $_SESSION['currently_recorded_quiz']=$title;
      $_SESSION['quiz_opened_at']=date("Y-m-d h:i:sa");
    }
// end of quiz log 

    $res = mysqli_query($conn ,"SELECT question_id,question_content FROM quiz_questions
                         WHERE quiz_id=$quizzeId");
    $output = "";
    if( mysqli_num_rows($res) > 0 )
    {
        while( ($row = mysqli_fetch_array($res))!=null )
        {
            $total_qns+=1;

            $question_id = $row['question_id'];
            $question_content = $row['question_content'];
            
            $output.="
                    <div class='question'  id='question-$total_qns'>
                        <div class='question-number'>
                            <div class='current-qn-no'></div>
                            <div>/</div>
                            <div class='last-qn-no'></div>
                        </div>
                        <div> $question_content </div>
            ";

            $answers=mysqli_query($conn," SELECT choice_id, choice_content, is_answer 
                                                FROM quiz_choices 
                                        WHERE question_id=$question_id");

            if( mysqli_num_rows($answers) > 0 )
            {
                    $optionCounter=0;
                    while( ($row = mysqli_fetch_array($answers))!=null )
                    {  
                        $optionCounter+=1;
                        $answerId=$row['choice_id'];
                        $answerContent=$row['choice_content'];
                        $isAnswerStatus=$row['is_answer'];
                        if($isAnswerStatus=='T')
                        {
                            $output.="
                                        <div class='option option-$optionCounter'>
                                                $answerContent
                                                <div class='tick-box option-$optionCounter option-in-$total_qns'></div>
                                        </div>
                                    "; 
                            $answer_no =$optionCounter;      
                        }
                        else
                        {
                            $output.="
                                        <div class='option option-$optionCounter option-in-$total_qns'>$answerContent<div class='tick-box option-$optionCounter option-in-$total_qns'></div></div>
                                    "; 
                        }
                    }
                    $output.="</div>";
            }


            $qn_answer= array(
                'qn_no' =>$total_qns,
                'ans_no'=>$answer_no
            );
           $answer_table[]=$qn_answer;

        }
        $data= array("qns"=>$output,"totalQns"=>$total_qns,"anwerTable"=>$answer_table);
        echo json_encode($data);
    }   
    else
    {
        echo "empty";
    }
?>