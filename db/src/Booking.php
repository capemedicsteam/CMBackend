<?php
/**
 * @Entity @Table(name="tbl_bookings")
 **/
class Booking
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $BOOKING_ID;
    /** @Column(type="integer") **/
    protected $CUSTOMER_ID;
    /** @Column(type="datetime") **/
    protected $PROPOSED_DATE;
    /** @Column(type="string") **/
    protected $TYPE;
    /** @Column(type="boolean") **/
    protected $CONFIRMED;
    /** @Column(type="boolean") **/
    protected $ACCOUNT;
    /** @ManyToOne(targetEntity="Customer", inversedBy="BOOKINGS") **/
    protected $CUSTOMER;
    /**
     * @OneToMany(targetEntity="Job", mappedBy="BOOKING")
     * @var Job An ArrayCollection of Bug objects.
     **/
    protected $JOB = null;

    //Constructor
    public function __construct($customer_id = null, $proposed_date = null, $type = null, $account = true)
    {
      $this->CUSTOMER_ID = $customer_id;
      $this->PROPOSED_DATE = $proposed_date;
      $this->TYPE = $type;
      $this->CONFIRMED = false;
      $this->ACCOUNT = $account;
    }

    //Accessors
    public function getBookingId()
    {
        return $this->BOOKING_ID;
    }

    public function getProposedDate()
    {
        return $this->PROPOSED_DATE;
    }

    public function getType()
    {
        return $this->TYPE;
    }

    public function isConfirmed()
    {
        return $this->CONFIRMED;
    }

    public function isAccount()
    {
        return $this->ACCOUNT;
    }

    public function getCustomer()
    {
        return $this->CUSTOMER;
    }

    //Mutators
    public function setProposedDate($date)
    {
        $this->PROPOSED_DATE = $date;
    }

    public function setType($type)
    {
        $this->TYPE = $type;
    }

    public function setConfirmed($flag)
    {
        $this->CONFIRMED = $flag;
    }

    public function setAccount($flag)
    {
        $this->ACCOUNT = $flag;
    }

    public function setCustomer(Customer $customer)
    {
        $CUSTOMER->addBooking($this);
        $this->CUSTOMER = $customer;
    }

    public function setJob(Job $job)
    {
      $this->JOB = $job;
    }
}
