<?php

class Thankyou {

  private $error = false;
  
  public function __construct(){}

  public function printPage() {
    echo '<div class="thankyou_wrapper">';
    echo '<div class="thankyou_container">';
    if ($this->error) {
      echo '<h1>There was an error while attempting to add your request. Please try again later.</h1>';
    } else {
      echo '<h1>Thank you for your request. A represenative will contact you soon!</h1>';
    }
    echo '<a href="/">Return to Homepage</a>';

    echo '</div>'; //ends thankyou_container
    echo '</div>'; //ends thankyou_wrapper
  }

  public function createNewContact($request) {
    if (empty($request)) {
      $this->error = true;
      return;
    }
    $fullname = explode(' ', $request['full_name']);
    $firstname = $fullname[0] ?? '';
    $lastname = $fullname[1] ?? '';
    $phone = $request['phone'] ?? '';
    $email = $request['email'] ?? '';
    $address = $request['address'] ?? '';
    $address2 = $request['address2'] ?? '';
    $city = $request['city'] ?? '';
    $state = $request['state'] ?? '';
    $zipcode = $request['zipcode'] ?? '';
    $query = 'INSERT INTO user
      SET first_name = ?, last_name = ?, phone_number = ?, email = ?,
      address = ?, address2 = ?, city = ?, state = ?, zipcode = ?';
    Functions::insert_query($query, [
      $firstname, $lastname, $phone, $email,
      $address, $address2, $city, $state, $zipcode
    ]);
  }


  public function createNewRequest($request) {
    if (empty($request)) {
      $this->error = true;
      return;
    }
    $email = $request['email'] ?? '';
    $category = $request['category'];
    $done = 0;
    $query = 'INSERT INTO request (email, done, category_name)
      VALUES (?, ?, ?)';
    Functions::insert_query($query, [
      $email, $done, $category 
    ]);
  }

  public function checkIfUserExists($email) {
    $query = 'SELECT * FROM user WHERE email = ?';
    return Functions::select_query($query, [
      $email
    ]);
  }


  public function run() {
    if (empty($this->checkIfUserExists($_REQUEST['email']))){
    	$this->createNewContact($_REQUEST);
    }
	$this->createNewRequest($_REQUEST);
    $this->printPage();
  }



}
