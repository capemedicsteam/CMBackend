<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present
  if(!isset($_GET['email']))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  //Find user
  $user = $entityManager->find("User", $_GET["email"]);
  if($user == null)
  {
    echo($twig->load("action-result.json")->render(["result" => "error_user_not_found"]));
    exit();
  }
  $password = Common::randomString(10);
  $user->setPassword($password);
  $entityManager->persist($user);
  $entityManager->flush();
  $message = $twig->load("passwordReset.html")->render(["pass" => $password]);
  $headers = "From: noreply@capemedics.co.za\r\nContent-type: text/html;charset=UTF-8";
  if(!mail($_GET["email"], "Password Reset", $message, $headers))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_mail"]));
    exit();
  }
  //Return result
  echo($twig->load("action-result.json")->render(["result" => "success"]));
?>
