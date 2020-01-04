<?php
/**
 * @Entity @Table(name="tbl_bookings_event")
 **/
class BookingEvent
{
    /** @Id @Column(type="integer") **/
    protected $BOOKING_ID;
    /** @Column(type="string") **/
    protected $EVENT_TYPE;  //c-CTICC; g-GCC; ; p-PSL Soccer; o-Other
    /** @Column(type="datetime") **/
    protected $EVENT_START_DATE_TIME;
    /** @Column(type="datetime") **/
    protected $EVENT_END_DATE_TIME;
    /** @Column(type="string") **/
    protected $LOCATION;
    /** @Column(type="string") **/
    protected $EVENT_NAME;
    /** @Column(type="integer") **/
    protected $PAX;
    /** @Column(type="string") **/
    protected $DESCRIPTION;
    /** @Column(type="boolean") **/
    protected $BUILD_UP_REQUIRED;
    /** @Column(type="datetime") **/
    protected $BUILD_UP_START_DATE_TIME;
    /** @Column(type="datetime") **/
    protected $BUILD_UP_END_DATE_TIME;
    /** @Column(type="boolean") **/
    protected $STRIKE_REQUIRED;
    /** @Column(type="datetime") **/
    protected $STRIKE_START_DATE_TIME;
    /** @Column(type="datetime") **/
    protected $STRIKE_END_DATE_TIME;
    /** @Column(type="string") **/
    protected $EVENT_NATURE;
    /** @Column(type="string") **/
    protected $ATTENDEES_STAND_SEAT_BOTH;
    /** @Column(type="integer") **/
    protected $EXPECTED_NUMBERS;
    /** @Column(type="string") **/
    protected $TIME_OF_YEAR;
    /** @Column(type="string") **/
    protected $VENUE;
    /** @Column(type="string") **/
    protected $ATTENDEES_TYPE;
    /** @Column(type="integer") **/
    protected $EXPECTED_EVENT_DURATION; //0-<4hrs; 1-4<hrs<12; 2->12hrs

    //Constructor
    public function __construct($booking_id = null, $event_type = null, $event_start_date_time = null, $event_end_date_time = null, $location = null, $event_name = null, $pax = null, $description = null, $build_up_required = false, $build_up_start_date_time = null, $build_up_end_date_time = null, $strike_required = false, $strike_start_date_time = null, $strike_end_date_time = null, $event_nature = null, $attendees_stand_seat_both = null, $expected_numbers = null, $time_of_year = null, $venue = null, $attendees_type = null, $expected_event_duration = null)
    {
      $this->BOOKING_ID = $booking_id;
      $this->EVENT_TYPE = $event_type;
      $this->EVENT_START_DATE_TIME = $event_start_date_time;
      $this->EVENT_END_DATE_TIME = $event_end_date_time;
      $this->LOCATION = $location;
      $this->EVENT_NAME = $event_name;
      $this->PAX = $pax;
      $this->DESCRIPTION = $description;
      $this->BUILD_UP_REQUIRED = $build_up_required;
      $this->BUILD_UP_START_DATE_TIME = $build_up_start_date_time;
      $this->BUILD_UP_END_DATE_TIME = $build_up_end_date_time;
      $this->STRIKE_REQUIRED = $strike_required;
      $this->STRIKE_START_DATE_TIME = $strike_start_date_time;
      $this->STRIKE_END_DATE_TIME = $strike_end_date_time;
      $this->EVENT_NATURE = $event_nature;
      $this->ATTENDEES_STAND_SEAT_BOTH = $attendees_stand_seat_both;
      $this->EXPECTED_NUMBERS = $expected_numbers;
      $this->TIME_OF_YEAR = $time_of_year;
      $this->VENUE = $venue;
      $this->ATTENDEES_TYPE = $attendees_type;
      $this->EXPECTED_EVENT_DURATION = $expected_event_duration;
    }

    //Accessors
    public function getBookingId()
    {
        return $this->BOOKING_ID;
    }

    public function getEventType()
    {
        return $this->EVENT_TYPE;
    }

    public function getEventStartDateTime()
    {
        return $this->EVENT_START_DATE_TIME;
    }

    public function getEventEndDateTime()
    {
        return $this->EVENT_END_DATE_TIME;
    }

    public function getLocation()
    {
        return $this->LOCATION;
    }

    public function getEventName()
    {
      return $this->EVENT_NAME;
    }

    public function getPax()
    {
      return $this->PAX;
    }

    public function getDescription()
    {
      return $this->DESCRIPTION;
    }

    public function isBuildUpRequired()
    {
      return $this->BUILD_UP_REQUIRED;
    }

    public function getBuildUpStartDateTime()
    {
      return $this->BUILD_UP_START_DATE_TIME;
    }

    public function getBuildUpEndDateTime()
    {
      return $this->BUILD_UP_END_DATE_TIME;
    }

    public function isStrikeRequired()
    {
      return $this->STRIKE_REQUIRED;
    }

    public function getStrikeStartDateTime()
    {
      return $this->STRIKE_START_DATE_TIME;
    }

    public function getStrikeEndDateTime()
    {
      return $this->STRIKE_END_DATE_TIME;
    }

    public function getEventNature()
    {
      return $this->EVENT_NATURE;
    }

    public function getAttendeesStandSeatBoth()
    {
      return $this->ATTENDEES_STAND_SEAT_BOTH;
    }

    public function getExpectedNumbers()
    {
      return $this->EXPECTED_NUMBERS;
    }

    public function getTimeOfYear()
    {
      return $this->TIME_OF_YEAR;
    }

    public function getVenue()
    {
      return $this->VENUE;
    }

    public function getAttendeesType()
    {
      return $this->ATTENDEES_TYPE;
    }

    public function getExpectedEventDuration()
    {
      return $this->EXPECTED_EVENT_DURATION;
    }

    public function getAdditionalData()
    {
        $filename = "../../files/booking_event/".$this->BOOKING_ID.".booking";
        if(file_exists($filename))
        {
          $handle = fopen($filename, "r");
          $data = fread($handle, filesize($filename));
          fclose($handle);
          return $data;
        }
        return "File not found";
    }

    //Mutators
    public function setBookingId($id)
    {
        $this->BOOKING_ID = $id;
    }

    public function setEventType($type)
    {
        $this->EVENT_TYPE = $type;
    }

    public function setEventStartDateTime($datetime)
    {
        $this->EVENT_START_DATE_TIME = $datetime;
    }

    public function setEventEndDateTime($datetime)
    {
        $this->EVENT_END_DATE_TIME = $datetime;
    }

    public function setLocation($location)
    {
        $this->LOCATION = $location;
    }

    public function setEventName($name)
    {
        $this->EVENT_NAME = $name;
    }

    public function setPax($pax)
    {
        $this->PAX = $pax;
    }

    public function setDescription($description)
    {
        $this->DESCRIPTION = $description;
    }

    public function setBuildUpRequired($flag)
    {
        $this->BUILD_UP_REQUIRED = $flag;
    }

    public function setBuildUpStartDateTime($datetime)
    {
        $this->BUILD_UP_START_DATE_TIME = $datetime;
    }

    public function setBuildUpEndDateTime($build_up_end_date_time)
    {
        $this->BUILD_UP_END_DATE_TIME = $build_up_end_date_time;
    }

    public function setStrikeRequired($flag)
    {
        $this->STRIKE_REQUIRED = $flag;
    }

    public function setStrikeStartDateTime($datetime)
    {
        $this->STRIKE_START_DATE_TIME = $datetime;
    }

    public function setStrikeEndDateTime($datetime)
    {
        $this->STRIKE_END_DATE_TIME = $datetime;
    }

    public function setEventNature($nature)
    {
        $this->EVENT_NATURE = $nature;
    }

    public function setAttendeesStandSeatBoth($option)
    {
        $this->ATTENDEES_STAND_SEAT_BOTH = $option;
    }

    public function setExpectedNumbers($number)
    {
        $this->EXPECTED_NUMBERS = $number;
    }

    public function setTimeOfYear($season)
    {
        $this->TIME_OF_YEAR = $season;
    }

    public function setVenue($venue)
    {
        $this->VENUE = $venue;
    }

    public function setAttendeesType($type)
    {
        $this->ATTENDEES_TYPE = $type;
    }

    public function setExpectedEventDuration($duration)
    {
        $this->EXPECTED_EVENT_DURATION = $duration;
    }
}
?>
