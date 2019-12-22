<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present
  if(!isset($_GET["eventType"]) || !isset($_GET["eventStartDateTime"]) || !isset($_GET["eventEndDateTime"]) || !isset($_GET["location"]) || !isset($_GET["eventName"]) || !isset($_GET["pax"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  //Get or create customer
  if(isset($_SESSION["user"]))
  {
    $customer = $entityManager->find("Customer", $_SESSION["user"]);
  }
  else
  {
    if(!isset($_GET["custName"]) || !isset($_GET["custSurname"]) || !isset($_GET["custNumber"]) || !isset($_GET["custCompany"]) || !isset($_GET["custEmail"]))
    {
      echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
      exit();
    }
    $customer = new Customer($_GET["custName"], $_GET["custSurname"], $_GET["custNumber"], $_GET["custCompany"], $_GET["custEmail"]);
    $entityManager->persist($customer);
    $entityManager->flush();
  }
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
  //Data to be written to file
  $exclusions = array("eventType", "eventStartDateTime", "eventEndDateTime", "location", "eventName", "pax", "description", "buRequired", "buStartDateTime", "buEndDateTime", "strikeRequired", "strikeStartDateTime", "strikeEndDateTime", "eventNature", "attendeesSSB", "expectedNumbers", "toy", "venue", "attendeesType", "eventDuration");
  $fileObject;
  foreach($_GET as $key => $value)
  {
    if(!in_array($key, $exclusions))
    {
        $fileObject[$key] = $value;
    }
  }
  if(isset($fileObject != null))
  {
    $file = fopen("../files/booking_event/".$bookingAT.getBookingId().".booking", "w");
    if($file == false)
    {
      echo($twig->load("action-result.json")->render(["result" => "error_additional_data"]));
      exit();
    }
    fwrite($file, serialize($fileObject));
    fclose($file);
  }
  echo($twig->load("action-result.json")->render(["result" => "success"]));
  //Add info to array for email
  $data = ["Booking ID" => $bookingEvent->getBookingId(), "Event Type" => $_GET["eventType"], "Start" => $_GET["eventStartDateTime"], "End" => $_GET["eventEndDateTime"], "Location" => $_GET["location"], "Event Name" => $_GET["eventName"], "Pax" => $_GET["pax"], "Description" => $_GET["description"], "Build Up Start" => $_GET["buStartDateTime"], "Build Up End" => $_GET["buEndDateTime"], "Strike Start" => $_GET["strikeStartDateTime"], "Strike End" => $_GET["strikeEndDateTime"], "Nature" => $bookingEvent->getEventNature(), "Attendees Standing/Seated" => $bookingEvent->getAttendeesStandSeatBoth(), "Expected Numbers" => $bookingAT->getExpectedNumbers(), "Season" => $bookingEvent->getTimeOfYear(), "venue" => $bookingEvent->getVenue(), "Type of Attendees" => $bookingEvent->getAttendeesType(), "Duration" => $bookingEvent->getExpectedEventDuration()];
  $message = $twig->load("booking.html")->render(["custName" => $customer->getCustomerName(), "custSurname" => $customer->getCustomerSurname(), "custNumber" => $customer->getContactNumber(), "custCompany" => $customer->getCompany(), "custEmail" => $customer->getEmail(), "type" => "Event", "data" => $data]);
  mail($_GET["custEmail"], "Booking Created", $message, "From: noreply@capemedics.co.za");
?>
