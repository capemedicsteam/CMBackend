<?php
  session_start();
  session_destroy();
  header("Access-Control-Allow-Origin: *");
  require_once "../inclusions/ConfigureTwig.php";
  echo($twig->load("action-result.json")->render(["result" => "success"]));
?>
