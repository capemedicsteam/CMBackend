<?php
  echo("Hey");
  include 'db-connection.php';
if($conn->connect_error)
{
echo("Connection error: ".$conn->connect_error);
}


  if($conn->query("INSERT INTO tbl_users (EMAIL, PASSWORD, TYPE, USER_ID) VALUES ('EMAIL', 'PASS', 'TYPE', 454)") === true)
{
echo("works");
}
else
{
echo("Error: ".$conn->error);
}
?>
