<?php
    require 'linker.php';
    $streamId=$_POST['selectedStreamId'];
    $subjectId=$_POST['selectedSubjectId'];
    $res = mysqli_query($conn ,"SELECT  t.topic_id,t.topic_title,t.topic_description,
    i.img_path FROM `school_subject_topics` t,school_topic_images i,school_subjects su 
    WHERE t.stream_id= $streamId AND t.school_subject_id= $subjectId AND 
    t.school_subject_id=su.school_subject_id AND t.img_id=i.img_id");

if( mysqli_num_rows($res) > 0 ){

    $output = "";

    while( ($row = mysqli_fetch_array($res))!=null ){

        $topic_id = $row['topic_id'];
        $topic_title = $row['topic_title'];
        $topic_description = $row['topic_description'];
        $image_path= $row['img_path'];
        $output .= " <li class='topic hide-element' id='topic-$topic_id'>
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