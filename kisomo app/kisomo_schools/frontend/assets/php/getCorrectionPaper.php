<?php

    require 'linker.php';
    $quizzeId=$_POST['selectedQuizId'];
    $res = mysqli_query($conn ,"SELECT question_id,question_content FROM school_quiz_questions
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
                        <li class='qn-in-s'>
                            <div class='qn-s-contents'>
                                <div class='qn-s-no'>
                                    Question $total_qns:
                                </div>
                                <div class='qn-s-content'>
                                    $question_content
                                </div>
                            </div>
                        ";

            $answers=mysqli_query($conn," SELECT answer_id, answer_content, is_answer 
                                                FROM school_quiz_answers 
                                        WHERE question_id=$question_id");

            if( mysqli_num_rows($answers) > 0 )
            {
                    $optionCounter=0;
                    while( ($row = mysqli_fetch_array($answers))!=null )
                    {  
                        $optionCounter+=1;
                        $answerId=$row['answer_id'];
                        $answerContent=$row['answer_content'];
                        $isAnswerStatus=$row['is_answer'];
                        if($isAnswerStatus=='T')
                        {
                            $output.="
                                        <div class='qn-s-contents'>
                                            <div class='qn-s-no qn-s-ans'>
                                                Answer
                                            </div>
                                            <div class='qn-s-content qn-s-answer-content'>
                                                $answerContent
                                            </div>
                                        </div>
                                    ";     
                        }
                    }
            }
            $output.="</li>";
        }

        echo $output;
    }   
    else
    {
        echo "empty";
    }
?>
