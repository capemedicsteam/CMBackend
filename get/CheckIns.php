<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  require_once "../vendor/dompdf/autoload.inc.php";
  if(!isset($_GET["start_date"]) || !isset($_GET["end_date"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  $checkIns = $entityManager->getRepository("CheckIn")->orderBy(["CHECK_IN_DATE" => "ASC", "CHECK_IN_TIME" => "ASC", "CHECK_OUT_TIME" =>"ASC"]);
  $startDate = Common::toDate($_GET["start_date"]);
  $endDate = Common::toDate($_GET["end_date"]);
	date_time_set($startDate, 0, 0);
	date_time_set($endDate, 0, 0);
  $count = 0;
  $output = array();
  foreach($checkIns as $checkIn)
  {
    $checkInDate = $checkIn->getDate();
    if($checkInDate >= $startDate && $checkInDate <= $endDate)
    {
      $output[$count]["id"] = $checkIn->getCheckInId();
      $crewId = $checkIn->getCrewId();
      $output[$count]["crewId"] = $crewId;
      $crew = $entityManager->find("Crew", $crewId);
      $output[$count]["crewName"] = $crew->getCrewName();
      $output[$count]["crewSurname"] = $crew->getCrewSurname();
      $output[$count]["jobId"] = $checkIn->getJobId();
      $output[$count]["location"] = $checkIn->getLocation();
      $output[$count]["date"] = Common::toDateString($checkIn->getDate());
      $output[$count]["timeIn"] = Common::toTimeString($checkIn->getCheckInTime());
      $checkOutTime = $checkIn->getCheckOutTime();
      if($checkOutTime == null)
      {
        $output[$count]["timeOut"] = "Not checked out";
      }
      else
      {
        $output[$count]["timeOut"] = Common::toTimeString($checkOutTime);
      }
      $count = $count + 1;
    }
  }
  echo($twig->load("get-checkIns.json")->render(["checkIns" => $output]));
