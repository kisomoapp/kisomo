<?php
include 'logsRecorder.php';
if(isset($_SESSION['module_opened_at']))
{
  $_SESSION['currently_recorded_module'] ="";
  recordModuleDuration();
}
?>