<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present
  if(!isset($_GET["longDistance"]) || !isset($_GET["fromLocationType"]) || !isset($_GET["fromAddress"]) || !isset($_GET["fromDateTime"]) || !isset($_GET["toLocationType"]) || !isset($_GET["toAddress"]) || !isset($_GET["toDateTime"]) || !isset($_GET["patName"]) || !isset($_GET["patSurname"]) || !isset($_GET["patIdPassport"]) || !isset($_GET["patCaseRef"]) || !isset($_GET["patNationality"]))
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
  //Create IFHT
  $bookingIFHT = new BookingIFHT($booking->getBookingId(), $_GET["longDistance"], $_GET["fromLocationType"], $_GET["fromAddress"], Common::toDateTime($_GET["fromDateTime"]), $_GET["toLocationType"], $_GET["toAddress"], Common::toDateTime($_GET["toDateTime"]), null, null, $_GET["patName"], $_GET["patSurname"], $_GET["patIdPassport"], $_GET["patCaseRef"], $_GET["patNationality"]);
  if(isset($_GET["returnTrip"]))
  {
    $bookingIFHT.setReturnTrip($_GET["returnTrip"]);
  }
  if(isset($_GET["returnTime"]))
  {
    $bookingIFHT.setReturnTime(Common::toTime($_GET["returnTime"]));
  }
  $entityManager->persist($bookingIFHT);
  $entityManager->flush();
  //Data to be written to file
  $exclusions = array("longDistance", "fromLocationType", "fromAddress", "fromDateTime", "toLocationType", "toAddress", "toDateTime", "patName", "patSurname", "patIdPassport", "patCaseRef", "patNationality", "returnTrip", "returnTime");
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
    $file = fopen("../files/booking_ifht/".$bookingIFHT->getBookingId().".booking", "w");
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
  $data = ["Booking ID" => $bookingIFHT->getBookingId(), "Pickup Facility Type" => $_GET["fromLocationType"], "Pickup Facility Address" => $_GET["fromAddress"], "Pickup Time" => $_GET["fromDateTime"], "Arrival Facility Type" => $_GET["toLocationType"], "Arrival Facility Address" => $_GET["toAddress"], "Arrival Time" => $_GET["toDateTime"], "Patient Name" => $_GET["patName"], "Patient Surname" => $_GET["patSurname"], "Patient ID/Passport Number" => $_GET["patIdPassport"], "Case Reference Number" => $_GET["patCaseRef"], "Patient Nationality" => $_GET["patNationality"], "Return Time" => $bookingIFHT->getReturnTime()];
  $message = $twig->load("booking.html")->render(["custName" => $customer->getCustomerName(), "custSurname" => $customer->getCustomerSurname(), "custNumber" => $customer->getContactNumber(), "custCompany" => $customer->getCompany(), "custEmail" => $customer->getEmail(), "type" => "Inter Facility/Hospital Transfer", "data" => $data]);
  mail($customer->getEmail(), "Booking Created", $message, "From: noreply@capemedics.co.za\r\nContent-type: text/html;charset=UTF-8");
?>
