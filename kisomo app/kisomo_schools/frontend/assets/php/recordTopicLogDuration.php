<?php
include 'logsRecorder.php';
if(isset($_SESSION['topic_opened_at']))
{
  $_SESSION['currently_recorded_topic'] ="";
  updateTopicRecordSetDuration();
}
?>