<?php
/**
* Admin Session Administrator
* Manages the current SESSION
*/
class AdminSessionAdministrator {

  /**
   * @return boolean
   */
  public function existSession( ) {

    if(isset($_SESSION['login_user'])){

      return true;

    }

    return false;
  }

  /**
   * @param $username
   */
  public function startSession( $username ) {

    session_start(); // Starting Session
    $_SESSION['login_user']=$username; // Initializing Session

  }

  /**
   * @return boolean
   */
  public function terminateSession( ) {

    session_start();

    if(session_destroy()){ // Destroying All Sessions

      return true;

    }
    else{

      return false;

    }

  }

}
?>
