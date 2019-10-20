<?php

  //create handle via PDO.
  $dsn = "mysql:host={$zuris['mysql_host']};dbname={$zuris['mysql_db']};charset={$zuris['mysql_charset']}";

  $opt = [
      PDO::ATTR_ERRMODE                   => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE        => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES          => false,
  ];

  // creates handle for pdo
  $pdo = new PDO($dsn, $zuris['mysql_user'], $zuris['mysql_pass'], $opt);
