<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present -need type value comment in values
  if(!isset($_GET["jobId"]) || !isset($_GET["patIdPassport"]) || !isset($_GET["patName"]) || !isset($_GET["patSurname"]) || !isset($_GET["answers"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  //Save File
  $file = fopen("../files/prf/".$_GET["jobId"]."_".$_GET["patIdPassport"]."_".$_GET["patName"]." ".$_GET["patSurname"], "w");
  if($file == false)
  {
    echo($twig->load("action-result.json")->render(["result" => "error_additional_data"]));
    exit();
  }
  fwrite($file, $_GET["answers"]);
  fclose($file);
  echo($twig->load("action-result.json")->render(["result" => "success"]));
?>
