<?php
/**
 * @Entity @Table(name="tbl_crew_assignments")
 **/
class CrewAssignment
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $LINK_ID;
    /** @Column(type="integer") **/
    protected $CREW_ID;
    /** @Column(type="integer") **/
    protected $JOB_ID;
    /** @ManyToOne(targetEntity="Job", inversedBy="CREW_ASSIGNMENTS") **/
    protected $JOB;
    /** @ManyToOne(targetEntity="Crew", inversedBy="CREW_ASSIGNMENTS") **/
    protected $CREW;

    //Constructor
    public function __construct($crew_id = null, $job_id = null)
    {
      $this->CREW_ID = $crew_id;
      $this->JOB_ID = $job_id;
    }

    //Accessors
    public function getLinkId()
    {
        return $this->LINK_ID;
    }

    public function getCrew()
    {
        return $this->CREW;
    }

    public function getJob()
    {
        return $this->JOB;
    }

    //Mutators
    public function setCrew($id)
    {
        $this->CREW_ID = $id;
    }

    public function setJob($id)
    {
        $this->JOB_ID = $id;
    }
}
