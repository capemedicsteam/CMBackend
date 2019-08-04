<?php
  require_once("../db/db-connection.php");
  $customer = new Customer("Dillon", "Pillay", "084 915 7900", "GCX", "email");
  $entityManager->persist($customer);
  $entityManager->flush();
  echo("Customer created.");
?>
