<?php
	//Load Dependencies
	session_start();
	header("Access-Control-Allow-Origin: *");
	//Configure Twig manually in main.php since it is in the root folder
	require_once "vendor/autoload.php";
	$loader = new \Twig\Loader\FilesystemLoader('json');
  $twig = new \Twig\Environment($loader, [
      'cache' => '../twig-cache',
  ]);
	//Check if required parameters are present
  if(!isset($_POST['request_type']) || !isset($_POST['target']))
  {
		echo($twig->load("action-result.json")->render(["result" => "error_incomplete_data"]));
		exit();
  }
	//Check request type
	if($_POST['request_type'] == "script")
	{
		//Script authorisation and data transfer
		$none = array("RegisterCustomer", "RegisterCrew", "Login", "ChangePassword", "ResetPassword", "Contact", "Logout");	//ChangePassword is authenticated in situ
		$customer = array("BookAirsideTransfer", "BookEvent", "BookIFHT", "BookOrganTransfer", "BookTV");
		$crew = array("VehicleChecklistAmbulance", "VehicleChecklistFire" "PRF", "CheckIn", "CheckOut");
		$admin = array("UpdateBooking", "AssignCrew", "ActivateAccount");
		$target = $_POST["target"];	//For substr to work
		if(in_array($_POST["target"], $customer))
		{
			if($_SESSION["userType"] != "Customer" && substr($target, 0, 4) != "Book")	//Bookings can be made without logging in
			{
				echo($twig->load("action-result.json")->render(["result" => "error_unauthorised"]));
				exit();
			}
		}
		else if(in_array($_POST["target"], $crew))
		{
			if($_SESSION["userType"] != "Crew")
			{
				echo($twig->load("action-result.json")->render(["result" => "error_unauthorised"]));
				exit();
			}
		}
		else if(in_array($_POST["target"], $admin))
		{
			if($_SESSION["userType"] != "Admin")
			{
				echo($twig->load("action-result.json")->render(["result" => "error_unauthorised"]));
				exit();
			}
		}
		else if(!in_array($_POST['target'], $none))
		{
			echo($twig->load("action-result.json")->render(["result" => "error_invalid_target"]));
			exit();
		}
		//Data
		$header = "Location: scripts/".$_POST['target'].".php?";
		foreach($_POST as $key => $value)
		{
			if($key != "target" && $key != "request_type")
			{
				$header = $header.$key."=".$value."&";
			}
		}
		$header = substr($header, 0, -1);
		//Files
		foreach($_FILES as $key => $fileInput)
		{
			if(is_array($fileInput["name"]))	//Checks if single or multiple file
			{
				$count = count($fileInput["name"]);
				$filenames = [];
				for($i = 0 ; $i < $count ; $i++)
				{
					$documentFilename = $fileInput["name"][$i];
					if(!move_uploaded_file($fileInput["tmp_name"][$i], "files/temp/".$documentFilename))
					{
						echo($twig->load("action-result.json")->render(["result" => "error_file"]));
						exit();
					}
					$filenames[$i] = $documentFilename;
				}
			}
			else
			{
				$documentFilename = $fileInput["name"];
				if(!move_uploaded_file($fileInput["tmp_name"], "files/temp/".$documentFilename))
				{
					echo($twig->load("action-result.json")->render(["result" => "error_file"]));
					exit();
				}
				$filenames[0] = $documentFilename;
			}
			$header = $header."&".$key."=".serialize($filenames);
		}
		header($header);
		exit();
	}
	if($_POST['request_type'] == "get")
	{
		//Script authorisation and data transfer
		$none = array("JobsForDateRange", "BasicJobInfo", "Booking");	//JobsForDateRange, Booking is authenticated in situ | BasicJobInfo does not require authentication
		$customer = array("MyBookings");
		$crew = array("JobsForCrew");
		$admin = array("Bookings", "Customers", "Crew", "Jobs", "TimeSheetReport", "CrewRequests", "CustomerRequests", "CrewMember", "CrewFile");
		if(in_array($_POST["target"], $customer))
		{
			if($_SESSION["userType"] != "Customer")
			{
				echo($twig->load("action-result.json")->render(["result" => "error_unauthorised"]));
				exit();
			}
		}
		else if(in_array($_POST["target"], $crew))
		{
			if($_SESSION["userType"] != "Crew")
			{
				echo($twig->load("action-result.json")->render(["result" => "error_unauthorised"]));
				exit();
			}
		}
		else if(in_array($_POST["target"], $admin))
		{
			if($_SESSION["userType"] != "Admin")
			{
				echo($twig->load("action-result.json")->render(["result" => "error_unauthorised"]));
				exit();
			}
		}
		else if(!in_array($_POST['target'], $none))
		{
			echo($twig->load("action-result.json")->render(["result" => "error_invalid_target"]));
			exit();
		}
		//Data
		$header = "Location: get/".$_POST['target'].".php?";
		foreach($_POST as $key => $value)
		{
			if($key != "target" && $key != "request_type")
			{
				$header = $header.$key."=".$value."&";
			}
		}
		$header = substr($header, 0, -1);
		header($header);
		exit();
	}
?>
