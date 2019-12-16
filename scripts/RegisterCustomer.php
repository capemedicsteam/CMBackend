<?php
  //Load Dependencies
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  //Check if all required data is present
  if(!isset($_GET['name']) || !isset($_GET['surname']) || !isset($_GET['email']) || !isset($_GET['company']) || !isset($_GET['number']) || !isset($_GET['password']))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  //Create customer
  $customer = new Customer($_GET["name"], $_GET["surname"], $_GET["number"], $_GET['company'], $_GET["email"]);
  $entityManager->persist($customer);
  $entityManager->flush();
  //Check if email address has already been used
  if($entityManager->find("Customer", $_GET["email"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_duplicate_email"]));
    exit();
  }
  //Create user
  $user = new User($_GET['email'], $_GET['password'], "Customer", $customer->getCustomerId());
  $entityManager->persist($user);
  $entityManager->flush();
  //Return result
  echo($twig->load("action-result.json")->render(["result" => "success"]));
?>
