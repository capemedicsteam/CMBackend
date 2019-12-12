<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
//Load Composer's autoloader to load dependencies
require_once "../vendor/autoload.php";
//Load Entity Classes
require_once "src/Booking.php";
require_once "src/BookingAirsideTransfer.php";
require_once "src/BookingEvent.php";
require_once "src/BookingIFHT.php";
require_once "src/BookingOrganTransfer.php";
require_once "src/BookingTV.php";
require_once "src/CheckIn.php";
require_once "src/Crew.php";
require_once "src/CrewAssignment.php";
require_once "src/Customer.php";
require_once "src/Job.php";
require_once "src/User.php";
//Create database connection
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), true);
$connectionParams = array(
  'dbname' => 'capemedics_2019',
  'user' => 'capemedics',
  'password' => 'rvvN69k7pH8qm95nFBS8',
  'host' => 'sql45.jnb2.host-h.net',
  'port' => '3306',
  'driver' => 'pdo_mysql'
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

//Get entity manager
$entityManager = EntityManager::create($conn, $config);
?>
