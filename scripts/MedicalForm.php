<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present -need type value comment in values
  if(!isset($_GET["jobId"]) || !isset($_GET["medicalForm"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  //Check for required patient data
  $data = json_decode($_GET["medicalForm"]);
  if(!isset($data["Patient Details"]["ID"]) || !isset($data["Patient Details"]["Full_name"]) || !isset($data["Patient Details"]["Surname"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  //Save File
  $file = fopen("../files/prf/".$_GET["jobId"]."_".$data["Patient Details"]["ID"]."_".$data["Patient Details"]["Full_name"]." ".$data["Patient Details"]["Surname"], "w");
  if($file == false)
  {
    echo($twig->load("action-result.json")->render(["result" => "error_additional_data"]));
    exit();
  }
  fwrite($file, $_GET["medicalForm"]);
  fclose($file);
  echo($twig->load("action-result.json")->render(["result" => "success"]));
?>
