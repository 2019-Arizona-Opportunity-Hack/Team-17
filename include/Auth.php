<?php

class Auth {

  public function __construct(){}

  public function authenticate($email, $password) {
    $query = 'SELECT *
      FROM user
      WHERE email = ?
        AND admin_level > 0';
    $user = Functions::query_select(
      $query, $email
    );

    // user doesnt even exist!
    if (empty($user)) {
      return false;
    }

    $dbPassword = $user['password'];

    $isValid = password_verify($password, $dbPassword); 

    // create session if user is validated
    if ($isValid) {
      self::setSession($user);
    }
    return $isValid;
  }

  public static function setSession($user) {
    $_SESSION['user'] = $user;
    $_SESSION['loggedIn'] = true;
  }

}
