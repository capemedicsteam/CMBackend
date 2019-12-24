<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present
  if(!isset($_GET["id"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  $jobAssignments = $entityManager->getRepository("CrewAssignment")->findBy(["CREW_ID" => $_GET["id"]]);
  $count = 0;
  $output = array();
  foreach($jobAssignments as $assignment)
  {
    $job = $entityManager->find("Job", $assignment->getJobId());
    $booking = $entityManager->find("Booking", $job->getBookingId());
    $customer = $entityManager->find("Customer", $booking->getCustomerId());
    $output[$count]["id"] = $job->getJobId();
    $output[$count]["name"] = $customer->getCustomerName();
    $output[$count]["surname"] = $customer->getCustomerSurname();
    $type = "";
    switch($booking->getType())
    {
      case "a": $type = "Airside Transfer";
      break;
      case "e": $type = "Event";
      break;
      case "i": $type = "IFT/IHT";
      break;
      case "o": $type = "Organ Transfer";
      break;
      case "t": switch($entityManager->find("BookingTV", $booking->getBookingId())->getType())
                {
                  case "c": $type = "Commercial";
                  break;
                  case "f": $type = "Film";
                  break;
                  default: $type = "Commercial/Film";
                  break;
                }
        break;
        default: $type = $booking->getType();
        break;
    }
    $output[$count]["type"] = $type;
    $output[$count]["date"] = Common::toDateString($booking->getProposedDate());
    $count = $count + 1;
  }
  echo($twig->load("get-jobsForCrew.json")->render(["jobs" => $output]));
?>
