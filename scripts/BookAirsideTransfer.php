<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present
  if(!isset($_GET["flightType"]) || !isset($_GET["flightDate"]) || !isset($_GET["flightNumber"]) || !isset($_GET["flightDepAirport"]) || !isset($_GET["flightArrAirport"]) || !isset($_GET["flightDepTime"]) || !isset($_GET["flightArrTime"]) || !isset($_GET["flightTerminalType"]) || !isset($_GET["careLevel"]) || !isset($_GET["patName"]) || !isset($_GET["patSurname"]) || !isset($_GET["patIdPassport"]) || !isset($_GET["patCaseRef"]))
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
  $booking = new Booking($customer, Common::toDate($_GET["flightDate"]), "a");
  if(isset($_GET["account"]))
  {
    $booking->setAccount($_GET["account"]);
  }
  $entityManager->persist($booking);
  $entityManager->flush();
  //Create Airside Transfer
  $bookingAT = new BookingAirsideTransfer($booking->getBookingId(), $_GET["flightType"], Common::toDate($_GET["flightDate"]), $_GET["flightNumber"], $_GET["flightDepAirport"], $_GET["flightArrAirport"], Common::toTime($_GET["flightDepTime"]), Common::toTime($_GET["flightArrTime"]), $_GET["flightTerminalType"], $_GET["careLevel"], $_GET["patName"], $_GET["patSurname"], $_GET["patIdPassport"], $_GET["patCaseRef"]);
  if(isset($_GET["flightEscortRequired"]))
  {
    $bookingAT->setFlightMedicalEscortRequired($_GET["flightEscortRequired"]);
  }
  if(isset($_GET["ambulanceEscortRequired"]))
  {
    $bookingAT->setAmbulanceEscortRequired($_GET["ambulanceEscortRequired"]);
  }
  if(isset($_GET["longDistance"]))
  {
    $bookingAT->setGroundAmbulanceTravelDistanceGreaterThan100km($_GET["longDistance"]);
  }
  if(isset($_GET["ambulanceDepFacility"]))
  {
    $bookingAT->setGroundAmbulanceDepartureFacility($_GET["ambulanceDepFacility"]);
  }
  if(isset($_GET["ambulanceDepFacilityTime"]))
  {
    $bookingAT->setGroundAmbulanceDepartureFacilityPickupTime(Common::toTime($_GET["ambulanceDepFacilityTime"]));
  }
  if(isset($_GET["ambulanceArrFacility"]))
  {
    $bookingAT->setGroundAmbulanceArrivalFacility($_GET["ambulanceArrFacility"]);
  }
  if(isset($_GET["ambulanceArrFacilityTime"]))
  {
    $bookingAT->setGroundAmbulanceArrivalAirportPickupTime(Common::toTime($_GET["ambulanceArrFacilityTime"]));
  }
  $entityManager->persist($bookingAT);
  $entityManager->flush();
  //Data to be written to file
  $exclusions = array("flightType", "flightDate", "flightNumber", "flightDepAirport", "flightArrAirport", "flightDepTime", "flightArrTime", "flightTerminalType", "careLevel", "patName", "patSurname", "patIdPassport", "patCaseRef", "account", "flightEscortRequired", "ambulanceEscortRequired", "longDistance", "ambulanceDepFacility", "ambulanceDepFacilityTime", "ambulanceArrFaciliy", "ambulanceArrFacilityTime");
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
    $file = fopen("../files/booking_airside_transfer/".$bookingAT.getBookingId().".booking", "w");
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
  $data = ["Booking ID" => $bookingAT->getBookingId(), "Flight Type" => $_GET["flightType"], "Flight Date" => $_GET["flightDate"], "Flight Number" => $_GET["flightNumber"], "Departure Airport" => $_GET["flightDepAirport"], "Arrival Airport" => $_GET["flightArrAirport"], "Departure Time" => $_GET["flightDepTime"], "Arrival Time" => $_GET["flightArrTime"], "Patient Name" => $_GET["patName"], "Patient Surname" => $_GET["patSurname"], "Patient ID/Passport Number" => $_GET["patIdPassport"], "Case Reference Number" => $_GET["patCaseRef"], "Ground Ambulance Departure Facility" => $bookingAT->getGroundAmbulanceDepartureFacility, "Ground Ambulance Departure Pickup Time" => $bookingAT->getGroundAmbulanceDepartureFacilityPickupTime(), "Ground Ambulance Arrival Facility" => $bookingAT->getGroundAmbulanceArrivalFacility, "Ground Ambulance Arrival Pickup Time" => $bookingAT->getGroundAmbulanceArrivalAirportPickupTime()];
  $message = $twig->load("booking.html")->render(["custName" => $customer->getCustomerName(), "custSurname" => $customer->getCustomerSurname(), "custNumber" => $customer->getContactNumber(), "custCompany" => $customer->getCompany(), "custEmail" => $customer->getEmail(), "type" => "Airside Transfer", "data" => $data]);
  mail($_GET["custEmail"], "Booking Created", $message, "From: noreply@capemedics.co.za");
?>
