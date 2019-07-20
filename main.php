<?php
	session_start();
	if($_GET['request_type'] == "page")	//For users trying to access web pages
	{
		//Web Pages
		$admin = array("adminpage.html", "assignEmployeesPage.html", "bookingManagementPage.html", "customerManagementPage.html", "documentViewPage.html", "employeeInfoPage.html", "employeeManagementPage.html", "jobInfoPage.html", "jobsManagementPage.html", "reportPage.html")
		//Check what type of page user is trying to access
		if(in_array($_GET['target'], $admin))
		{
			if($_SESSION['user']) == "admin")
			{
				$header = "Location: ".$_GET['target'];
				for($_GET as $key)
				{
					if($_GET[$key] != "target" && $_GET[$key] != "request_type")
					{
						$header = $header."&".$key."=".$_GET[$key];
					}
				}
				header($header);
				exit();
			}
			else
			{
				header("location: Somewhere else");	//Back to sign in page or something
				exit();
			}
		}
	}
	if($_GET['request_type'] == "data")	//For ajax making a request for data
	{
		//PHP Files
		$admin = array("adminpage.php", "assignEmployeesPage.php", "bookingManagementPage.php", "customerManagementPage.php", "documentViewPage.php", "employeeInfoPage.php", "employeeManagementPage.php", "jobInfoPage.php", "jobsManagementPage.php", "generateReport.html")
		//Check if user is authorised to access the data
		if(in_array($_GET['target'], $admin))
			if($_SESSION['user']) == "admin")
			{
				$header = "Location: ".$_GET['target'];
				for($_GET as $key)
				{
					if($_GET[$key] != "target" && $_GET[$key] != "request_type")
					{
						$header = $header."&".$key."=".$_GET[$key];
					}
				}
				header($header);
				exit();
			}
			else
			{
				echo("Error 403: Forbidden");
				exit();
			}
		}
	}
?>
