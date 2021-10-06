<?php

    require "linker.php";
    
    $schoolId =1; //$_SESSION['schoolId'];

    $res = mysqli_query($conn , "SELECT ss.school_subject_id, s.subject_name, i.path,s.color
     FROM subjects s, school_subjects ss,icon i WHERE
    ss.school_id = $schoolId AND ss.subject_id = s.subject_id AND s.icon_id=i.icon_id
     AND s.subject_name NOT LIKE('English')  AND s.subject_name NOT LIKE('Kiswahili') 
     AND s.subject_name NOT LIKE('Mathematics')");

    if( mysqli_num_rows($res) > 0 ){

        $output = "";

        while( ($row = mysqli_fetch_array($res))!=null ){
            
            $id = $row['school_subject_id'];
            $subjectName = $row['subject_name'];
            $icon = $row['path'];
            $color = $row['color'];
            // echo "alert('$color')";
            switch($color){
                case 'blue':
                    $bgColorClass = 'blue';
                break;
                case 'green':
                    $bgColorClass = 'green';
                break;
                case 'purple':
                    $bgColorClass = 'purple';
                break;
                case 'red':
                    $bgColorClass = 'red';
                break;
                case 'orange':
                    $bgColorClass = 'orange';
                break;
                case 'grey':
                    $bgColorClass = 'grey';
                break;
                case 'violet':
                    $bgColorClass = 'violet';
                break;
                case 'navy':
                    $bgColorClass = 'navy';
                break;   
                default:
                    $bgColorClass = 'blue';

            }

            $output .= "<div class='subj subj-action $bgColorClass' id='subj-$id'>
                              <div class='subj-icon'>
                                   <img src='../../../$icon'/>
                             </div>
                             <div class='subj-subjectname'>
                                   $subjectName
                             </div>
                        </div>";

        }
                    $icon="kisomo_schools/backend/assets/img/icons/subjects/extra.png";
                    $bgColorClass= 'grey';
                    $output .= "<div class='subj $bgColorClass' id='see-more-btn'>
                              <div class='subj-icon'>
                                   <img src='../../../$icon'/>
                             </div>
                             <div class='subj-subjectname'>
                                   Extra curricular
                             </div>
                        </div>";
        echo $output;

    }else{
        echo "empty";
    }


?>
