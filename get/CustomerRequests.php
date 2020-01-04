<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  $users = $entityManager->getRepository("User")->findBy(["TYPE" => "Customer", "ACTIVE" => "0"]);
  $count = 0;
  foreach($users as $user)
  {
    $member = $entityManager->find("Customer", $user->getUserID());
    $output[$count]["id"] = $member->getCustomerId();
    $output[$count]["name"] = $member->getCustomerName();
    $output[$count]["surname"] = $member->getCustomerSurname();
    $output[$count]["number"] = $member->getContactNumber();
    $output[$count]["company"] = $member->getCompany();
    $output[$count]["email"] = $member->getEmail();
  }
  echo($twig->load("get-customerRequests.json")->render(["customers" => $output]));
?>
