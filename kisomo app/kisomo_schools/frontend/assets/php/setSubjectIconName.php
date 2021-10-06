<?php
    $output="";
    $name=$_POST['subjectName'];
    $path=$_POST['path'];
    $bgColor=$_POST['bgcolor'];
    $output.="<div class='s-icon $bgColor'>
                    <img src='$path' alt=''/>
              </div>
              <div class='s-name'>
                      $name
             </div>";
    echo $output;
?>