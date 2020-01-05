<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  if(!isset($_GET["id"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  $crew = $entityManager->find("Crew", $_GET["id"]);
  echo($twig->load("get-crewMember.json")->render(["id" => $_GET["id"], "name" => $crew->getCrewName(), "surname" => $crew->getCrewSurname(), "dob" => Common::toDateString($crew->getDateOfBirth()), "email" => $crew->getEmail(), "number" => $crew->getContactNumber(), "idPassport" => $crew->getIdPassportNumber(), "address" => $crew->getAddress(), "areaCode" => $crew->getAreaCode(), "nokName" => $crew->getNextOfKinName(), "nokNumber" => $crew->getNextOfKinContactNumber(), "race" => $crew->getRace(), "gender" => $crew->getGender(), "married" => $crew->isMarried(), "disabled" => $crew->isDisabled(), "bankAccountHolderName" => $crew->getBankAccountHolderName(), "bankName" => $crew->getBankName(), "bankBranch" => $crew->getBankBranch(), "bankBranchCode" => $crew->getBankBranchCode(), "taxRef" => $crew->getTaxRefNumber(), "typeFire" => $crew->isFire(), "typeSafety" => $crew->isSafety(), "typeMedical" => $crew->isMedical(), "fireCertNumber" => $crew->getFireCertificateNumber(), "hpscaNumber" => $crew->getHPSCANumber(), "saioshNumber" => $crew->getSAIOSHNumber(), "idFile" => $crew->getIdFilePath(), "documentFiles"=> $crew->getDocumentFilePaths()]));
?>
