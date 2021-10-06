<?php

    session_start();
    if( isset($_SESSION['isLoggedIn']) ){

        if( $_SESSION['isLoggedIn'] == true  )
            header('Location:pages');
    }
    

?>