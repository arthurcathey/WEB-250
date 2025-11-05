<?php

class session
{

  private $admin_id;

  public function __construct()
  {
    session_start();
    $this->check_stored_login();
  }

  public function login($admin)
  {
    // database should find admin based on username/password
    if ($admin) {
      session_regenerate_id();
      // found admin, set session id
      $_SESSION['admin_id'] = $admin->id;
      $this->admin_id = $admin->id;
      return true;
    } else {
      // admin not found
      return false;
    }
  }

  public function is_logged_in()
  {
    return isset($this->admin_id);
  }

  public function logout()
  {
    unset($_SESSION['admin_id']);
    unset($this->admin_id);
    return true;
  }

  private function check_stored_login()
  {
    if (isset($_SESSION['admin_id'])) {
      $this->admin_id = $_SESSION['admin_id'];
    }
  }
}
