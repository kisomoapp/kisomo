<?php
require 'linker.php';
$schoolId = 1;//$_SESSION['schoolId'];
$res = mysqli_query($conn , 
"SELECT s.stream_id,s.stream_name FROM `school_streams` s,schools ss 
where s.school_id=$schoolId and s.school_id =ss.school_id");
   if( mysqli_num_rows($res) > 0 ){

    $output = "";

    while( ($row = mysqli_fetch_array($res))!=null ){

        $stream_id = $row['stream_id'];
        $stream_name = $row['stream_name'];
        
        $output .= "<li id='stream-$stream_id' class='stream animate-stream'>$stream_name</li> ";
    }
    echo $output;

}else{
    echo "empty";
}
?>