<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  require_once "../vendor/dompdf/autoload.inc.php";
  if(!isset($_GET["id"]) || !isset($_GET["start_date"]) || !isset($_GET["end_date"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  $checkIns = $entityManager->getRepository("CheckIn")->findBy(["CREW_ID" => $_GET["id"]], ["CHECK_IN_DATE" => "ASC", "CHECK_IN_TIME" => "ASC", "CHECK_OUT_TIME" =>"ASC"]);
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
      $output[$count]["id"] = $checkIn->getJobId();
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
  $crew = $entityManager->find("Crew", $_GET["id"]);
  $name = $crew->getCrewName()." ".$crew->getCrewSurname();
  $dompdf = new Dompdf\Dompdf();
  $dompdf->loadHtml($twig->load("timeSheetReport.html")->render(["name" => $name, "startDate" => $_GET["start_date"], "endDate" => $_GET["end_date"], "checkIns" => $output]));
  $dompdf->setPaper("A4", "portrait");
  $dompdf->render();
  $dompdf->stream(str_replace("/", "-", $name.": ".$_GET["start_date"]." - ".$_GET["end_date"].".pdf"));
?>
