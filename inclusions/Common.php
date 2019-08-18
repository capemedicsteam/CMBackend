<?php
  class Common
  {
    public static function toDate($dateString)
    {
      return DateTime::createFromFormat("d/m/Y", $dateString);
    }
  }
?>
