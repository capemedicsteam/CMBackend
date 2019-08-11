<?php
  //Load Dependencies
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  //Check if all required data is present
  if(!isset($_GET['name']) || !isset($_GET['surname']) || !isset($_GET['email']) || !isset($_GET['company']) || !isset($_GET['number']) || !isset($_GET['password']))
  {
    echo($twig->load("action-result.json")->render(["result" => "failure"]));
    exit();
  }
  //Create customer
  $customer = new Customer($_GET["name"], $_GET["surname"], $_GET["number"], $_GET['company'], $_GET["email"]);
  $entityManager->persist($customer);
  $entityManager->flush();
  //Create user
  $user = new User($_GET['email'], $_GET['password'], "Customer", $customer->getCustomerId());
  $entityManager->persist($user);
  $entityManager->flush();
  //Return result
  echo($twig->load("action-result.json")->render(["result" => "success"]));
?>
