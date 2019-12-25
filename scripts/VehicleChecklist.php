<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present -need type value comment in values
  if(!isset($_GET["vehicleNumber"]) || !isset($_GET["driver"]) || !isset($_GET["controller"]) || !isset($_GET["checkedBy"]) || !isset($_GET["date"]) || !isset($_GET["time"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  if(!isset($_GET["checklist"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "success"]));
    exit();
  }
  //Send Email
  $message = $twig->load("vehicleChecklist.html")->render(["vehicleNumber" => $_GET["vehicleNumber"], "driver" => $_GET["driver"], "controller" => $_GET["controller"], "checkedBy" => $_GET["checkedBy"], "date" => $_GET["date"], "time" => $_GET["time"], "checklist" => json_decode($_GET["checklist"])]);
  $headers = "From: noreply@capemedics.co.za\r\nContent-type: text/html;charset=UTF-8";
  mail("dillondiegopillay@gmail.com", "Vehicle Checklist Alert", $message, $headers);
  echo($twig->load("action-result.json")->render(["result" => "success"]));
?>
