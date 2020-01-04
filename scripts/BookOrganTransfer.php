<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present
  if(!isset($_GET["service"]) || !isset($_GET["airline"]) || !isset($_GET["flightNumber"]) || !isset($_GET["flightDepAirport"]) || !isset($_GET["flightArrAirport"]) || !isset($_GET["flightDate"]) || !isset($_GET["flightDepTime"]) || !isset($_GET["flightArrTime"]))
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
  //Data to be written to file
  $exclusions = array("service", "airline", "flightNumber", "flightDepAirport", "flightArrAirport", "flightDate", "flightDepTime", "flightArrTime");
  $fileObject;
  foreach($_GET as $key => $value)
  {
    if(!in_array($key, $exclusions))
    {
        $fileObject[$key] = $value;
    }
  }
  if($fileObject != null)
  {
    $file = fopen("../files/booking_organ_transfer/".$bookingOT->getBookingId().".booking", "w");
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
  $data = ["Booking ID" => $bookingOT->getBookingId(), "Airline" => $_GET["airline"], "Plight Number" => $_GET["flightNumber"], "Departure Airport" => $_GET["flightDepAirport"], "Arrival Airport" => $_GET["flightArrAirport"], "Date" => $_GET["flightDate"], "Departure Time" => $_GET["flightDepTime"], "Arrival Time" => $_GET["flightArrTime"]];
  $message = $twig->load("booking.html")->render(["custName" => $customer->getCustomerName(), "custSurname" => $customer->getCustomerSurname(), "custNumber" => $customer->getContactNumber(), "custCompany" => $customer->getCompany(), "custEmail" => $customer->getEmail(), "type" => "Organ Transfer", "data" => $data]);
  mail($_GET["custEmail"], "Booking Created", $message, "From: noreply@capemedics.co.za");
?>
