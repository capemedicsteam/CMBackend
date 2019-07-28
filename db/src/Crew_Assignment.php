<?php
/**
 * @Entity @Table(name="tbl_crew_assignments")
 **/
class Crew_Assignment
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $LINK_ID;
    /** @Column(type="integer") **/
    protected $CREW_ID;
    /** @Column(type="integer") **/
    protected $JOB_ID;

    //Constructors
    public Crew_Assignment()
    {

    }

    public Crew_Assignment($crew_id, $job_id)
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
        return $entityManager->find("Crew", $this->CREW_ID);
    }

    public function getJob()
    {
        return $entityManager->find("Job", $this->JOB_ID);
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
