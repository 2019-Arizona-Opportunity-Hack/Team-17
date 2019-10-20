<?php


 /** This object will direct all Ajax calls. It might be a bad idea to place
   * them all in this object, but I will do my best to keep it organized.
   * The switchboard will hopefully direct all traffic cleanly.
   * All ajax calls require an action to be sent.
  **/

class AjaxObject {

  /**
   * @string $action determines which ajax action to take.
   **/
  protected $action = '';

  /**
   * @array $requests $_REQUEST
   **/
  protected $requests = array();

  /**
   * NOTE: All ajax calls require: action & ($_POST OR $_GET OR $_FILES)
   **/
  public function __construct($requests) {
    $this->set_ajax_data($requests);
    $this->init();
  }

  protected function set_ajax_data($requests) {
    $this->action   = isset($requests['action']) ? $requests['action'] : null;
    $this->requests = isset($requests) ? $requests : null;
  }

  public function init() {
    if (empty($this->requests) || empty($this->action)) {
      return;
    }
    $this->switchboard();
  }

  /**
   * Based on the action, this switchboard will determine the next action
   **/
  protected function switchboard() {
    switch($this->action){

      case 'login':
        require_once('../include/Auth.php');
        $isValid = Auth::authenticate(
          $this->requests['email'],
          $this->requests['password']
        );
        if ($isValid) {
          echo json_encode(['response' => 
            [ 'redirect' => '/dashboard' ],
          ]);
          exit();
        } else {
          echo json_encode(['response' =>
            [ 'error' => 'Invalid email/password' ]
          ]); 
          exit();
        }

      default:
        exit();
    
    }
  }

}
