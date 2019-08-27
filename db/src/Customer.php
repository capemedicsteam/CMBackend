<?php
/**
 * @Entity @Table(name="tbl_customers")
 **/
class Customer
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $CUSTOMER_ID;
    /** @Column(type="string") **/
    protected $CUSTOMER_NAME;
    /** @Column(type="string") **/
    protected $CUSTOMER_SURNAME;
    /** @Column(type="string") **/
    protected $CONTACT_NUMBER;
    /** @Column(type="string") **/
    protected $COMPANY;
    /** @Column(type="string") **/
    protected $EMAIL;
    /** @Column(type="decimal") **/
    protected $BALANCE;

    //Constructor
    public function __construct($name = null, $surname = null, $number = null, $company = null, $email = null)
    {
      $this->CUSTOMER_NAME = $name;
      $this->CUSTOMER_SURNAME = $surname;
      $this->CONTACT_NUMBER = $number;
      $this->COMPANY = $company;
      $this->EMAIL = $email;
    }

    //Accessors
    public function getCustomerId()
    {
        return $this->CUSTOMER_ID;
    }

    public function getCustomerName()
    {
        return $this->CUSTOMER_NAME;
    }

    public function getContactNumber()
    {
        return $this->CONTACT_NUMBER;
    }

    public function getCompany()
    {
        return $this->COMPANY;
    }

    public function getEmail()
    {
        return $this->EMAIL;
    }

    public function getBalance()
    {
      return $this->BALANCE;
    }

    //Mutators
    public function setCustomerName($name)
    {
        $this->CUSTOMER_NAME = $name;
    }

    public function setCustomerSurname($surname)
    {
        $this->CUSTOMER_SURNAME = $surname;
    }

    public function setContactNumber($number)
    {
        $this->CONTACT_NUMBER = $number;
    }

    public function setCompany($company)
    {
        $this->COMPANY = $company;
    }

    public function setEmail($email)
    {
        $this->EMAIL = $email;
    }

    public function increaseBalance($amount)
    {
      $this->BALANCE = $this->BALANCE + $amount;
    }

    public function decreaseBalance($amount)
    {
      $this->BALANCE = $this->BALANCE - $amount;
    }
}
?>
