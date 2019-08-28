<?php
  //Load Dependencies
  session_start();
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present
  if(!isset($_GET["service"]) || !isset($_GET["airline"]) || !isset($_GET["flightNumber"]) || !isset($_GET["flightDepAirport"]) || !isset($_GET["flightArrAirport"]) || !isset($_GET["flightDate"]) || !isset($_GET["flightDepTime"]) || !isset($_GET["flightArrTime"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  //Get Customer
  $customer = $entityManager->find("Customer", $_SESSION["user"]);
  //Create booking
  $booking = new Booking($customer, Common::toDate($_GET["flightDate"]), "o");
  if(isset($_GET["account"]))
  {
    $booking->setAccount($_GET["account"]);
  }
  $entityManager->persist($booking);
  $entityManager->flush();
  //Create Airside Transfer
  $bookingOT = new BookingOrganTransfer($booking->getBookingId(), $_GET["service"], $_GET["airline"], $_GET["flightNumber"], $_GET["flightDepAirport"], $_GET["flightArrAirport"], Common::toDate($_GET["flightDate"]), Common::toTime($_GET["flightDepTime"]), Common::toTime($_GET["flightArrTime"]));
  $entityManager->persist($bookingOT);
  $entityManager->flush();
  echo($twig->load("action-result.json")->render(["result" => "success"]));
?>
