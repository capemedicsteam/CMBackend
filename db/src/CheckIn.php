<?php
  /**
   * @Entity @Table(name="tbl_check_ins")
   **/
  class CheckIn
  {
      /** @Id @Column(type="integer") @GeneratedValue **/
      protected $CHECK_IN_ID;
      /** @Column(type="integer") **/
      protected $CREW_ID;
      /** @Column(type="integer") **/
      protected $JOB_ID;
      /** @Column(type="string") **/
      protected $LOCATION;
      /** @Column(type="date") **/
      protected $CHECK_IN_DATE;
      /** @Column(type="time") **/
      protected $CHECK_IN_TIME;
      /** @Column(type="time") **/
      protected $CHECK_OUT_TIME;

      //Constructor
      public function __construct(Crew $crew, Job $job, $location = null, $date = null, $check_in_time = null)
      {
        $this->CREW_ID = $crew->getCrewId();
        $this->JOB_ID = $job->getJobId();
        $this->LOCATION = $location;
        $this->CHECK_IN_DATE = $date;
        $this->CHECK_IN_TIME = $check_in_time;
      }

      //Accessors
      public function getCheckInId()
      {
          return $this->CHECK_IN_ID;
      }

      public function getCrewId()
      {
          return $this->CREW_ID;
      }

      public function getJobId()
      {
          return $this->CREW_ID;
      }

      public function getLocation()
      {
          return $this->LOCATION;
      }

      public function getDate()
      {
          return $this->CHECK_IN_DATE;
      }

      public function getCheckInTime()
      {
          return $this->CHECK_IN_TIME;
      }

      public function getCheckOutTime()
      {
          return $this->CHECK_OUT_TIME;
      }

      //Mutators
      public function setCrew(Crew $crew)
      {
          $this->CREW_ID = $crew->getCrewId();
      }

      public function setJob(Job $job)
      {
          $this->JOB_ID = $job->getJobId();
      }

      public function setLocation($location)
      {
          $this->LOCATION = $location;
      }

      public function setDate($date)
      {
          $this->CHECK_IN_DATE = $date;
      }

      public function setCheckInTime($time)
      {
          $this->CHECK_IN_TIME = $time;
      }

      public function setCheckOutTime($time)
      {
          $this->CHECK_OUT_TIME = $time;
      }
  }
?>
