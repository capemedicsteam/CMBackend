<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present
  if(!isset($_GET['id']) || !isset($_GET['time']))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  //Checkout
  $checkIn = $entityManager->find("CheckIn", $_GET["id"]);
  $checkIn->setCheckOutTime(Common::toTime($_GET["time"]));
  $entityManager->persist($checkIn);
  $entityManager->flush();
  //Return result
  echo($twig->load("action-result.json")->render(["result" => "success"]));
?>
