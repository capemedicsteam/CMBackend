<?php
/**
 * @Entity @Table(name="tbl_bookings_organ_transfer")
 **/
class BookingOrganTransfer
{
    /** @Id @Column(type="integer") **/
    protected $BOOKING_ID;
    /** @Column(type="string") **/
    protected $SERVICE;
    /** @Column(type="string") **/
    protected $AIRLINE;
    /** @Column(type="string") **/
    protected $FLIGHT_NUMBER;
    /** @Column(type="string") **/
    protected $DEPARTURE_AIRPORT;
    /** @Column(type="string") **/
    protected $ARRIVAL_AIRPORT;
    /** @Column(type="date") **/
    protected $FLIGHT_DATE;
    /** @Column(type="time") **/
    protected $DEPARTURE_TIME;
    /** @Column(type="time") **/
    protected $ARRIVAL_TIME;

    //Constructor
    public function __construct($booking_id = null, $service = null, $airline = null, $flight_number = null, $departure_airport = null, $arrival_airport = null, $flight_date = null, $departure_time = null, $arrival_time = null)
    {
      $this->BOOKING_ID = $booking_id;
      $this->SERVICE = $service;
      $this->AIRLINE = $airline;
      $this->FLIGHT_NUMBER = $flight_number;
      $this->DEPARTURE_AIRPORT = $departure_airport;
      $this->ARRIVAL_AIRPORT = $arrival_airport;
      $this->FLIGHT_DATE = $flight_date;
      $this->DEPARTURE_TIME = $departure_time;
      $this->ARRIVAL_TIME = $arrival_time;
    }

    //Accessors
    public function getBookingId()
    {
        return $this->BOOKING_ID;
    }

    public function getService()
    {
        return $this->SERVICE;
    }

    public function getAirline()
    {
        return $this->AIRLINE;
    }

    public function getFlightNumber()
    {
        return $this->FLIGHT_NUMBER;
    }

    public function getDepartureAirport()
    {
        return $this->DEPARTURE_AIRPORT;
    }

    public function getArrivalAirport()
    {
      return $this->ARRIVAL_AIRPORT;
    }

    public function getFlightDate()
    {
      return $this->FLIGHT_DATE;
    }

    public function getDepartureTime()
    {
      return $this->DEPARTURE_TIME;
    }

    public function getArrivalTime()
    {
      return $this->ARRIVAL_TIME;
    }

    public function getAdditionalData()
    {
        $filename = "../../files/booking_organ_transfer/".$this->BOOKING_ID.".booking";
        if(file_exists($filename))
        {
          $handle = fopen($filename, "r");
          $data = fread($handle, filesize($filename));
          fclose($handle);
          return $data;
        }
        return "File not found";
    }

    //Mutators
    public function setBookingId($id)
    {
        $this->BOOKING_ID = $id;
    }

    public function setService($service)
    {
        $this->SERVICE = $service;
    }

    public function setAirline($airline)
    {
        $this->AIRLINE = $airline;
    }

    public function setFlightNumber($number)
    {
        $this->FLIGHT_NUMBER = $flight_number;
    }

    public function setDepartureAirport($airport)
    {
        $this->DEPARTURE_AIRPORT = $airport;
    }

    public function setArrivalAirport($airport)
    {
        $this->ARRIVAL_AIRPORT = $airport;
    }

    public function setFlightDate($date)
    {
        $this->FLIGHT_DATE = $date;
    }

    public function setDepartureTime($time)
    {
        $this->DEPARTURE_TIME = $time;
    }

    public function setArrivalTime($time)
    {
        $this->ARRIVAL_TIME = $time;
    }
}
?>
