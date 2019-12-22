<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
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
  if(!$user->isActive())
  {
    echo($twig->load("action-result.json")->render(["result" => "error_account_inactive"]));
    exit();
  }
  if($user->verifyPassword($_GET["password"]))
  {
    $_SESSION["email"] = $user->getEmail();
    $_SESSION["user"] = $user->getUserID();
    $_SESSION["userType"] = $user->getType();
    $name = "admin";
    $surname = "admin";
    if($_SESSION["userType"] == "Crew")
    {
      $crew = $entityManager->find("Crew", $_SESSION["user"]);
      $name = $crew->getCrewName();
      $surname = $crew->getCrewSurname();
    }
    else if($_SESSION["userType"] == "Customer")
    {
      $customer = $entityManager->find("Customer", $_SESSION["user"]);
      $name = $customer->getCustomerName();
      $surname = $customer->getCustomerSurname();
    }
    echo($twig->load("user-login.json")->render(["type" => $user->getType(), "name" => $name, "surname" => $surname, "id" => $_SESSION["user"]]));
    exit();
  }
  echo($twig->load("action-result.json")->render(["result" => "error_password_incorrect"]));

?>
