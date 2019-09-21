<?php
  //Load Dependencies
  session_start();
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  $customers = $entityManager->getRepository("Customer")->findAll();
  $count = 0;
  foreach($customers as $customer)
  {
    $output[$count]["id"] = $customer->getCustomerId();
    $output[$count]["name"] = $customer->getCustomerName();
    $output[$count]["surname"] = $customer->getCustomerSurname();
    $output[$count]["number"] = $customer->getContactNumber();
    $output[$count]["company"] = $customer->getCompany();
    $output[$count]["email"] = $customer->getEmail();
    $output[$count]["balance"] = $customer->getBalance();
    $output[$count]["bookings"] = array();
    $sql = "SELECT BOOKING_ID FROM tbl_bookings WHERE CUSTOMER_ID = ".$customer->getCustomerId();
    $query = $entityManager->getConnection()->prepare($sql);
    $query->execute();
    $bookings = $query->fetchAll();
    $output[$count]["bookings"] = count($bookings);
    $count = $count + 1;
  }
  echo($twig->load("get-customers.json")->render(["customers" => $output]));
?>
