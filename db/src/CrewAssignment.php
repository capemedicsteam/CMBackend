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

    public function getCrewId()
    {
        return $this->CREW_ID;
    }

    public function getJobId()
    {
        return $this->JOB_ID;
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
?>
