<?php

class Homepage {

  public function __construct(){}

  public function printPage() {
    echo '<div class="homepage_wrapper">';
    echo '<div class="homepage_container">';

    echo '<div class="image_container">';
    echo '<img src="/images/nplogo.png" alt="logoImage">';
    echo '</div>'; //ends image_container

    echo '<form id="request_need" method="post" action="/contactinfo">';
    echo '<input type="submit" value="Make a Request">';
    echo '</form>';

    echo '</div>'; //ends homepage_container
    echo '</div>'; //ends homepage_wrapper
  }

  public function run() {
    $this->printPage();
  }

}
