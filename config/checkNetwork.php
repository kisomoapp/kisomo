<?php
    $ip="162.0.235.7";
    system("ping -n 3 $ip",$o);
    echo $o;
?>