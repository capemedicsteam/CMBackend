<?php
  //Load Dependencies
  session_sart();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  //Check if all required data is present
  if(!isset($_GET['password']) || !isset($_GET['newPassword']))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  //Authenticate
  if(!isset($_SESSION["email"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_unauthorised"]));
    exit();
  }
  $user = $entityManager->find("User", $_SESSION["email"]);
  if(!$user->verifyPassword($_GET["password"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_password_incorrect"]));
    exit();
  }
  //Change password
  $user->setPassword($_GET["newPassword"]);
  $entityManager->persist($user);
  $entityManager->flush();
  //Return result
  echo($twig->load("action-result.json")->render(["result" => "success"]));
?>
