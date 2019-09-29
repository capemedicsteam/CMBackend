<?php
	//Load Dependencies
	session_start();
	//Configure Twig manually in main.php since it is in the root folder
	require_once "vendor/autoload.php";
	$loader = new \Twig\Loader\FilesystemLoader('json');
  $twig = new \Twig\Environment($loader, [
      'cache' => '../twig-cache',
  ]);
	//Check request type
	if($_POST['request_type'] == "script")
	{
		//Script authorisation and data transfer
		$none = array("RegisterCustomer", "RegisterCrew", "Login", "UpdateBooking", "AssignCrew");	//UpdateBooking, AssignCrew is admin
		$customer = array("BookAirsideTransfer", "BookEvent", "BookIFHT", "BookOrganTransfer", "BookTV");
		$crew = array("VehicleChecklist");
		$admin = array();
		if(in_array($_POST["target"], $customer))
		{
			if($_SESSION["userType"] != "Customer" && substr($POST["target"], 0, 4) != "Book")	//Bookings can be made without logging in
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
			$_SESSION[$key] = $filenames;
		}
		header($header);
		exit();
	}
	if($_POST['request_type'] == "get")
	{
		//Script authorisation and data transfer
		$none = array("Bookings", "Customers", "Crew", "Jobs", "JobsForDateRange", "BasicJobInfo");	//Admin (JobsForDateRange is authenticated in situ) - BasicJobInfo does not require authentication
		$customer = array();
		$crew = array();
		$admin = array();
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

	//
	// if($_POST['request_type'] == "page")	//For users trying to access web pages
	// {
	// 	//Web Pages
	// 	$admin = array("adminpage.html", "assignEmployeesPage.html", "bookingManagementPage.html", "customerManagementPage.html", "documentViewPage.html", "employeeInfoPage.html", "employeeManagementPage.html", "jobInfoPage.html", "jobsManagementPage.html", "reportPage.html")
	// 	//Check what type of page user is trying to access
	// 	if(in_array($_POST['target'], $admin))
	// 	{
	// 		if($_SESSION['user']) == "admin")
	// 		{
	// 			$header = "Location: ".$_GET['target']."?";
	// 			for($_GET as $key)
	// 			{
	// 				if($_GET[$key] != "target" && $_GET[$key] != "request_type")
	// 				{
	// 					$header = $header.$key."=".$_GET[$key]."&";
	// 				}
	// 			}
	// 			$header = substr($header, -1);
	// 			header($header);
	// 			exit();
	// 		}
	// 		else
	// 		{
	// 			header("location: Somewhere else");	//Back to sign in page or something
	// 			exit();
	// 		}
	// 	}
	// }
	// if($_GET['request_type'] == "script")	//For ajax making a request for data
	// {
	// 	//PHP Files
	// 	$admin = array("adminpage.php", "assignEmployeesPage.php", "bookingManagementPage.php", "customerManagementPage.php", "documentViewPage.php", "employeeInfoPage.php", "employeeManagementPage.php", "jobInfoPage.php", "jobsManagementPage.php", "generateReport.html")
	// 	//Check if user is authorised to access the data
	// 	if(in_array($_GET['target'], $admin))
	// 		if($_SESSION['user']) == "admin")
	// 		{
	// 			$header = "Location: ".$_GET['target'];
	// 			for($_GET as $key)
	// 			{
	// 				if($_GET[$key] != "target" && $_GET[$key] != "request_type")
	// 				{
	// 					$header = $header."&".$key."=".$_GET[$key];
	// 				}
	// 			}
	// 			header($header);
	// 			exit();
	// 		}
	// 		else
	// 		{
	// 			echo("Error 403: Forbidden");
	// 			exit();
	// 		}
	// 	}
	// }
?>
