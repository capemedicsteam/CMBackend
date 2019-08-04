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
    /** @Column(type="string") **/
    protected $BOOKING_STATUS;

    //Constructor
    public function __construct($customer_id = null, $proposed_date = null, $type = null)
    {
      $this->CUSTOMER_ID = $customer_id;
      $this->PROPOSED_DATE = $proposed_date;
      $this->TYPE = $type;
      $this->BOOKING_STATUS = "u";
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

    public function getBookingStatus()
    {
        return $this->BOOKING_STATUS;
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

    public function setBookingStatus($status)
    {
        $this->BOOKING_STATUS = $status;
    }
}
