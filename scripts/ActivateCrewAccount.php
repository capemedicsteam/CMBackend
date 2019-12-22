<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  if(!isset($_GET["email"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  $user = $entityManager->find("User", $_GET["email"]);
  if($user == null)
  {
    echo($twig->load("action-result.json")->render(["result" => "error_user_not_found"]));
    exit();
  }
  $user->setActive(true);
  $entityManager->persist($user);
  $entityManager->flush();
  echo($twig->load("action-result.json")->render(["result" => "success"]));

?>
