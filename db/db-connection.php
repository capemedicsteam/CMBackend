<?php
  function openDBConnection()
  {
    $server = "remotemysql.com";
    $username = "dDsScbv5Ai";
    $password = "pFCtiZ0AnC";
    $database = "dDsScbv5Ai";
    return new mysqli($server, $username, $password, $database);
  }
  $conn = openDBConnection();
?>
