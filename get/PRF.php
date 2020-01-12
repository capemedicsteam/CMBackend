<?php
  //Load Dependencies
  session_start();
  header("Access-Control-Allow-Origin: *");
  require_once "../db/db-connection.php";
  require_once "../inclusions/ConfigureTwig.php";
  require_once "../inclusions/Common.php";
  require_once "../vendor/dompdf/autoload.inc.php";
  if(!isset($_GET["jobId"]) && !isset($_GET["patIdPassport"]) && !isset($_GET["patName"]) && !isset($_GET["pastSurname"]))
  {
    echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
    exit();
  }
  $filename = "../files/prf/";
  if(isset($_GET["jobId"]))
  {
    $filename = $filename.$_GET["jobId"]."*";
  }
  else
  {
    $filename = $filename."*";
  }
  if(isset($_GET["patIdPassport"]))
  {
    $filename = $filename.$_GET["patIdPassport"]."*";
  }
  else
  {
    $filename = $filename."*";
  }
  if(isset($_GET["patName"]))
  {
    $filename = $filename.$_GET["patName"]."*";
  }
  else
  {
    $filename = $filename."*";
  }
  if(isset($_GET["patSurname"]))
  {
    $filename = $filename.$_GET["patSurname"]."*";
  }
  else
  {
    $filename = $filename."*";
  }
  $files = glob($filename);
  if(sizeof($files) == 0)
  {
    echo($twig->load("action-result.json")->render(["result" => "file_not_found"]));
    exit();
  }
  foreach($files as $file)
  {
    $handle = fopen($file, "r");
    $data = unserialize(fread($handle, filesize($file)));
    fclose($handle);
    $dompdf = new Dompdf\Dompdf();
    $dompdf->loadHtml($twig->load("prf.html")->render(["form" => $data]));
    $dompdf->setPaper("A4", "portrait");
    $dompdf->render();
    $dompdf->stream($file));
  }
?>
