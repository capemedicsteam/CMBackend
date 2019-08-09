<?php
/**
 * @Entity @Table(name="tbl_bookings_airside_transfer")
 **/
class BookingAirsideTransfer
{
    /** @Id @Column(type="integer") **/
    protected $BOOKING_ID;
    /** @Column(type="string") **/
    protected $FLIGHT_TYPE;
    /** @Column(type="date") **/
    protected $FLIGHT_DATE;
    /** @Column(type="string") **/
    protected $FLIGHT_NUMBER;
    /** @Column(type="string") **/
    protected $FLIGHT_DEPARTURE_AIRPORT;
    /** @Column(type="string") **/
    protected $FLIGHT_ARRIVAL_AIRPORT;
    /** @Column(type="time") **/
    protected $FLIGHT_DEPARTURE_TIME;
    /** @Column(type="time") **/
    protected $FLIGHT_ARRIVAL_TIME;
    /** @Column(type="string") **/
    protected $FLIGHT_TERMINAL_TYPE;
    /** @Column(type="string") **/
    protected $CARE_LEVEL;
    /** @Column(type="string") **/
    protected $PATIENT_NAME;
    /** @Column(type="string") **/
    protected $PATIENT_SURNAME;
    /** @Column(type="string") **/
    protected $PATIENT_ID_PASSPORT_NUMBER;
    /** @Column(type="string") **/
    protected $PATIENT_CASE_REFERENCE_NUMBER;
    /** @Column(type="boolean") **/
    protected $FLIGHT_MEDICAL_ESCORT_REQUIRED;
    /** @Column(type="boolean") **/
    protected $AMBULANCE_ESCORT_REQUIRED;
    /** @Column(type="boolean") **/
    protected $GROUND_AMBULANCE_TRAVEL_DISTANCE_GREATER_THAN_100KM;
    /** @Column(type="string") **/
    protected $GROUND_AMBULANCE_DEPARTURE_FACILITY;
    /** @Column(type="time") **/
    protected $GROUND_AMBULANCE_DEPARTURE_FACILITY_PICKUP_TIME;
    /** @Column(type="string") **/
    protected $GROUND_AMBULANCE_ARRIVAL_FACILITY;
    /** @Column(type="time") **/
    protected $GROUND_AMBULANCE_ARRIVAL_AIRPORT_PICKUP_TIME;

    //Constructor
    public function __construct($booking_id = null, $flight_type = null, $flight_date = null, $flight_number = null, $flight_departure_airport = null, $flight_arrival_airport = null, $flight_departure_time = null, $flight_arrival_time = null, $flight_terminal_type = null, $care_level = null, $patient_name = null, $patient_surname = null, $patient_id_passport_number = null, $patient_case_reference_number = null)
    {
      $this->BOOKING_ID = $booking_id;
      $this->FLIGHT_TYPE = $flight_type;
      $this->FLIGHT_DATE = $flight_date;
      $this->FLIGHT_NUMBER = $flight_number;
      $this->FLIGHT_DEPARTURE_AIRPORT = $flight_departure_airport;
      $this->FLIGHT_ARRIVAL_AIRPORT = $flight_arrival_airport;
      $this->FLIGHT_DEPARTURE_TIME = $flight_departure_time;
      $this->FLIGHT_ARRIVAL_TIME = $flight_arrival_time;
      $this->FLIGHT_TERMINAL_TYPE = $flight_terminal_type;
      $this->CARE_LEVEL = $care_level;
      $this->PATIENT_NAME = $patient_name;
      $this->PATIENT_SURNAME = $patient_surname;
      $this->PATIENT_ID_PASSPORT_NUMBER = $patient_id_passport_number;
      $this->PATIENT_CASE_REFERENCE_NUMBER = $patient_case_reference_number;
    }

    //Accessors
    public function getBookingId()
    {
        return $this->BOOKING_ID;
    }

    public function getFlightType()
    {
        return $this->FLIGHT_TYPE;
    }

    public function getFlightDate()
    {
        return $this->FLIGHT_DATE;
    }

    public function getFlightNumber()
    {
        return $this->FLIGHT_NUMBER;
    }

    public function getFlightDepartureAirport()
    {
        return $this->FLIGHT_DEPARTURE_AIRPORT;
    }

    public function getFlightArrivalAirport()
    {
        return $this->FLIGHT_ARRIVAL_AIRPORT;
    }

    public function getFlightDepartureTime()
    {
        return $this->FLIGHT_DEPARTURE_TIME;
    }

    public function getFlightArrivalTime()
    {
        return $this->FLIGHT_ARRIVAL_TIME;
    }

    public function getFlightTerminalType()
    {
        return $this->FLIGHT_TERMINAL_TYPE;
    }

    public function getCareLevel()
    {
        return $this->CARE_LEVEL;
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

    public function isFlightMedicalEscortRequired()
    {
        return $this->FLIGHT_MEDICAL_ESCORT_REQUIRED;
    }

    public function isAmbulanceEscortRequired()
    {
        return $this->AMBULANCE_ESCORT_REQUIRED;
    }

    public function isGroundAmbulanceTravelDistanceGreaterThan100km()
    {
        return $this->GROUND_AMBULANCE_TRAVEL_DISTANCE_GREATER_THAN_100KM;
    }

    public function getGroundAmbulanceDepartureFacility()
    {
        return $this->GROUND_AMBULANCE_DEPARTURE_FACILITY;
    }

    public function getGroundAmbulanceDepartureFacilityPickupTime()
    {
        return $this->GROUND_AMBULANCE_DEPARTURE_FACILITY_PICKUP_TIME;
    }

    public function getGroundAmbulanceArrivalFacility()
    {
        return $this->GROUND_AMBULANCE_ARRIVAL_FACILITY;
    }

    public function getGroundAmbulanceArrivalAirportPickupTime()
    {
        return $this->GROUND_AMBULANCE_ARRIVAL_AIRPORT_PICKUP_TIME;
    }

    public function getAdditionalData()
    {
        $filename = "../../data/airside_transfer/".$this->BOOKING_ID.".txt";
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

    public function setFlightType($type)
    {
        $this->FLIGHT_TYPE = $type;
    }

    public function setFlightNumber($number)
    {
        $this->FLIGHT_NUMBER = $number;
    }

    public function setFlightDepartureAirport($airport)
    {
        $this->FLIGHT_DEPARTURE_AIRPORT = $airport;
    }

    public function setFlightArrivalAirport($airport)
    {
        $this->FLIGHT_ARRIVAL_AIRPORT = $airport;
    }

    public function setFlightDepartureTime($time)
    {
        $this->FLIGHT_DEPARTURE_TIME = $time;
    }

    public function setFlightArrivalTime($time)
    {
        $this->FLIGHT_ARRIVAL_TIME = $time;
    }

    public function setFlightTerminalType($type)
    {
        $this->FLIGHT_TERMINAL_TYPE = $type;
    }

    public function setCareLevel($care)
    {
        $this->CARE_LEVEL = $care;
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

    public function setFlightMedicalEscortRequired($flag)
    {
        $this->FLIGHT_MEDICAL_ESCORT_REQUIRED = $flag;
    }

    public function setAmbulanceEscortRequired($flag)
    {
        $this->AMBULANCE_ESCORT_REQUIRED = $flag;
    }

    public function setFlightDate($date)
    {
        $this->FLIGHT_DATE = $date;
    }

    public function setGroundAmbulanceTravelDistanceGreaterThan100km($flag)
    {
        $this->GROUND_AMBULANCE_TRAVEL_DISTANCE_GREATER_THAN_100KM = $flag;
    }

    public function setGroundAmbulanceDepartureFacility($facility)
    {
        $this->GROUND_AMBULANCE_DEPARTURE_FACILITY = $facility;
    }

    public function setGroundAmbulanceDepartureFacilityPickupTime($time)
    {
        $this->GROUND_AMBULANCE_DEPARTURE_FACILITY_PICKUP_TIME = $time;
    }

    public function setGroundAmbulanceArrivalFacility($facility)
    {
        $this->GROUND_AMBULANCE_ARRIVAL_FACILITY = $facility;
    }

    public function setGroundAmbulanceArrivalAirportPickupTime($time)
    {
        $this->GROUND_AMBULANCE_ARRIVAL_AIRPORT_PICKUP_TIME = $time;
    }

    public function setAdditionalData($data)
    {
      $handle = fopen("../../data/airside_transfer/".$this->BOOKING_ID.".txt", "w");
      fwrite($handle, $data);
      fclose($handle);
    }

    public function appendAdditionalData($data)
    {
      $handle = fopen("../../data/airside_transfer/".$this->BOOKING_ID.".txt", "a");
      fwrite($handle, $data);
      fclose($handle);
    }

    public function deleteAdditionalData()
    {
      unlink("../../data/airside_transfer/".$this->BOOKING_ID.".txt");
    }
}
