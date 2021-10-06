<?php

session_start();
if(isset($_SESSION['studentName']))
echo  $_SESSION['studentName'];
else
echo "";

?>