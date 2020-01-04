<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present
  if(!isset($_GET['id']) || !isset($_GET["location"]) || !isset($_GET['date']) || !isset($_GET['time']))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  //Create CheckIn
  $crew = $entityManager->find("Crew", $_SESSION["user"]);
  $job = $entityManager->find("Job", $_GET["id"]);
  $checkIn = new CheckIn($crew, $job, $_GET["location"], Common::toDate($_GET["date"]), Common::toTime($_GET['time']));
  $entityManager->persist($checkIn);
  $entityManager->flush();
  //Return result
  echo($twig->load("checkIn.json")->render(["result" => "success", "id" => $checkIn->getCheckInId()]));
?>
