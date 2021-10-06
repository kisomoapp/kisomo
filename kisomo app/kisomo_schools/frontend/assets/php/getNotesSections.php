
<?php
require 'linker.php';
$notesId = (int)$_POST['notesId'];
$res = mysqli_query($conn ,"SELECT  notes_section_id,notes_section_title,section_content, notes_id FROM notes_section WHERE notes_id=$notesId order by section_order");
   if( mysqli_num_rows($res) > 0 ){

    $output = "";

    while( ($row = mysqli_fetch_array($res))!=null ){

        $notes_section_id = $row['notes_section_id'];         
        $content= $row['section_content'];
        $sectionTitle= $row['notes_section_title'];
        $output .= "
        <li class='notes-section'>
                        <div class='title-box'>
                            <div class='notes-section-title'>$sectionTitle </div>
                            <div class='expand-notes-btn' id='expand-notes-btn-$notes_section_id'>+</div>
                            <div class='minimize-notes-btn' id='minimize-notes-btn-$notes_section_id'>-</div>
                        </div>
                        <div class='notes-template' id='notes-template-$notes_section_id'>
                            $content
                        </div>
        </li>
                    ";
    }

    echo $output;

}
else
{
    echo "empty";
}


?>