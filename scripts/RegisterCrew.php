<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  //Check if all required data is present
  if(!isset($_GET['name']) || !isset($_GET['surname']) || !isset($_GET['dob']) || !isset($_GET["email"]) || !isset($_GET['number']) || !isset($_GET['idPassport']) || !isset($_GET['address']) || !isset($_GET['areaCode']) || !isset($_GET['nokName']) || !isset($_GET['nokNumber']) || !isset($_GET['race']) || !isset($_GET['gender']) || !isset($_GET['married']) || !isset($_GET['disabled']) || !isset($_GET['bankAccountHolderName']) || !isset($_GET['bankAccountNumber']) || !isset($_GET['bankName']) || !isset($_GET['bankBranch']) || !isset($_GET['bankBranchCode']) || !isset($_GET['taxRef']) || !isset($_GET['typeFire']) || !isset($_GET['typeSafety']) || !isset($_GET['typeMedical']) || !isset($_GET['fireCertNumber']) || !isset($_GET['hpscaNumber']) || !isset($_GET['saioshNumber']) || !isset($_GET['idFile']) || !isset($_GET['password']))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  //Create Crew
  $crew = new Crew($_GET["name"], $_GET["surname"], Common::toDate($_GET["dob"]), $_GET["email"], $_GET['number'], $_GET["idPassport"], $_GET["address"], $_GET["areaCode"], $_GET["nokName"],  $_GET["nokNumber"], $_GET["race"], $_GET["gender"], $_GET["married"], $_GET["disabled"], $_GET["bankAccountHolderName"], $_GET["bankAccountNumber"], $_GET["bankName"], $_GET["bankBranch"], $_GET["bankBranchCode"], $_GET["taxRef"], $_GET["typeFire"], $_GET["typeSafety"], $_GET["typeMedical"], $_GET["fireCertNumber"], $_GET["hpscaNumber"], $_GET["saioshNumber"], null, null);
  $entityManager->persist($crew);
  $entityManager->flush();
  //Upload ID
  $idFile = unserialize($_GET["idFile"])[0];
  $idFileName = $crew->getCrewId()."_".$idFile;
  $crew->setIdFilepath($idFileName);
  if(!copy("../files/temp/".$idFile, "../files/crew/".$idFileName))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_file"]));
    exit();
  }
  unlink("../files/temp/".$idFile);
  //Upload other documents (if required)
  if(isset($_GET["documentFiles"]))
  {
    $documentFiles = unserialize($_GET["documentFiles"]);
    $count = count($documentFiles);
    for($i = 0 ; $i < $count ; $i++)
    {
      $documentFilename = $crew->getCrewId()."_".$documentFiles[$i];
      $documentFilenames[$i] = $documentFilename;
      if(!copy("../files/temp/".$documentFiles[$i], "../files/crew/".$documentFilename))
      {
        echo($twig->load("action-result.json")->render(["result" => "error_file"]));
        exit();
      }
      unlink("../files/temp/".$documentFiles[$i]);
    }
    $crew->setDocumentFilepaths(serialize($documentFilenames));
  }
  $entityManager->persist($crew);
  //Check if email address has already been used
  if($entityManager->find("User", $_GET["email"]) != null)
  {
    echo($twig->load("action-result.json")->render(["result" => "error_duplicate_email"]));
    exit();
  }
  //Create user
  $user = new User($_GET['email'], $_GET['password'], "Crew", $crew->getCrewId());
  $user->setActive(false);
  $entityManager->persist($user);
  $entityManager->flush();
  //Return result
  echo($twig->load("action-result.json")->render(["result" => "success"]));
?>
