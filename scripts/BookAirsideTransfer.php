<?php
  //Load Dependencies
  session_start();
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present
  if(!isset($_GET["flightType"]) || !isset($_GET["flightDate"]) || !isset($_GET["flightNumber"]) || !isset($_GET["flightDepAirport"]) || !isset($_GET["flightArrAirport"]) || !isset($_GET["flightDepTime"]) || !isset($_GET["flightArrTime"]) || !isset($_GET["flightTerminalType"]) || !isset($_GET["careLevel"]) || !isset($_GET["patName"]) || !isset($_GET["patSurname"]) || !isset($_GET["patIdPassport"]) || !isset($_GET["patCaseRef"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  //Get Customer
  $customer = $entityManager->find("Customer", $_SESSION["user"]);
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
    $bookingAT->setGroundAmbulanceArrivalFacilityPickupTime(Common::toTime($_GET["ambulanceArrFacilityTime"]));
  }
  $entityManager->persist($bookingAT);
  $entityManager->flush();
  //Data to be written to file
  if(isset($_GET["extraInfo"]))
  {
    $file = fopen("../files/booking_airside_transfer/".$bookingAT.getBookingId().".booking", "w");
    if($file == false)
    {
      echo($twig->load("action-result.json")->render(["result" => "error_additional_data"]));
      exit();
    }
    fwrite($file, serialize($_GET["extraInfo"]));
    fclose("extraInfo");
    $fileData["extraInfo"] = $_GET["extraInfo"];
  }
  echo($twig->load("action-result.json")->render(["result" => "success"]));
?>
