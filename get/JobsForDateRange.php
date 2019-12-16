<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  if(!isset($_GET["startDate"]) || !isset($_GET["endDate"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  $date = Common::toDate($_GET["startDate"]);
  $lastDate = Common::toDate($_GET["endDate"]);
  $count = 0;
  $jobs = array();
  if(!isset($_SESSION["userType"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_unauthorised"]));
    exit();
  }
  if($_SESSION["userType"] == "Admin")  //Authentication
  {
    $jobs = $entityManager->getRepository("Job")->findAll();
  }
  else if($_SESSION["userType"] == "Crew")
  {
    $crew_assignments = $entityManager->getRepository("CrewAssignment")->findBy(["CREW_ID" => $_SESSION["user"]]);
    foreach($crew_assignments as $assignment)
    {
      array_push($jobs, $entityManager->find("Job", $assignment->getJobId()));
    }
  }
  else  //Returns error and exits if neither Crew or Admin
  {
    echo($twig->load("action-result.json")->render(["result" => "error_unauthorised"]));
    exit();
  }
  $output = array();
  while($date <= $lastDate)
  {
    foreach($jobs as $job)
    {
      $booking = $entityManager->find("Booking", $job->getBookingId());
      $startDate = $booking->getProposedDate();
      $endDate = $startDate;
      if($booking->getType() == "e")
      {
        $event = $entityManager->find("BookingEvent", $booking->getBookingId());
        if($event->isBuildUpRequired())
        {
          $startDate = $event->getBuildUpStartDateTime();
        }
        else
        {
          $startDate = $event->getEventStartDateTime();
        }
        if($event->isStrikeRequired())
        {
          $endDate = $event->getStrikeEndDateTime();
        }
        else
        {
          $endDate = $event->getEventEndDateTime();
        }
      }
      else if($booking->getType() == "i")
      {
        $ifht = $entityManager->find("BookingIFHT", $booking->getBookingId());
        $startDate = $ifht->getFromDateTime();
        $endDate = $ifht->getToDateTime();
      }
      if($date > Common::decrementDate($startDate) && $date < Common::incrementDate($endDate))
      {
        $output[Common::toDateString($date)][$count]["id"] = $job->getJobId();
        $customer = $entityManager->find("Customer", $booking->getCustomerId());
        $output[Common::toDateString($date)][$count]["name"] = $customer->getCustomerName();
        $output[Common::toDateString($date)][$count]["surname"] = $customer->getCustomerSurname();
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
        $output[Common::toDateString($date)][$count]["type"] = $type;
        $count = $count + 1;
      }
  	}
    $date->modify("+1 day");
  }
  echo($twig->load("get-jobsForDateRange.json")->render(["data" => $output]));
?>
