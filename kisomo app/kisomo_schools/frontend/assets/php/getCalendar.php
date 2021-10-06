<?php
    require('linker.php');

        $res = mysqli_query($conn , "SELECT calendar_title,calendar_description,color,date_posted 
                                    FROM school_calendars ORDER BY date_posted DESC");



       
       
        if( mysqli_num_rows($res) > 0 )
        {
            $output="";
            while( ($row = mysqli_fetch_array($res))!=null )
            {  



                $title = $row['calendar_title'];
                $description = $row['calendar_description'];
                $color = $row['color'];
                $date = date_create($row['date_posted']);
                $date = date_format($date,"l, d-M-Y");

                $bgColor = "";
            
                switch($color){
                    case 'blue':
                        $bgColor = 'blueBg';    
                        break;
                    case 'red':
                        $bgColor = 'redBg';    
                        break;
                    case 'yellow':
                        $bgColor = 'yellowBg';    
                        break;
                    case 'black':
                        $bgColor = 'blackBg';    
                        break;
                    case 'green':
                        $bgColor = 'greenBg';    
                        break;
                    case 'purple':
                        $bgColor = 'purpleBg';    
                        break;    
                    case 'grey':
                    case 'gray':
                        $bgColor = 'greyBg';    
                        break;
                    case 'orange':
                        $bgColor = 'orangeBg';    
                        break;
                    case 'pink':
                        $bgColor = 'pinkBg';    
                        break;    
                    default:
                        $bgColor = 'blackBg';    
                        break;
                                
                }
                $output.="
                            <li class='event' style='border-left: 4px solid $color' >
                                <div class='event-date $bgColor'>$date</div>
                                <div class='event-title'>$title</div>
                                <div class='event-desc'>$description </div>
                            </li>
                     ";


            }   
            echo $output;
        }  
        else{
            echo "empty";
        }       
       

        
?>