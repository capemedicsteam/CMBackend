<?php
/**
 * @Entity @Table(name="tbl_jobs")
 **/
class Job
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $JOB_ID;
    /** @Column(type="integer") **/
    protected $BOOKING_ID;
    /** @Column(type="string") **/
    protected $TYPE;
    /** @Column(type="string") **/
    protected $LOCATION_TYPE;
    /** @Column(type="string") **/
    protected $LOCATION;
    /** @Column(type="date") **/
    protected $START_DATE;
    /** @Column(type="date") **/
    protected $END_DATE;
    /** @Column(type="integer") **/
    protected $CREW_REQUIRED;

    //Constructors
    public Job()
    {

    }

    public Customer($booking_id, $type, $location_type, $location, $start_date, $end_date, $crew_required)
    {
      $this->BOOKING_ID = $booking_id;
      $this->TYPE = $type;
      $this->LOCATION_TYPE = $location_type;
      $this->LOCATION = $location;
      $this->START_DATE = $start_date;
      $this->END_DATE = $end_date;
      $this->CREW_REQUIRED = $crew_required;
    }

    //Accessors
    public function getJobId()
    {
        return $this->JOB_ID;
    }

    public function getBooking()
    {
        return $entityManager->find("Booking", $this->BOOKING_ID);
    }

    public function getType()
    {
        return $this->TYPE;
    }

    public function getLocationType()
    {
        return $this->LOCATION_TYPE;
    }

    public function getLocation()
    {
        return $this->LOCATION;
    }

    public function getStartDate()
    {
        return $this->START_DATE;
    }

    public function getEndDate()
    {
        return $this->END_DATE;
    }

    public function getCrewRequired()
    {
        return $this->CREW_REQUIRED;
    }

    //Mutators
    public function setBooking($id)
    {
        $this->BOOKING_ID = $id;
    }

    public function setType($type)
    {
        $this->TYPE = $type;
    }

    public function setLocationType($type)
    {
        $this->LOCATION_TYPE = $type;
    }

    public function setLocation($location)
    {
        $this->LOCATION = $location;
    }

    public function setStartDate($date)
    {
        $this->START_DATE = $start_date;
    }

    public function setEndDate($date)
    {
        $this->END_DATE = $end_date;
    }

    public function setCrewRequired($crew)
    {
        $this->CREW_REQUIRED = $crew;
    }
}
