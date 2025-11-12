<?php

class Session
{
  private $member_id;
  public $username;
  private $last_login;
  public $member_type;

  public const MAX_LOGIN_AGE = 60 * 60 * 24;

  public function __construct()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $this->check_stored_login();
  }

  /**
   * Log in the given member object.
   * @param Member $member
   * @return bool True on successful login
   */
  public function login($member)
  {
    if ($member) {
      session_regenerate_id();

      $_SESSION['member_id'] = $member->id;
      $this->member_id = $member->id;

      $_SESSION['username'] = $member->username;
      $this->username = $member->username;

      $_SESSION['member_type'] = $member->member_type;
      $this->member_type = $member->member_type;

      $_SESSION['last_login'] = time();
      $this->last_login = $_SESSION['last_login'];

      return true;
    } else {
      return false;
    }
  }

  /**
   * Check if the current session is logged in and login age is recent.
   * @return bool
   */
  public function is_logged_in()
  {
    return isset($this->member_id) && $this->last_login_is_recent();
  }

  /**
   * Log out the current session.
   * @return bool
   */
  public function logout()
  {
    unset($_SESSION['member_id'], $_SESSION['username'], $_SESSION['member_type'], $_SESSION['last_login']);
    unset($this->member_id, $this->username, $this->member_type, $this->last_login);
    return true;
  }

  /**
   * Load session data into object properties.
   * @return void
   */
  private function check_stored_login()
  {
    if (isset($_SESSION['member_id'])) {
      $this->member_id = $_SESSION['member_id'];
      $this->username = $_SESSION['username'] ?? null;
      $this->member_type = $_SESSION['member_type'] ?? null;
      $this->last_login = $_SESSION['last_login'] ?? null;
    }
  }

  /**
   * Get the member ID from session.
   * @return int|null
   */
  public function get_member_id()
  {
    return $this->member_id ?? null;
  }

  /**
   * Get the member type from session.
   * @return string|null
   */
  public function get_member_type()
  {
    return $this->member_type ?? null;
  }

  /**
   * Check if last login was recent enough to be valid.
   * @return bool
   */
  private function last_login_is_recent()
  {
    if (!isset($this->last_login)) {
      return false;
    }
    return ($this->last_login + self::MAX_LOGIN_AGE) >= time();
  }

  /**
   * Check if user is an admin.
   * @return bool
   */
  public function is_admin()
  {
    return $this->member_type === 'a';
  }

  /**
   * Check if user is a member.
   * @return bool
   */
  public function is_member()
  {
    return $this->member_type === 'm';
  }

  /**
   * Check if user is a generic (not logged in) user.
   * @return bool
   */
  public function is_generic()
  {
    return $this->member_type === 'g';
  }

  /**
   * Require that user is logged in, otherwise redirect to login page.
   * @return void
   */
  public function require_login()
  {
    if (!$this->is_logged_in()) {
      header("Location: " . url_for('/login.php'));
      exit;
    }
  }

  /**
   * Require that user is an admin, otherwise redirect to login page.
   * @return void
   */
  public function require_admin_login()
  {
    if (!$this->is_logged_in() || !$this->is_admin()) {
      header("Location: " . url_for('/login.php'));
      exit;
    }
  }

  /**
   * Require that user is a member or admin, otherwise redirect to login page.
   * @return void
   */
  public function require_member_login()
  {
    if (!$this->is_logged_in() || !($this->is_member() || $this->is_admin())) {
      header("Location: " . url_for('/login.php'));
      exit;
    }
  }

  /**
   * Require that user is a generic user (not logged in), otherwise redirect to birds index.
   * @return void
   */
  public function require_generic_user()
  {
    if ($this->is_logged_in()) {
      header("Location: " . url_for('/birds/index.php'));
      exit;
    }
  }

  /**
   * Set or get a flash message.
   * @param string $msg
   * @return bool|string
   */
  public function message($msg = "")
  {
    if (!empty($msg)) {
      $_SESSION['message'] = $msg;
      return true;
    }
    return $_SESSION['message'] ?? '';
  }

  /**
   * Clear flash message.
   * @return void
   */
  public function clear_message()
  {
    unset($_SESSION['message']);
  }
}
