<?php
include 'logsRecorder.php';
if(isset($_SESSION['quiz_opened_at']))
{
  $_SESSION['currently_recorded_quiz'] ="";
  recordQuizDuration();
}
?>