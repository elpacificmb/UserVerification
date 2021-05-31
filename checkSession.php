<?php 
require_once 'controllers/authController.php';

  $loginTime = $_SESSION['login_time'];
  //Session Timeout
  if (isset($loginTime)) {
    $timeDifference = time() - $_SESSION['login_time'];
    $duration = 30; //30 = 30seconds
    if ($timeDifference > $duration) {
      echo 'logout';
    }
  }
