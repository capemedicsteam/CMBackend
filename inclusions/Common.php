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
    public static function toDateString($date)
    {
      return date_format($date, "d/m/Y");
    }
    public static function toTimeString($time)
    {
      return date_format($time, "H:i");
    }
    public static function toDateTimeString($datetime)
    {
      return date_format($datetime, "d/m/Y,H:i");
    }
    public static function incrementDate($date)
    {
      $dateInc = Common::toDate(Common::toDateString($date));
      $dateInc->modify("+1 day");
      return $dateInc;
    }
    public static function decrementDate($date)
    {
      $dateDec = Common::toDate(Common::toDateString($date));
      $dateDec->modify("-1 day");
      return $dateDec;
    }

    public static function randomString($length)
    {
      $characters = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890`~!@#$%^&*()_+-=[]{}\|;:,<.>/?";
      $password = "";
      for($i = 0 ; $i < $length ; $i++)
      {
        $password = $password.$characters[rand(0,strlen($characters))];
      }
      return $password;
    }
  }
?>
