<?php 

class Database
{
  public static function connToDB()
  {

    $conn = new PDO("mysql:dbname=".DATABASE.";host=".HOSTNAME, USERNAME, PASSWORD);
    
    return $conn;

  }
}

?>