<?php
  function openDBConnection()
  {
    $server = "remotemysql.com";
    $username = "dDsScbv5Ai";
    $password = "database@host2019"
    $database = "dDsScbv5Ai";
    return new mysqli($server, $username, $password, $database);
  }
  $conn = openDBConnection();
?>
