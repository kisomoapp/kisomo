<?php
    require 'linker.php';
    $streamId=$_POST['selectedStreamId'];
    $subjectId=$_POST['selectedSubjectId'];
    $searchValue=$_POST['searchValue'];


    $res = mysqli_query($conn ,"    SELECT  notes_id,notes_title FROM notes 
    WHERE stream_id= $streamId AND school_subject_id= $subjectId and notes_title like '%$searchValue%'");

if( mysqli_num_rows($res) > 0 ){

    $output = "";

    while( ($row = mysqli_fetch_array($res))!=null ){

        $notes_id = $row['notes_id'];
        $notes_title = $row['notes_title'];

        $output .= " <li class='notes hide-element' id='notes-$notes_id'>
                        $notes_title
                    </li>
                 ";
    }
    echo $output;

}else{
    echo "empty";
}
?>