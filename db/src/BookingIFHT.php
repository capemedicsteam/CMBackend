<?php
/**
 * @Entity @Table(name="tbl_bookings_ifht")
 **/
class BookingIFHT
{
    /** @Id @Column(type="integer") **/
    protected $BOOKING_ID;
    /** @Column(type="boolean") **/
    protected $TRAVEL_MORE_THAN_100KM;
    /** @Column(type="string") **/
    protected $FROM_LOCATION_TYPE;
    /** @Column(type="string") **/
    protected $FROM_ADDRESS;
    /** @Column(type="datetime") **/
    protected $FROM_DATE_TIME;
    /** @Column(type="string") **/
    protected $TO_LOCATION_TYPE;
    /** @Column(type="string") **/
    protected $TO_ADDRESS;
    /** @Column(type="datetime") **/
    protected $TO_DATE_TIME;
    /** @Column(type="boolean") **/
    protected $RETURN_TRIP;
    /** @Column(type="time") **/
    protected $RETURN_TIME;
    /** @Column(type="string") **/
    protected $PATIENT_NAME;
    /** @Column(type="string") **/
    protected $PATIENT_SURNAME;
    /** @Column(type="string") **/
    protected $PATIENT_ID_PASSPORT_NUMBER;
    /** @Column(type="string") **/
    protected $PATIENT_CASE_REFERENCE_NUMBER;
    /** @Column(type="string") **/
    protected $PATIENT_NATIONALITY;

    //Constructor
    public function __construct($booking_id = null, $travel_more_than_100km = false, $from_location_type = null, $from_address = null, $from_date_time = null, $to_location_type = null, $to_address = null, $to_date_time = null, $return_trip = false, $return_time = null, $patient_name = null, $patient_surname = null, $patient_id_passport_number = null, $patient_case_reference_number = null, $patient_nationality = null)
    {
      $this->BOOKING_ID = $booking_id;
      $this->TRAVEL_MORE_THAN_100KM = $travel_more_than_100km;
      $this->FROM_LOCATION_TYPE = $from_location_type;
      $this->FROM_ADDRESS = $from_address;
      $this->FROM_DATE_TIME = $from_date_time;
      $this->TO_LOCATION_TYPE = $to_location_type;
      $this->TO_ADDRESS = $to_address;
      $this->TO_DATE_TIME = $to_date_time;
      $this->RETURN_TRIP = $return_trip;
      $this->RETURN_TIME = $return_time;
      $this->PATIENT_NAME = $patient_name;
      $this->PATIENT_SURNAME = $patient_surname;
      $this->PATIENT_ID_PASSPORT_NUMBER = $patient_id_passport_number;
      $this->PATIENT_CASE_REFERENCE_NUMBER = $patient_case_reference_number;
      $this->PATIENT_NATIONALITY = $patient_nationality;
    }

    //Accessors
    public function getBookingId()
    {
        return $this->BOOKING_ID;
    }

    public function isTravelMoreThan100km()
    {
        return $this->TRAVEL_MORE_THAN_100KM;
    }

    public function getFromLocationType()
    {
        return $this->FROM_LOCATION_TYPE;
    }

    public function getFromAddress()
    {
        return $this->FROM_ADDRESS;
    }

    public function getFromDateTime()
    {
        return $this->FROM_DATE_TIME;
    }

    public function getToLocationType()
    {
      return $this->TO_LOCATION_TYPE;
    }

    public function getToAddress()
    {
      return $this->TO_ADDRESS;
    }

    public function getToDateTime()
    {
      return $this->TO_DATE_TIME;
    }

    public function isReturnTrip()
    {
      return $this->RETURN_TRIP;
    }

    public function getReturnTime()
    {
      return $this->RETURN_TIME;
    }

    public function getPatientName()
    {
      return $this->PATIENT_NAME;
    }

    public function getPatientSurname()
    {
      return $this->PATIENT_SURNAME;
    }

    public function getPatientIdPassportNumber()
    {
      return $this->PATIENT_ID_PASSPORT_NUMBER;
    }

    public function getPatientCaseReferenceNumber()
    {
      return $this->PATIENT_CASE_REFERENCE_NUMBER;
    }

    public function getPatientNationality()
    {
      return $this->PATIENT_NATIONALITY;
    }

    //Mutators
    public function setBookingId($id)
    {
        $this->BOOKING_ID = $id;
    }

    public function setTravelMoreThan100km($flag)
    {
        $this->TRAVEL_MORE_THAN_100KM = $flag;
    }

    public function setFromLocationType($type)
    {
        $this->FROM_LOCATION_TYPE = $type;
    }

    public function setFromAddress($address)
    {
        $this->FROM_ADDRESS = $address;
    }

    public function setFromDateTime($datetime)
    {
        $this->FROM_DATE_TIME = $datetime;
    }

    public function setToLocationType($type)
    {
        $this->TO_LOCATION_TYPE = $type;
    }

    public function setToAddress($address)
    {
        $this->TO_ADDRESS = $address;
    }

    public function setToDateTime($datetime)
    {
        $this->TO_DATE_TIME = $datetime;
    }

    public function setReturnTrip($flag)
    {
        $this->RETURN_TRIP = $flag;
    }

    public function setReturnTime($time)
    {
        $this->RETURN_TIME = $time;
    }

    public function setPatientName($name)
    {
        $this->PATIENT_NAME = $name;
    }

    public function setPatientSurname($surname)
    {
        $this->PATIENT_SURNAME = $surname;
    }

    public function setPatientIdPassportNumber($number)
    {
        $this->PATIENT_ID_PASSPORT_NUMBER = $number;
    }

    public function setPatientCaseReferenceNumber($number)
    {
        $this->PATIENT_CASE_REFERENCE_NUMBER = $number;
    }

    public function setPatientNationality($nationality)
    {
        $this->PATIENT_NATIONALITY = $nationality;
    }
}
?>
