<?php
  require_once "db/db-connection.php";

  return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);

?>
