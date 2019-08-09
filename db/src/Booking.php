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

    public function getCustomer()
    {
        return $entityManager->find("Customer", $this->CUSTOMER_ID);
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

    //Mutators
    public function setCustomer($id)
    {
        $this->CUSTOMER_ID = $id;
    }

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
}
