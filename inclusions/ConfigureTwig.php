<?php
  require_once '../vendor/autoload.php';
  $loader = new \Twig\Loader\FilesystemLoader('../json');
  $twig = new \Twig\Environment($loader, [
      'cache' => '../twig-cache',
  ]);
?>
