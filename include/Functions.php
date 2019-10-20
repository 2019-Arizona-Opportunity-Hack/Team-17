<?php

class Functions {

  public static function query_select($query, $vars) {
    global $pdo;
    $stmt = $pdo->prepare($query); 
    $stmt->execute(self::makeArray($vars));
    return $stmt->fetch();
  }

  public static function query_select_all($query, $vars) {
    global $pdo;
    $stmt = $pdo->prepare($query); 
    $stmt->execute(self::makeArray($vars));
    return $stmt->fetchAll();
  }

  public static function query_select_all_column($query, $vars) {
    global $pdo;
    $stmt = $pdo->prepare($query); 
    $stmt->execute(self::makeArray($vars));
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
  }

  public static function query_select_column($query, $vars) {
    global $pdo;
    $stmt = $pdo->prepare($query); 
    $stmt->execute(self::makeArray($vars));
    return $stmt->fetchColumn();
  }

  public static function insert_query($query, $vars) {
    global $pdo;
    $stmt = $pdo->prepare($query);
    $stmt->execute(self::makeArray($vars));
  }

  public function makeArray($var) {
    return is_array($var) ? $var : [ $var ];
  }

} 
