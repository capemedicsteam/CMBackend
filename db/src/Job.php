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
    /** @Column(type="integer") **/
    protected $CREW_REQUIRED;

    //Constructors
    public function __construct($booking_id = null, $crew_required = null)
    {
      $this->BOOKING_ID = $booking_id;
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

    public function getCrewRequired()
    {
        return $this->CREW_REQUIRED;
    }

    //Mutators
    public function setBooking($id)
    {
        $this->BOOKING_ID = $id;
    }

    public function setCrewRequired($crew)
    {
        $this->CREW_REQUIRED = $crew;
    }
}
