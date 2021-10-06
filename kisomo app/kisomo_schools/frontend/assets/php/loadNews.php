<?php
    include('linker.php');


        $schoolId = 1;//$_SESSION['schoolId'];
        $res = mysqli_query( $conn , "SELECT n.*, t.tag_name FROM school_news n, school_news_tags t 
                                        WHERE n.school_id = $schoolId AND n.tag_id = t.tag_id  ORDER BY n.date_posted DESC" );
        if( mysqli_num_rows($res) > 0 ){

            $output = "";
            while( ($row = mysqli_fetch_array($res))!=null ){

                $newsTitle = $row['news_title'];
                $newsDesc = $row['news_description'];
                $newsImg = $row['news_img'];
                $tagName = $row['tag_name'];
                $datePosted = $row['date_posted'];
                $datePosted = date_create($datePosted);
                $datePosted = date_format($datePosted,"l, d-M-Y H:ia");

                $bgColor = "";
                switch( $tagName ){
                    case "Academic":
                        $bgColor = "blueBg";
                        break;
                    case "Sports":
                        $bgColor = "greenBg";
                        break;
                    case "Others":
                        $bgColor = "blackBg";
                        break;
                    case "General":
                        $bgColor = "greyBg";
                        break;
                    default:
                        $bgColor = "blackBg";
                        break;
                }

                if( $newsImg != 'NONE' )
                $output .= "
                <div class='news-img'>
                <img src='../../../$newsImg' alt='' alt=''>
             </div>";
                $output .= "
                            <div class='wrap-news-box'>

                                 <div class='news-title'>
                                        $newsTitle
                                 </div>
                                 <div class='news-category'>
                                      <div class='category-box $bgColor'>
                                        $tagName
                                     </div>
                                 </div>
                                <div class='news-txt'>
                                        $newsDesc 
                                 </div>
                              <div class='news-created-at'>
                                    <div>$datePosted</div>
                               </div>
                          </div>
                ";
            }
            echo $output;


        }else{
            echo "empty";
        }

    // }
    // else
    // {
    //     echo "value not set";
    // }

?>
