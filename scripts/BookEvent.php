<?php
  //Load Dependencies
  session_start();
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present
  if(!isset($_GET["eventType"]) || !isset($_GET["eventStartDateTime"]) || !isset($_GET["eventEndDateTime"]) || !isset($_GET["location"]) || !isset($_GET["eventName"]) || !isset($_GET["pax"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  //Get Customer
  $customer = $entityManager->find("Customer", $_SESSION["user"]);
  //Create booking
  $booking = new Booking($customer, Common::toDateTime($_GET["eventStartDateTime"]), "e");
  if(isset($_GET["account"]))
  {
    $booking->setAccount($_GET["account"]);
  }
  $entityManager->persist($booking);
  $entityManager->flush();
  //Create Event
  $bookingEvent = new BookingEvent($booking->getBookingId(), $_GET["eventType"], Common::toDateTime($_GET["eventStartDateTime"]), Common::toDateTime($_GET["eventEndDateTime"]), $_GET["location"], $_GET["eventName"], $_GET["pax"]);
  if(isset($_GET["description"]))
  {
    $bookingEvent->setDescription($_GET["description"]);
  }
  if(isset($_GET["buRequired"]))
  {
    $bookingEvent->setBuildUpRequired($_GET["buRequired"]);
  }
  if(isset($_GET["buStartDateTime"]))
  {
    $bookingEvent->setBuildUpStartDateTime(Common::toDateTime($_GET["buStartDateTime"]));
  }
  if(isset($_GET["buEndDateTime"]))
  {
    $bookingEvent->setBuildUpEndDateTime(Common::toDateTime($_GET["buEndDateTime"]));
  }
  if(isset($_GET["strikeRequired"]))
  {
    $bookingEvent->setStrikeRequired($_GET["strikeRequired"]);
  }
  if(isset($_GET["strikeStartDateTime"]))
  {
    $bookingEvent->setStrikeStartDateTime(Common::toDateTime($_GET["strikeStartDateTime"]));
  }
  if(isset($_GET["strikeEndDateTime"]))
  {
    $bookingEvent->setStrikeEndDateTime(Common::toDateTime($_GET["strikeEndDateTime"]));
  }
  if(isset($_GET["eventNature"]))
  {
    $bookingEvent->setEventNature($_GET["eventNature"]);
  }
  if(isset($_GET["attendeesSSB"]))
  {
    $bookingEvent->setAttendeesStandSeatBoth($_GET["attendeesSSB"]);
  }
  if(isset($_GET["expectedNumbers"]))
  {
    $bookingEvent->setExpectedNumbers($_GET["expectedNumbers"]);
  }
  if(isset($_GET["toy"]))
  {
    $bookingEvent->setTimeOfYear($_GET["toy"]);
  }
  if(isset($_GET["venue"]))
  {
    $bookingEvent->setVenue($_GET["venue"]);
  }
  if(isset($_GET["attendeesType"]))
  {
    $bookingEvent->setAttendeesType($_GET["attendeesType"]);
  }
  if(isset($_GET["eventDuration"]))
  {
    $bookingEvent->setExpectedEventDuration($_GET["eventDuration"]);
  }
  $entityManager->persist($bookingEvent);
  $entityManager->flush();
  echo($twig->load("action-result.json")->render(["result" => "success"]));
?>
