<?php

class Login {

  public function __construct(){}

  public function printPage() {
    echo '<div class="login_wrapper">';
    echo '<div class="login_container">';

    echo '<form id="login">';

    echo '<div class="input-block">';
    echo '<label for="email">Email</label>';
    echo '<input type="email" id="email" name="email">';
    echo '</div>';

    echo '<div class="input-block">';
    echo '<label for="password">Password</label>';
    echo '<input type="password" id="password" name="password">';
    echo '</div>';

    echo '<input type="submit" value="Login">';

    echo '</form>';

    echo '</div>'; //ends login_container
    echo '</div>'; //ends login_wrapper
  }

  public function run() {
    $this->printPage();
  }

}
