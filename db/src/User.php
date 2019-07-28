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
    /** @Column(type="type") **/
    protected $TYPE;
    /** @Column(type="integer") **/
    protected $USER_ID;

    //Constructors
    public User()
    {

    }

    public User($email, $password, $type, $user_id)
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

    public function getUserID())
    {
        return $this->USER_ID;
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

    //Miscellaneous
    public function verifyPassword($password)
    {
        return password_verify($password, $this->PASSWORD);
    }
}
