<?php
    require 'linker.php';
    $streamId=$_POST['selectedStreamId'];
    $subjectId=$_POST['selectedSubjectId'];
    $res = mysqli_query($conn ,"SELECT course_id, course_title, course_description, course_img,
    category_id, order_in_category, instructor_id, is_featured, 
    is_free FROM courses WHERE is_featured='T'");
    

if( mysqli_num_rows($res) > 0 ){

    $output = "";

    while( ($row = mysqli_fetch_array($res))!=null ){

        $topic_id = $row['course_id'];
        $topic_title = $row['course_title'];
        $topic_description = $row['course_description'];
        $image_path= $row['course_img'];
        $output .= " <li class='topic' id='topic-$topic_id'>
                        <div class='topic-img'>
                            <img src='../../../$image_path' alt=''>
                        </div>
                        <div class='topic-desc'>
                            <div class='topic-desc-title'>$topic_title</div>
                            <div class='topic-desc-txt'>$topic_description </div>
                        </div>
                    </li>
                 ";
    }
    echo $output;

}else{
    echo "empty";
}
?>