<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present -need type value comment in values
  if(!isset($_GET["licenceExpiryDate"]) || !isset($_GET["driver"]) || !isset($_GET["date"]) || !isset($_GET["time"]) || !isset($_GET["skid"]) || !isset($_GET["mileage"]) || !isset($_GET["fuel"]) || !isset($_GET["oils"]) || !isset($_GET["reg"]) || !isset($_GET["location"]) || !isset($_GET["production"]) || !isset($_GET["crew"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  if(!isset($_GET["checklist"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "success"]));
    exit();
  }
  if($_GET["checklist"] == "")
  {
    echo($twig->load("action-result.json")->render(["result" => "success"]));
    exit();
  }
  //Send Email
  $message = $twig->load("VehicleChecklistFire.html")->render(["expiry" => $_GET["licenceExpiryDate"], "driver" => $_GET["driver"], "date" => $_GET["date"], "time" => $_GET["time"], "skid" => $_GET["skid"], "mileage" => $_GET["milage"], "fuel" => $_GET["fuel"], "oils" => $_GET["oils"], "reg" => $_GET["reg"], "location" => $_GET["location"], "production" => $_GET["production"], "crew" => $_GET["crew"], "checklist" => json_decode($_GET["checklist"])]);
  $headers = "From: noreply@capemedics.co.za\r\nContent-type: text/html;charset=UTF-8";
  mail("dillondiegopillay@gmail.com", "Vehicle Checklist Alert", $message, $headers);
  echo($twig->load("action-result.json")->render(["result" => "success"]));
?>
