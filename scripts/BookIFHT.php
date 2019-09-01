<?php
  //Load Dependencies
  session_start();
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
  $bookingIFHT = new BookingIFHT($booking->getBookingId(), $_GET["longDistance"], $_GET["fromLocationType"], $_GET["fromAddress"], Common::toDateTime($_GET["fromDateTime"]), $_GET["toLocationType"], $_GET["toAddress"], Common::toDateTime($_GET["toDateTime"], null, null, $_GET["patName"], $_GET["patSurname"], $_GET["patIdPassport"], $_GET["patCaseRef"], $_GET["patNationality"]);
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
?>
