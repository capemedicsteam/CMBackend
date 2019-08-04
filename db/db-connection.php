<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
//Load Composer's autoloader to load dependencies
require_once "../vendor/autoload.php";
//Load Entity Classes
require_once "src/Booking.php";
require_once "src/Crew_Assignment.php";
require_once "src/Crew.php";
require_once "src/Customer.php";
require_once "src/Job.php";
require_once "src/User.php";
//Create database connection
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), true);
$connectionParams = array(
  'dbname' => 'dDsScbv5Ai',
  'user' => 'dDsScbv5Ai',
  'password' => 'pFCtiZ0AnC',
  'host' => 'remotemysql.com',
  'port' => '3306',
  'driver' => 'pdo_mysql'
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

//Get entity manager
$entityManager = EntityManager::create($conn, $config);
?>
