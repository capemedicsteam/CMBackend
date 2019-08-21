<?php
  //Load Dependencies
  session_start();
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  if(!isset($_GET["email"]) || !isset($_GET["password"]))
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
  if($user->verifyPassword($_GET["password"]))
  {
    $_SESSION["user"] = $user->getUserID();
    echo($twig->load("user-login.json")->render(["type" => $user->getType()]));
    exit();
  }
  echo($twig->load("action-result.json")->render(["result" => "error_password_incorrect"]));

?>
