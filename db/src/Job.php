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
    /** @ManyToOne(targetEntity="Booking", inversedBy="JOB") **/
    protected $BOOKING;
    /**
     * @OneToMany(targetEntity="CrewAssignment", mappedBy="JOB")
     * @var CrewAssignment[] An ArrayCollection of Bug objects.
     **/
    protected $CREW_ASSIGNMENTS = null;


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

    public function getCrewRequired()
    {
        return $this->CREW_REQUIRED;
    }

    public function getBooking()
    {
        return $this->BOOKING;
    }

    public function getCrew()
    {
      $crew;
      for($i = 0 ; $i < count(CREW_ASSIGNMENTS) ; $i++)
      {
        $crew[] = CREW_ASSIGNMENTS[$i]->getCrew();
      }
      return $crew;
    }

    //Mutators
    public function setCrewRequired($crew)
    {
        $this->CREW_REQUIRED = $crew;
    }

    public function setBooking(Booking $booking)
    {
        $BOOKING->setJob($this);
        $this->BOOKING = $booking;
    }

    public function addCrew(Crew $crew)
    {
      $this->CREW_ASSIGNMENTS[] = new CrewAssignment($crew->getCrewId(), $this);
    }
}
