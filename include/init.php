<?php

  // manages user via sessions
  session_start();

  if ($zuris['debug']) {
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
  }

  //add misc functions
  require_once('../include/Functions.php');

  //retrieve page info from database
  require_once('../include/db_connect.php');
