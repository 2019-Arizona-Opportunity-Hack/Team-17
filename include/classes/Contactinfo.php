<?php

class Contactinfo {
  
  public function __construct(){}

  public function printPage() {
    echo '<div class="contactinfo_wrapper">';
    echo '<div class="contactinfo_container">';
    echo '<form id="user_info" method="post" action="/thankyou">';

  
    echo '<div class="row_container">';
    echo '<label for="full_name">Name</label>';
    echo '<input type="text" id="full_name" name="full_name" required>';
    echo '</div>'; //ends row_container

    echo '<div class="row_container">';
    echo '<label for="phone">Phone</label>';
    echo '<input type="tel" id="phone" name="phone" required>';
    echo '</div>'; //ends row_container

    echo '<div class="row_container">';
    echo '<label for="email">Email</label>';
    echo '<input type="email" id="email" name="email" required>';
    echo '</div>'; //ends row_container

    echo '<div class="row_container">';
    echo '<label for="category">Category</label>';
    $this->printCategoryDropDown();
    echo '</div>';

    echo '<div class="row_container">';
    echo '<label for="address1">Address</label>';
    echo '<input type="text" id="address1" name="address1" required>';
    echo '</div>'; //ends row_container

    echo '<div class="row_container">';
    echo '<label for="address2">&nbsp;</label>';
    echo '<input type="text" id="address2" name="address2">';
    echo '</div>'; //ends row_container

    echo '<div class="row_container">';
    echo '<div class="column_container">';
    echo '<input type="text" id="city" name="city" required>';
    echo '<label for="city">City</label>';
    echo '</div>'; //ends column_container

    echo '<div class="column_container">';
    echo '<input type="text" id="state" name="state" required>';
    echo '<label for="state">State</label>';
    echo '</div>'; //ends column_container
    echo '</div>'; //ends row_container

    echo '<div class="row_container">';
    echo '<div class="column_container">';
    echo '<input type="tel" id="zipcode" name="zipcode" required>';
    echo '<label for="zipcode">ZipCode</label>';
    echo '</div>'; //ends column_container
    echo '</div>'; //ends row_container

    echo '<div class="row_container">';
    echo '<input type="submit" value="Submit">';
    echo '</div>'; //ends row_container

    echo '</form>';
    echo '</div>'; //ends questionare_container
    echo '</div>'; //ends questionare_wrapper
  }

  public function getCategories() {
    $query = 'SELECT name FROM category WHERE active = ?';
    $active = 1;
    return Functions::query_select_all_column($query, $active);
  }

  public function printCategoryDropDown() {
    $categories = $this->getCategories();
    echo '<select id="category" name="category">';
    foreach ($categories as $category) {
      echo '<option value="' . $category . '">' . $category . '</option>';
    } 
    echo '</select>';
  }

  public function run() {
    $this->printPage();
  }

}
