<?php
    include('linker.php');
    if($conn)
    {
        // $res=mysqli_query($conn,"SELECT course_id, course_title, course_description, course_img,
        // category_id, order_in_category, instructor_id, is_featured, 
        // is_free FROM courses WHERE is_featured='T' LIMIT 5");t.stream_id= $streamId AND t.school_subject_id= $subjectId AND 

        $res=mysqli_query($conn,"SELECT  t.topic_id,t.topic_title,t.topic_description,
        i.img_path FROM `school_subject_topics` t,school_topic_images i,school_subjects su 
        WHERE 
        t.school_subject_id=su.school_subject_id AND t.img_id=i.img_id ORDER BY rand() LIMIT 6");


        if( mysqli_num_rows($res) > 0 )
        {

            $output = "";

            while( ($row = mysqli_fetch_array($res))!=null )
            {
                $course_title=$row['topic_title'];
                $course_description=$row['topic_description'];
                $img_path=$row['img_path'];
                $course_id=$row['topic_id'];
                $output.="
                                <section>
                                <div class='extra-course course-action' id='ext-course-$course_id'>
                                    <div class='e-topic-img-bg'>
                                        <img src='../../../$img_path'/>
                                    </div>
                                    <div class='e-topic-txt'>
                                        <div class='e-course-wrap-content'>
                                            <div class='e-course-title'>
                                               <b>$course_title</b>
                                            </div>
                                            <div class='e-course-p'>
                                               $course_description
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                         ";
            }
            // $img_path="img/courses/learn_more.jpg";
            // $output.="
            //                     <section>
            //                     <div class='extra-course' id='see-more-btn'>
            //                         <div class='e-topic-img-bg'>
            //                             <img src='../../../$img_path'/>
            //                         </div>
            //                         <div class='e-topic-txt'>
            //                             <div class='e-course-wrap-content e-see-more-box'>
            //                                SEE MORE
            //                             </div>
            //                         </div>
            //                     </div>
            //                 </section>
            //         ";
            echo $output;
        } 
        else
        {
            echo "empty";
        }
    }
    else
    {
        echo "error";
    }

?>