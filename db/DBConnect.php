<?php
class DBConnect {

    // specify your own database credentials
    private $con;

    function __construct() {

    }

    function connect() {
      include_once dirname(__FILE__) . '\Constants.php';

      $this->con = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

      if (mysqli_connect_errno()) {
        echo "Fallo a conectar a MySQL: " .mysqli_connect_error();
        return null;
      }

     return $this->con;
    }

}

?>
