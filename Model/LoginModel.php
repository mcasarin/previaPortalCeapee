<?php
  require_once(__dir__ . '/Db.php');
  class LoginModel extends Db {

    /**
      * @param string
      * @return array
      * @desc Returns a user record based on the method parameter....
    **/
    public function fetchEmail(string $email) :array
    {
      $this->query("SELECT * FROM `db_user` WHERE `email` = :email");
      $this->bind('email', $email);
      $this->execute();

      $Email = $this->fetch();
      if (empty($Email)) {
        $Response = array(
          'status' => true,
          'data' => $Email
        );

        return $Response;
      }

      if (!empty($Email)) {
        $Response = array(
          'status' => false,
          'data' => $Email
        );

        return $Response;
      }
    }
  }
 ?>
