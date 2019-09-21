<?php
  //Load Dependencies
  session_start();
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  $bookings = $entityManager->getRepository("Booking")->findAll();
  $count = 0;
  foreach($bookings as $booking)
  {
    $customer = $entityManager->find("Customer", $booking->getCustomerId());
    $output[$count]["id"] = $booking->getBookingId();
    $output[$count]["name"] = $customer->getCustomerName();
    $output[$count]["number"] = $customer->getContactNumber();
    $output[$count]["email"] = $customer->getEmail();
    $output[$count]["date"] = Common::toDateString($booking->getProposedDate());
    switch($booking->getType())
    {
      case "a": $output[$count]["type"] = "Airside Transfer";
      break;
      case "e": $output[$count]["type"] = "Event";
      break;
      case "i": $output[$count]["type"] = "IFT/IHT";
      break;
      case "o": $output[$count]["type"] = "Organ Transfer";
      break;
      case "t": $output[$count]["type"] = "Film/Commercial";
      break;
      default: $output[$count]["type"] = $booking->getType();
      break;
    }
    if($booking->isConfirmed())
    {
      $output[$count]["status"] = "Confirmed";
    }
    else
    {
      $output[$count]["status"] = "Unconfirmed";
    }
    if($booking->isAccount())
    {
      $output[$count]["account"] = "Yes";
    }
    else
    {
      $output[$count]["account"] = "No";
    }
    $count = $count + 1;
  }
  echo($twig->load("allBookings.json")->render(["bookings" => $output]));
?>
