<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../inclusions/ConfigureTwig.php";
  if(!isset($_GET["surname"]) || !isset($_GET["name"]) || !isset($_GET["email"]) || !isset($_GET["message"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  $message = $twig->load("contact.html")->render(["name" => $_GET["name"], "surname" => $_GET["surname"], "email" => $_GET["email"], "message" => $_GET["message"]]);
  if(mail("pmphareng@gmail.com", "Contact Form", $message, "From: ".$_GET["email"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "success"]));
    exit();
  }


?>
