<?php
  //Load Dependencies
  session_start();
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  if(!isset($_GET["id"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  $job = $entityManager->find("Job", $_GET["id"]);
  $booking = $entityManager->find("Booking", $job->getBookingId());
  $customer = $entityManager->find("Customer", $booking->getCustomerId());
  $type = ""; //Get Job Type
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
  $startDateTime = $booking->getProposedDate();
  $endDateTime = $startDateTime;
  if($booking->getType() == "e")  //Event date times
  {
    $event = $entityManager->find("BookingEvent", $booking->getBookingId());
    if($event->isBuildUpRequired())
    {
      $startDateTime = $event->getBuildUpStartDateTime();
    }
    else
    {
      $startDateTime = $event->getEventStartDateTime();
    }
    if($event->isStrikeRequired())
    {
      $endDateTime = $event->getStrikeEndDateTime();
    }
    else
    {
      $endDateTime = $event->getEventEndDateTime();
    }
  }
  else if($booking->getType() == "i") //IFHT date times
  {
    $ifht = $entityManager->find("BookingIFHT", $booking->getBookingId());
    $startDateTime = $ifht->getFromDateTime();
    $endDateTime = $ifht->getToDateTime();
  }
  $crew = array();
  $crew_assignments = $entityManager->getRepository("CrewAssignment")->findBy(["JOB_ID" => $job->getJobId()]);
  foreach($crew_assignments as $assignment)
  {
    $member = $entityManager->find("Crew", $assignment->getCrewId());
    $crew[$member->getCrewId()] = $member->getCrewName()." ".$member->getCrewSurname();
  }
  echo($twig->load("get-basicJobInfo.json")->render(["type" => $type, "name" => $customer->getCustomerName(), "surname" => $customer->getCustomerSurname(), "number" => $customer->getContactNumber(), "company" => $customer->getCompany(), "email" => $customer->getEmail(), "startDateTime" => Common::toDateTimeString($startDateTime), "endDateTime" => Common::toDateTimeString($endDateTime), "crewRequired" => $job->getCrewRequired(), "crew" => $crew]));
?>
