<?php
  class Common
  {
    public static function toDate($dateString)
    {
      return DateTime::createFromFormat("d/m/Y", $dateString);
    }
    public static function toTime($timeString)
    {
      return DateTime::createFromFormat("H:i", $timeString);
    }
    public static function toDateTime($datetimeString)
    {
      return DateTime::createFromFormat("d/m/Y,H:i", $datetimeString);
    }
  }
?>
