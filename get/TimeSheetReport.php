<?php
  //Load Dependencies
  session_start();
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  require_once "../vendor/dompdf/autoload.inc.php";
  if(!isset($_GET["id"]) || !isset($_GET["start_date"]) || !isset($_GET["end_date"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  $checkIns = $entityManager->getRepository("CheckIn")->findBy(["CREW_ID" => $_GET["id"]]);
  $startDate = Common::decrementDate(Common::toDate($_GET["start_date"]));
  $endDate = Common::incrementDate(Common::toDate($_GET["end_date"]));
  $count = 0;
  $output = array();
  foreach($checkIns as $checkIn)
  {
    $checkInDate = $checkIn->getDate();
    if($checkInDate > $startDate && $checkInDate < $endDate)
    {
      $output[$count]["id"] = $checkIn->getCheckInId();
      $output[$count]["date"] = Common::toDateString($checkIn->getDate());
      $output[$count]["timeIn"] = Common::toTimeString($checkIn->getCheckInTime());
      $output[$count]["timeOut"] = Common::toTimeString($checkIn->getCheckOutTime());
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
