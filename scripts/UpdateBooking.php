<?php
  //Load Dependencies
  session_start();
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present
  if(!isset($_GET["id"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  $booking = $entityManager->find("Booking", $_GET["id"]);
  if(isset($_GET["confirmed"]))
  {
    $booking->setConfirmed($_GET["confirmed"]);
  }
  if(isset($_GET["account"]))
  {
    $booking->setAccount($_GET["account"]);
  }
  //Update specific booking object and file
  $specificBooking;
  $exclusions = array("id", "account", "flightType", "flightDate", "flightNumber", "flightDepAirport", "flightArrAirport", "flightDepTime", "flightArrTime", "flightTerminalType", "careLevel", "patName", "patSurname", "patIdPassport", "patCaseRef", "patNationality", "flightEscortRequired", "ambulanceEscortRequired", "longDistance", "ambulanceDepFacility", "ambulanceDepFacilityTime", "ambulanceArrFaciliy", "ambulanceArrFacilityTime", "eventType", "eventStartDateTime", "eventEndDateTime", "location", "eventName", "pax", "description", "buRequired", "buStartDateTime", "buEndDateTime", "strikeRequired", "strikeStartDateTime", "strikeEndDateTime", "attendeesSSB", "expectedNumbers", "toy", "venue", "attendeesType", "eventDuration", "longDistance", "fromLocationType", "fromAddress", "fromDateTime", "toLocationType", "toAddress", "toDateTime", "returnTrip", "returnTime", "service", "airline", "type", "projectName", "dateTime", "unitType");
  switch($booking->getType())
  {
    case "a": $specificBooking = $entityManager->find("BookingAirsideTransfer", $_GET["id"]);
              if(isset($_GET["flightType"]))
              {
                $specificBooking->setFlightType($_GET["flightType"]);
              }
              if(isset($_GET["flightDate"]))
              {
                $date = Common::toDate($_GET["flightDate"]);
                $booking->setProposedDate($date);
                $specificBooking->setFlightDate($date);
              }
              if(isset($_GET["flightNumber"]))
              {
                $specificBooking->setFlightNumber($_GET["flightNumber"]);
              }
              if(isset($_GET["flightDepAirport"]))
              {
                $specificBooking->setFlightDepartureAirport($_GET["flightDepAirport"]);
              }
              if(isset($_GET["flightArrAirport"]))
              {
                $specificBooking->setFlightArrivalAirport($_GET["flightArrAirport"]);
              }
              if(isset($_GET["flightDepTime"]))
              {
                $specificBooking->setFlightDepartureTime(Commmon::toTime($_GET["flightDepTime"]));
              }
              if(isset($_GET["flightArrTime"]))
              {
                $specificBooking->setFlightArrivalTime(Common::toTime($_GET["flightArrTime"]));
              }
              if(isset($_GET["flightTerminalType"]))
              {
                $specificBooking->setFlightTerminalType($_GET["flightTerminalType"]);
              }
              if(isset($_GET["careLevel"]))
              {
                $specificBooking->setCareLevel($_GET["careLevel"]);
              }
              if(isset($_GET["patName"]))
              {
                $specificBooking->setPatientName($_GET["patName"]);
              }
              if(isset($_GET["patSurname"]))
              {
                $specificBooking->setPatientSurname($_GET["patSurname"]);
              }
              if(isset($_GET["patIdPassport"]))
              {
                $specificBooking->setPatientIdPassportNumber($_GET["patIdPassport"]);
              }
              if(isset($_GET["patCaseRef"]))
              {
                $specificBooking->setPatientCaseReferenceNumber($_GET["patCaseRef"]);
              }
              if(isset($_GET["flightEscortRequired"]))
              {
                $specificBooking->setFlightMedicalEscortRequired($_GET["flightEscortRequired"]);
              }
              if(isset($_GET["ambulanceEscortRequired"]))
              {
                $specificBooking->setAmbulanceEscortRequired($_GET["ambulanceEscortRequired"]);
              }
              if(isset($_GET["longDistance"]))
              {
                $specificBooking->setGroundAmbulanceTravelDistanceGreaterThan100km($_GET["longDistance"]);
              }
              if(isset($_GET["ambulanceDepFacility"]))
              {
                $specificBooking->setGroundAmbulanceDepartureFacility($_GET["ambulanceDepFacility"]);
              }
              if(isset($_GET["ambulanceDepFacilityTime"]))
              {
                $specificBooking->setGroundAmbulanceDepartureFacilityPickupTime(Common::toTime($_GET["ambulanceDepFacilityTime"]));
              }
              if(isset($_GET["ambulanceArrFaciliy"]))
              {
                $specificBooking->setGroundAmbulanceArrivalFacility($_GET["ambulanceArrFaciliy"]);
              }
              if(isset($_GET["ambulanceArrFacilityTime"]))
              {
                $specificBooking->setGroundAmbulanceArrivalAirportPickupTime(Common::toTime($_GET["ambulanceArrFacilityTime"]));
              }
              //File
              $fileObjectUpdate = null;
              foreach($_GET as $key => $value)
              {
                if(!in_array($key, $exclusions))
                {
                    $fileObjectUpdate[$key] = $value;
                }
              }
              if($fileObjectUpdate != null) //Only if there are other parameters
              {
                $file = fopen("../files/booking_airside_transfer/".$booking->getBookingId().".booking", "r");
                if($file == "false")  //If file doesn't exist
                {
                  $file = fopen("../files/booking_airside_transfer/".$booking->getBookingId().".booking", "w");
                  if($file == "false")
                  {
                    echo($twig->load("action-result.json")->render(["result" => "error_additional_data"]));
                    exit();
                  }
                  fwrite($file)->serialize($fileObjectUpdate);
                }
                else  //If file already exists
                {
                  $fileObject = unserialize($fread($file, filesize($file)));
                  foreach($fileObjectUpdate as $key => $value)
                  {
                    $fileObject[$key] = $value;
                  }
                  fwrite($file)->serialize($fileObject);
                }
                fclose($file);
              }
    break;
    case "e": $specificBooking = $entityManager->find("BookingEvent", $_GET["id"]);
              if(isset($_GET["eventType"]))
              {
                $specificBooking->setEventType($_GET["eventType"]);
              }
              if(isset($_GET["eventStartDateTime"]))
              {
                $datetime = Common::toDateTime($_GET["eventStartDateTime"]);
                $booking->setProposedDate($datetime);
                $specificBooking->setEventStartDateTime($datetime);
              }
              if(isset($_GET["eventEndDateTime"]))
              {
                $specificBooking->setEventEndDateTime($_GET["eventEndDateTime"]);
              }
              if(isset($_GET["location"]))
              {
                $specificBooking->setLocation($_GET["location"]);
              }
              if(isset($_GET["eventName"]))
              {
                $specificBooking->setEventName($_GET["eventName"]);
              }
              if(isset($_GET["pax"]))
              {
                $specificBooking->setPax($_GET["pax"]);
              }
              if(isset($_GET["description"]))
              {
                $specificBooking->setDescription($_GET["description"]);
              }
              if(isset($_GET["buRequired"]))
              {
                $specificBooking->setBuildUpRequired($_GET["buRequired"]);
              }
              if(isset($_GET["buStartDateTime"]))
              {
                $specificBooking->setBuildUpStartDateTime(Common::toDateTime($_GET["buStartDateTime"]));
              }
              if(isset($_GET["buEndDateTime"]))
              {
                $specificBooking->setBuildUpEndDateTime(Common::toDateTime($_GET["buEndDateTime"]));
              }
              if(isset($_GET["strikeRequired"]))
              {
                $specificBooking->setStrikeRequired($_GET["strikeRequired"]);
              }
              if(isset($_GET["strikeStartDateTime"]))
              {
                $specificBooking->setStrikeStartDateTime(Common::toDateTime($_GET["strikeStartDateTime"]));
              }
              if(isset($_GET["strikeEndDateTime"]))
              {
                $specificBooking->setStrikeEndDateTime(Common::toDateTime($_GET["strikeEndDateTime"]));
              }
              if(isset($_GET["attendeesSSB"]))
              {
                $specificBooking->setAttendeesStandSeatBoth($_GET["attendeesSSB"]);
              }
              if(isset($_GET["expectedNumbers"]))
              {
                $specificBooking->setExpectedNumbers($_GET["expectedNumbers"]);
              }
              if(isset($_GET["toy"]))
              {
                $specificBooking->setTimeOfYear($_GET["toy"]);
              }
              if(isset($_GET["venue"]))
              {
                $specificBooking->setVenue($_GET["venue"]);
              }
              if(isset($_GET["attendeesType"]))
              {
                $specificBooking->setAttendeesType($_GET["attendeesType"]);
              }
              if(isset($_GET["eventDuration"]))
              {
                $specificBooking->setExpectedEventDuration($_GET["eventDuration"]);
              }
              //File
              $fileObjectUpdate = null;
              foreach($_GET as $key => $value)
              {
                if(!in_array($key, $exclusions))
                {
                    $fileObjectUpdate[$key] = $value;
                }
              }
              if($fileObjectUpdate != null) //Only if there are other parameters
              {
                $file = fopen("../files/booking_event/".$booking->getBookingId().".booking", "r");
                if($file == "false")  //If file doesn't exist
                {
                  $file = fopen("../files/booking_event/".$booking->getBookingId().".booking", "w");
                  if($file == "false")
                  {
                    echo($twig->load("action-result.json")->render(["result" => "error_additional_data"]));
                    exit();
                  }
                  fwrite($file)->serialize($fileObjectUpdate);
                }
                else  //If file already exists
                {
                  $fileObject = unserialize($fread($file, filesize($file)));
                  foreach($fileObjectUpdate as $key => $value)
                  {
                    $fileObject[$key] = $value;
                  }
                  fwrite($file)->serialize($fileObject);
                }
                fclose($file);
              }
    break;
    case "i": $specificBooking = $entityManager->find("BookingIFHT", $_GET["id"]);
              if(isset($_GET["longDistance"]))
              {
                $specificBooking->setTravelMoreThan100km($_GET["longDistance"]);
              }
              if(isset($_GET["fromLocationType"]))
              {
                $specificBooking->setFromLocationType($_GET["fromLocationType"]);
              }
              if(isset($_GET["fromAddress"]))
              {
                $specificBooking->setFromAddress($_GET["fromAddress"]);
              }
              if(isset($_GET["fromDateTime"]))
              {
                $datetime = Common::toDateTime($_GET["fromDateTime"]);
                $booking->setProposedDate($datetime);
                $specificBooking->setFromDateTime($datetime);
              }
              if(isset($_GET["toLocationType"]))
              {
                $specificBooking->setToLocationType($_GET["toLocationType"]);
              }
              if(isset($_GET["toAddress"]))
              {
                $specificBooking->setToAddress($_GET["toAddress"]);
              }
              if(isset($_GET["toDateTime"]))
              {
                $specificBooking->setToDateTime(Common::toDateTime($_GET["toDateTime"]));
              }
              if(isset($_GET["patName"]))
              {
                $specificBooking->setPatientName($_GET["patName"]);
              }
              if(isset($_GET["patSurname"]))
              {
                $specificBooking->setPatientSurname($_GET["patSurname"]);
              }
              if(isset($_GET["patIdPassport"]))
              {
                $specificBooking->setPatientIdPassportNumber($_GET["patIdPassport"]);
              }
              if(isset($_GET["patCaseRef"]))
              {
                $specificBooking->setPatientCaseReferenceNumber($_GET["patCaseRef"]);
              }
              if(isset($_GET["patNationality"]))
              {
                $specificBooking->setPatientNationality($_GET["patNationality"]);
              }
              if(isset($_GET["returnTrip"]))
              {
                $specificBooking->setReturnTrip($_GET["returnTrip"]);
              }
              if(isset($_GET["returnTime"]))
              {
                $specificBooking->setReturnTime($_GET["returnTime"]);
              }
              //File
              $fileObjectUpdate = null;
              foreach($_GET as $key => $value)
              {
                if(!in_array($key, $exclusions))
                {
                    $fileObjectUpdate[$key] = $value;
                }
              }
              if($fileObjectUpdate != null) //Only if there are other parameters
              {
                $file = fopen("../files/booking_ifht/".$booking->getBookingId().".booking", "r");
                if($file == "false")  //If file doesn't exist
                {
                  $file = fopen("../files/booking_ifht/".$booking->getBookingId().".booking", "w");
                  if($file == "false")
                  {
                    echo($twig->load("action-result.json")->render(["result" => "error_additional_data"]));
                    exit();
                  }
                  fwrite($file)->serialize($fileObjectUpdate);
                }
                else  //If file already exists
                {
                  $fileObject = unserialize($fread($file, filesize($file)));
                  foreach($fileObjectUpdate as $key => $value)
                  {
                    $fileObject[$key] = $value;
                  }
                  fwrite($file)->serialize($fileObject);
                }
                fclose($file);
              }
    break;
    case "o": $specificBooking = $entityManager->find("BookingOrganTransfer", $_GET["id"]);
              if(isset($_GET["service"]))
              {
                $specificBooking->setService($_GET["service"]);
              }
              if(isset($_GET["airline"]))
              {
                $specificBooking->setAirline($_GET["airline"]);
              }
              if(isset($_GET["flightNumber"]))
              {
                $specificBooking->setFlightNumber($_GET["flightNumber"]);
              }
              if(isset($_GET["flightDepAirport"]))
              {
                $specificBooking->setDepartureAirport($_GET["flightDepAirport"]);
              }
              if(isset($_GET["flightArrAirport"]))
              {
                $specificBooking->setArrivalAirport($_GET["flightArrAirport"]);
              }
              if(isset($_GET["flightDate"]))
              {
                $date = Common::toDate($_GET["flightDate"]);
                $booking->setProposedDate($date);
                $specificBooking->setFlightDate($date);
              }
              if(isset($_GET["flightDepTime"]))
              {
                $specificBooking->setDepartureTime(Common::toTime($_GET["flightDepTime"]));
              }
              if(isset($_GET["flightArrTime"]))
              {
                $specificBooking->setArrivalTime(Common::toTime($_GET["flightArrTime"]));
              }
              //File
              $fileObjectUpdate = null;
              foreach($_GET as $key => $value)
              {
                if(!in_array($key, $exclusions))
                {
                    $fileObjectUpdate[$key] = $value;
                }
              }
              if($fileObjectUpdate != null) //Only if there are other parameters
              {
                $file = fopen("../files/booking_organ_transfer/".$booking->getBookingId().".booking", "r");
                if($file == "false")  //If file doesn't exist
                {
                  $file = fopen("../files/booking_organ_transfer/".$booking->getBookingId().".booking", "w");
                  if($file == "false")
                  {
                    echo($twig->load("action-result.json")->render(["result" => "error_additional_data"]));
                    exit();
                  }
                  fwrite($file)->serialize($fileObjectUpdate);
                }
                else  //If file already exists
                {
                  $fileObject = unserialize($fread($file, filesize($file)));
                  foreach($fileObjectUpdate as $key => $value)
                  {
                    $fileObject[$key] = $value;
                  }
                  fwrite($file)->serialize($fileObject);
                }
                fclose($file);
              }
    break;
    case "t": $specificBooking = $entityManager->find("BookingTV", $_GET["id"]);
              if(isset($_GET["type"]))
              {
                $specificBooking->setType($_GET["type"]);
              }
              if(isset($_GET["projectName"]))
              {
                $specificBooking->setProjectName($_GET["projectName"]);
              }
              if(isset($_GET["dateTime"]))
              {
                $datetime = Common::toDateTime($_GET["dateTime"]);
                $booking->setProposedDate($datetime);
                $specificBooking->setDateTime($datetime);
              }
              if(isset($_GET["location"]))
              {
                $specificBooking->setLocation($_GET["location"]);
              }
              if(isset($_GET["unitType"]))
              {
                $specificBooking->setUnitType($_GET["unitType"]);
              }
              //File
              $fileObjectUpdate = null;
              foreach($_GET as $key => $value)
              {
                if(!in_array($key, $exclusions))
                {
                    $fileObjectUpdate[$key] = $value;
                }
              }
              if($fileObjectUpdate != null) //Only if there are other parameters
              {
                $file = fopen("../files/booking_tv/".$booking->getBookingId().".booking", "r");
                if($file == "false")  //If file doesn't exist
                {
                  $file = fopen("../files/booking_tv/".$booking->getBookingId().".booking", "w");
                  if($file == "false")
                  {
                    echo($twig->load("action-result.json")->render(["result" => "error_additional_data"]));
                    exit();
                  }
                  fwrite($file)->serialize($fileObjectUpdate);
                }
                else  //If file already exists
                {
                  $fileObject = unserialize($fread($file, filesize($file)));
                  foreach($fileObjectUpdate as $key => $value)
                  {
                    $fileObject[$key] = $value;
                  }
                  fwrite($file)->serialize($fileObject);
                }
                fclose($file);
              }
    break;
    default: echo($twig->load("action-result.json")->render(["result" => "error_invalid_booking_type"]));
             exit();
  }
  //Persist changes
  $entityManager->persist($booking);
  $entityManager->persist($specificBooking);
  $entityManager->flush();
  echo($twig->load("action-result.json")->render(["result" => "success"]));
?>
