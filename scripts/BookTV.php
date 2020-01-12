<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present
  if(!isset($_GET["type"]) || !isset($_GET["projectName"]) || !isset($_GET["dateTime"]) || !isset($_GET["location"]) || !isset($_GET["unitType"]))
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
  $booking = new Booking($customer, Common::toDate($_GET["date"]), "t");
  $entityManager->persist($booking);
  $entityManager->flush();
  //Create TV
  $bookingTV = new BookingTV($booking->getBookingId(), $_GET["type"], $_GET["projectName"], Common::toDateTime($_GET["dateTime"]), $_GET["location"], $_GET["unitType"]);
  $entityManager->persist($bookingTV);
  $entityManager->flush();
  //Data to be written to file
  $exclusions = array("type", "projectName", "dateTime", "location", "unitType", "custName", "custSurname", "custNumber", "custCompany", "custEmail");
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
    $file = fopen("../files/booking_tv/".$bookingTV->getBookingId().".booking", "w");
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
  $data = ["Booking ID" => $bookingTV->getBookingId(), "Subtype" => $_GET["type"], "Project Name" => $_GET["projectName"], "Date" => $_GET["dateTime"], "Location" => $_GET["location"], "Unit Type" => $_GET["unitType"]];
  $message = $twig->load("booking.html")->render(["custName" => $customer->getCustomerName(), "custSurname" => $customer->getCustomerSurname(), "custNumber" => $customer->getContactNumber(), "custCompany" => $customer->getCompany(), "custEmail" => $customer->getEmail(), "type" => "TV", "data" => $data]);
  mail($customer->getEmail(), "Booking Created", $message, "From: noreply@capemedics.co.za\r\nContent-type: text/html;charset=UTF-8");
?>
