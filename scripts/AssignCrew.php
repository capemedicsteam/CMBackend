<?php
  //Load Dependencies
  session_start();
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present
  if(!isset($_GET["crew_id"]) || !isset($_GET["job_id"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  $assignment = new CrewAssignment($_GET["crew_id"], $_GET["job_id"]);
  $entityManager->persist($assignment);
  $entityManager->flush();
  echo($twig->load("action-result.json")->render(["result" => "success"]));
?>
