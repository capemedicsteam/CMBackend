<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Authenticate
  if(!($_SESSION["userType"] == "Admin" || $_SESSION["userType"] == "Crew"))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_unauthorised"]));
    exit();
  }
  if(!isset($_GET["id"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  $booking = $entityManager->find("Booking", $_GET["id"]);
  $customer = $entityManager->find("Customer", $booking->getCustomerId());
  $proposedDate = Common::toDateString($booking->getProposedDate());
  $type = $booking->getType();
  $confirmed = $booking->isConfirmed();
  $account = $booking->isAccount();
  $filename = $filename = "";
  switch($type)
  {

    case "a": $specificBooking = $entityManager->find("BookingAirsideTransfer", $_GET["id"]);
              $details["flightType"] = $specificBooking->getFlightType();
              $details["flightDate"] = Common::toDateString($specificBooking->getFlightDate());
              $details["flightNumber"] = $specificBooking->getFlightNumber;
              $details["flightDepAirport"] = $specificBooking->getFlightDepartureAirport();
              $details["flightArrAirport"] = $specificBooking->getFlightArrivalAirport();
              $details["flightDepTime"] = Common::toTimeString($specificBooking->getFlightDepartureTime());
              $details["flightArrTime"] = Common::toTimeString($specificBooking->getFlightArrivalTime());
              $details["flightTerminalType"] = $specificBooking->getFlightTerminalType();
              $details["careLevel"] = $specificBooking->getCareLevel();
              $details["patName"] = $specificBooking->getPatientName();
              $details["patSurname"] = $specificBooking->getPatientSurname();
              $details["patIdPassport"] = $specificBooking->getPatientIdPassportNumber();
              $details["patCaseRef"] = $specificBooking->getPatientCaseReferenceNumber();
              $details["flightEscortRequired"] = $specificBooking->isFlightMedicalEscortRequired();
              $details["ambulanceEscortRequired"] = $specificBooking->isAmbulanceEscortRequired();
              $details["longDistance"] = $specificBooking->isGroundAmbulanceTravelDistanceGreaterThan100km();
              $details["ambulanceDepFacility"] = $specificBooking->getGroundAmbulanceDepartureFacility();
              $details["ambulanceDepFacilityTime"] = Common::toTimeString($specificBooking->getGroundAmbulanceDepartureFacilityPickupTime());
              $details["ambulanceArrFacility"] = $specificBooking->getGroundAmbulanceArrivalFacility();
              $details["ambulanceArrFacilityTime"] = Common::toTimeString($specificBooking->getGroundAmbulanceArrivalAirportPickupTime());
              $filename = "../files/booking_airside_transfer/".$_GET["id"].".booking";
              break;
    case "e": $specificBooking = $entityManager->find("BookingEvent", $_GET["id"]);
              $details["eventType"] = $specificBooking->getEventType();
              $details["eventStartDateTime"] = Common::toDateTimeString($specificBooking->getEventStartDateTime());
              $details["eventEndDateTime"] = Common::toDateTimeString($specificBooking->getEventEndDateTime());
              $details["location"] = $specificBooking->getLocation();
              $details["eventName"] = $specificBooking->getEventName();
              $details["pax"] = $specificBooking->getPax();
              $details["description"] = $specificBooking->getDescription();
              $details["buRequired"] = $specificBooking->isBuildUpRequired();
              $details["buStartDateTime"] = Common::toDateTimeString($specificBooking->getBuildUpStartDateTime());
              $details["buEndDateTime"] = Common::toDateTimeString($specificBooking->getBuildUpEndDateTime());
              $details["strikeRequired"] = $specificBooking->isStrikeRequired();
              $details["strikeStartDateTime"] = Common::toDateTimeString($specificBooking->getStrikeStartDateTime());
              $details["strikeEndDateTime"] = Common::toDateTimeString($specificBooking->getStrikeEndDateTime());
              $details["eventNature"] = $specificBooking->getEventNature();
              $details["attendeesSSB"] = $specificBooking->getAttendeesStandSeatBoth();
              $details["expectedNumbers"] = $specificBooking->getExpectedNumbers();
              $details["toy"] = $specificBooking->getTimeOfYear();
              $details["venue"] = $specificBooking->getVenue();
              $details["attendeesType"] = $specificBooking->getAttendeesType();
              $details["eventDuration"] = $specificBooking->getExpectedEventDuration();
              $filename = "../files/booking_event/".$_GET["id"].".booking";
              break;
    case "i": $specificBooking = $entityManager->find("BookingIFHT", $_GET["id"]);
              $details["longDistance"] = $specificBooking->isTravelMoreThan100km();
              $details["fromLocationType"] = $specificBooking->getFromLocationType();
              $details["fromAddress"] = $specificBooking->getFromAddress();
              $details["fromDateTime"] = Common::toDateTimeString($specificBooking->getFromDateTime());
              $details["toLocationType"] = $specificBooking->getToLocationType();
              $details["toAddress"] = $specificBooking->getToAddress();
              $details["toDateTime"] = $specificBooking->getToDateTime();
              $details["returnTrip"] = $specificBooking->isReturnTrip();
              $details["returnTime"] = Common::toTimeString($specificBooking->getReturnTime());
              $details["patName"] = $specificBooking->getPatientName();
              $details["patSurname"] = $specificBooking->getPatientSurname();
              $details["patIdPassport"] = $specificBooking->getPatientIdPassportNumber();
              $details["patCaseRef"] = $specificBooking->getPatientCaseReferenceNumber();
              $details["patNationality"] = $specificBooking->getPatientNationality();
              $filename = "../files/booking_ifht/".$_GET["id"].".booking";
              break;
    case "o": $specificBooking = $entityManager->find("BookingOrganTransfer", $_GET["id"]);
              $details["service"] = $specificBooking->getService();
              $details["airline"] = $specificBooking->getAirline();
              $details["flightNumber"] = $specificBooking->getFlightNumber();
              $details["flightDepAirport"] = $specificBooking->getDepartureAirport();
              $details["flightArrAirport"] = $specificBooking->getArrivalAirport();
              $details["flightDate"] = Common::toDateString($specificBooking->getFlightDate());
              $details["flightDepTime"] = Common::toTimeString($specificBooking->getDepartureTime());
              $details["flightArrTime"] = Common::toTimeString($specificBooking->getArrivalTime());
              $filename = "../files/booking_organ_transfer/".$_GET["id"].".booking";
              break;
    case "t": $specificBooking = $entityManager->find("BookingTV", $_GET["id"]);
              $details["type"] = $specificBooking->getType();
              $details["projectName"] = $specificBooking->getProjectName();
              $details["dateTime"] = Common::toDateTimeString($specificBooking->getDateTime());
              $details["location"] = $specificBooking->getLocation();
              $details["unitType"] = $specificBooking->getUnitType();
              $filename = "../files/booking_tv/".$_GET["id"].".booking";
              break;
    default: $details = "";
  }
  $additionalData = "";
  if(file_exists($filename))
  {
    $handle = fopen($filename, "r");
    $data = fread($handle, filesize($filename));
    fclose($handle);
    $additionalData = unserialize($data);
  }
  echo($twig->load("get-booking.json")->render(["id" => $_GET["id"], "custName" => $customer->getCustomerName(), "custSurname" => $customer->getCustomerSurname(), "custNumber" => $customer->getContactNumber(), "custEmail" => $customer->getEmail(), "custCompany" => $customer->getCompany(), "proposedDate" => $proposedDate, "type" => $type, "confirmed" => $confirmed, "account" => $account, "details" => $details, "additionalData" => $additionalData]));
?>
