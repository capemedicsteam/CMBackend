<?php
  use Doctrine\ORM\Tools\Setup;
  use Doctrine\ORM\EntityManager;
  //Load Composer's autoloader to load dependencies
  require_once "../vendor/autoload.php";
  //Create database connection
  $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), true);
  $connectionParams = array(
    'url' => 'mysql://dDsScbv5Ai:pFCtiZ0AnC@remotemysql.com/dDsScbv5Ai',  //mysql://user:password@server/database
);
  $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
  //Get entity manager
  $entityManager = EntityManager::create($conn, $config);
?>
