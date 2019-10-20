<?php
  // easier to read
  define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

  // login configuration file
  require_once('../include/config.php');

  // load init file
  require_once('../include/init.php');

  // start buffer
  ob_start();

  // start website
  require_once('../include/classes/Template.php');
  $Template = new Template();
  $Template->run();

  // flush buffer
  ob_end_flush();
