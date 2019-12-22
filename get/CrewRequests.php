<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  $users = $entityManager->getRepository("User")->findBy(["ACTIVE" => "0"]);
  $count = 0;
  foreach($users as $user)
  {
    $member = $entityManager->find("Crew", $user->getUserID());
    $output[$count]["id"] = $member->getCrewId();
    $output[$count]["name"] = $member->getCrewName();
    $output[$count]["surname"] = $member->getCrewSurname();
    $output[$count]["number"] = $member->getContactNumber();
    $output[$count]["email"] = $member->getEmail();
    $qualification = "";
    if($member->isFire())
    {
      $qualification = $qualification."Fire/";
    }
    if($member->isSafety())
    {
      $qualification = $qualification."Safety/";
    }
    if($member->isMedical())
    {
      $qualification = $qualification."Medical/";
    }
    if(strlen($qualification) == 0)
    {
      $qualification = "None/";
    }
    $output[$count]["qualification"] = substr_replace($qualification, "", -1);
    $count = $count + 1;
  }
  echo($twig->load("get-crew.json")->render(["crew" => $output]));
?>
