<?php
    date_default_timezone_set("Africa/Nairobi");
    include 'logsRecorder.php';

    require "linker.php";
    $moduleId = $_POST['selectedModuleId'];
    $res = mysqli_query($conn , 
    "SELECT module_title,file_link,module_description,duration_in_minutes,module_type
     FROM modules WHERE  module_id=$moduleId");

    if( mysqli_num_rows($res) > 0 ){

        $output = "";

        while( ($row = mysqli_fetch_array($res))!=null ){
            
            $module_title = $row['module_title'];
            $module_description=$row['module_description'];
            $module_type=$row['module_type'];
            $file_link=$row['file_link'];
            $_SESSION['module_logged']=$module_title;

            if($module_type =="V")
            {
                
                // log record

                $action="opened video  $module_title";
                 if(isset($_SESSION['currently_recorded_module']))
                {
                  if($_SESSION['currently_recorded_module'] != $module_title)
                  {
                    recordStudentModuleLogs($action);
                    $_SESSION['currently_recorded_module']=$module_title;
                    $_SESSION['module_opened_at']=date("Y-m-d h:i:sa");
                  }
             
                }
                else
                {
                  recordStudentModuleLogs($action);
                  $_SESSION['currently_recorded_module']=$module_title;
                  $_SESSION['module_opened_at']=date("Y-m-d h:i:sa");
                }        

                 //end of log record

                       
            $output .= "<div class='m-module-title  $module_title'>
       </div>
       <div class='m-module-resource'>
               <video id='module-video' controls webkitallowfullscreen mozallowfullscreen allowfullscreen>
                   <source src='../../../$file_link' alt='no video'  type='video/mp4'>
               </video> 
             <div class='expand'>
               <img src='../assets/img/expand.png'/>
             </div>
             <div class='minimize'>
                 <img src='../assets/img/minimize.png'/>
             </div>
       </div>
       <div class='m-module-desc'>
               $module_description    
       </div>";
            }   
            else if($module_type=="T")
            {
                
                // log record
                $action="opened pdf  $module_title";
                if(isset($_SESSION['currently_recorded_module']))
                {
                    if($_SESSION['currently_recorded_module'] != $module_title)
                    {
                    recordStudentModuleLogs($action);
                    $_SESSION['currently_recorded_module']=$module_title;
                    $_SESSION['module_opened_at']=date("Y-m-d h:i:sa");
                    }
                
                }
                else
                {
                    recordStudentModuleLogs($action);
                    $_SESSION['currently_recorded_module']=$module_title;
                    $_SESSION['module_opened_at']=date("Y-m-d h:i:sa");
                }   
                //end of log record
                
             $output.= "<div class='m-module-title  $module_title'>
        </div>
        <div class='m-module-resource'>
            <embed src='../../../$file_link' id='module-pdf'>
        </div>
        <div class='m-module-desc'>
                $module_description    
        </div>";
            }  
            else{
                $output.="error";
            }        

        }
        echo $output;

    }
    else{
        echo "empty";
    }


?>


