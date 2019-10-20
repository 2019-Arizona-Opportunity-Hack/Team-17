<?php

class Dashboard {

  private $error = false;
  
  public function __construct(){}

  public function printPage() {
    echo '<div class="dashboard_wrapper">';
    echo '<div class="dashboard_container">';
    $this->printPendingRequests(); 
    echo '</div>'; //ends dashboard_container
    echo '</div>'; //ends dashboard_wrapper
  }

  public function printPendingRequests() {
    echo '<div class="pending_requests_container">';
    echo '<div class="pending_requests">Pending Requests</div>';
    echo '<div class="quantity"></div>';
    echo '</div>'; //ends pending_requests_container
  }

  public function printCategoriesJSON() {
    $categories = $this->getAllCategories();
    $json = json_encode($categories);
    echo '<div class="users">';
    echo '<script type="text/json" id="requests">' . $json . '</script>';
    echo '</div>';
  }

  public function getAllCategories() {
    $query = 'SELECT r.*,
      u.email, u.phone_number, u.address,
      u.city, u.state, u.zipcode, RTRIM(CONCAT(first_name, " ", last_name)) as full_name
      FROM request r
      INNER JOIN user u
        ON u.email = r.email
      WHERE r.done = ?';
    $done = 0;
    return Functions::query_select_all($query, $done);
  }

  public function run() {
    $this->printPage();
    $this->printCategoriesJSON();
  }

}
