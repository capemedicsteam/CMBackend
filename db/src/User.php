<?php
/**
 * @Entity @Table(name="tbl_users")
 **/
class User
{
    /** @Id @Column(type="string") **/
    protected $EMAIL;
    /** @Column(type="string") **/
    protected $PASSWORD;
    /** @Column(type="string") **/
    protected $TYPE;  //Admin, Crew, Customer
    /** @Column(type="integer") **/
    protected $USER_ID;
    /** @Column(type="boolean") **/
    protected $ACTIVE;

    //Constructor
    public function __construct($email = null, $password = null, $type = null, $user_id = null)
    {
      $this->EMAIL = $email;
      $this->PASSWORD = password_hash($password, PASSWORD_DEFAULT);
      $this->TYPE = $type;
      $this->USER_ID = $user_id;
    }

    //Accessors
    public function getEmail()
    {
        return $this->EMAIL;
    }

    public function getType()
    {
        return $this->TYPE;
    }

    public function getUserID()
    {
        return $this->USER_ID;
    }

    public function isActive()
    {
      return $this->ACTIVE
    }

    //Mutators
    public function setEmail($email)
    {
        $this->EMAIL = $email;
    }

    public function setPassword($password)
    {
          $this->PASSWORD = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setType($type)
    {
        $this->TYPE = $type;
    }

    public function setUserId($id)
    {
        $this->USER_ID = $id;
    }

    public function setActive($active)
    {
      $this->ACTIVE = $active;
    }

    //Miscellaneous
    public function verifyPassword($password)
    {
        return password_verify($password, $this->PASSWORD);
    }
}
?>
