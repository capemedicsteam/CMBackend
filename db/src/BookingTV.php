<?php
/**
 * @Entity @Table(name="tbl_bookings_tv")
 **/
class BookingTV
{
    /** @Id @Column(type="integer") **/
    protected $BOOKING_ID;
    /** @Column(type="string") **/
    protected $TYPE;
    /** @Column(type="string") **/
    protected $PROJECT_NAME;
    /** @Column(type="datetime") **/
    protected $DATE_TIME;
    /** @Column(type="string") **/
    protected $LOCATION;
    /** @Column(type="string") **/
    protected $UNIT_TYPE;

    //Constructor
    public function __construct($booking_id = null, $type = null, $project_name = null, $date_time = null, $location = null, $unit_type = null)
    {
      $this->BOOKING_ID = $booking_id;
      $this->TYPE = $type;
      $this->PROJECT_NAME = $project_name;
      $this->DATE_TIME = $date_time;
      $this->LOCATION = $location;
      $this->UNIT_TYPE = $unit_type;
    }

    //Accessors
    public function getBookingId()
    {
        return $this->BOOKING_ID;
    }

    public function getType()
    {
        return $this->TYPE;
    }

    public function getProjectName()
    {
        return $this->PROJECT_NAME;
    }

    public function getDateTime()
    {
        return $this->DATE_TIME;
    }

    public function getLocation()
    {
        return $this->LOCATION;
    }

    public function getUnitType()
    {
      return $this->UNIT_TYPE;
    }

    //Mutators
    public function setBookingId($id)
    {
        $this->BOOKING_ID = $id;
    }

    public function setType($type)
    {
        $this->TYPE = $type;
    }

    public function setProjectName($name)
    {
        $this->PROJECT_NAME = $name;
    }

    public function setDateTime($datetime)
    {
        $this->DATE_TIME = $datetime;
    }

    public function setLocation($location)
    {
        $this->LOCATION = $location;
    }

    public function setUnitType($type)
    {
        $this->UNIT_TYPE = $type;
    }
}
