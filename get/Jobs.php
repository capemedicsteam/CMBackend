<?php
  //Load Dependencies
  session_start();
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  $jobs = $entityManager->getRepository("Job")->findAll();
  $count = 0;
  $output = array();
  foreach($jobs as $job)
  {
    $booking = $entityManager->find("Booking", $job->getBookingId());
    $customer = $entityManager->find("Customer", $booking->getCustomerId());
    $output[$count]["id"] = $job->getJobId();
    $output[$count]["name"] = $customer->getCustomerName();
    $output[$count]["surname"] = $customer->getCustomerSurname();
    $output[$count]["number"] = $customer->getContactNumber();
    $output[$count]["email"] = $customer->getEmail();
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
    $output[$count]["crew"] = $job->getCrewRequired();
    $count = $count + 1;
  }
  echo($twig->load("get-jobs.json")->render(["jobs" => $output]));
?>
