<?php
    require 'linker.php';
    $topicId=$_POST['topicId'];
    $res = mysqli_query($conn ,"SELECT m.module_id,r.module_type,m.module_title 
                                FROM `school_topic_modules` m,school_resources r
                                WHERE  m.resource_id=r.resource_id AND m.topic_id=$topicId");
if( mysqli_num_rows($res) > 0 ){

    $output = "";

    while( ($row = mysqli_fetch_array($res))!=null ){

        $moduleTitle = $row['module_title'];
        $moduleId = $row['module_id'];
        $moduleType = $row['module_type'];
        if($moduleType === "V"){
            $output .="<li class='module' id='module-$moduleId'>
                            <div class='module-icon'>
                                <img src='../assets/img/video.png'/>
                            </div>
                            <p>$moduleTitle</p>
                        </li>"; 
        }
        else if($moduleType === "T"){
            $output .="<li class='module ' id='module-$moduleId'>
                            <div class='module-icon'>
                                <img src='../assets/img/pdf.png'/>
                            </div>
                            <p>$moduleTitle</p>
                      </li>"; 
        }
    }
    echo $output;

}else{
    echo "empty";
}
?>