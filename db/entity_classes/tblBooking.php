<?php
/**
 * @Entity @Table(name="tbl_bookings")
 **/
class Booking
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $booking_id;
    /** @Column(type="integer") **/
    protected $customer_id;
    /** @Column(type="DateTime") **/
    protected $proposed_date;
    /** @Column(type="string") **/
    protected $type;
    /** @Column(type="string") **/
    protected $booking_status;

    //Accessors
    public function getBookingId()
    {
        return $this->booking_id;
    }

    public function getCustomer()
    {
        return new Customer($this->customer_id);
    }

    public function getProposedDate()
    {
        return $this->proposed_date;
    }

    public function getBookingStatus()
    {
        return $this->booking_status;
    }

    //Mutators
    public function setCustomer($id)
    {
        $this->customer_id = $id;
    }

    public function setProposedDate($date)
    {
        $this->proposed_date = $date;
    }

    public function setBookingStatus($status)
    {
        $this->booking_status = $status;
    }
}
