<?php
/**
 * @Entity @Table(name="tbl_crew")
 **/
class Crew
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $CREW_ID;
    /** @Column(type="string") **/
    protected $CREW_NAME;
    /** @Column(type="string") **/
    protected $CREW_SURNAME;
    /** @Column(type="date") **/
    protected $DATE_OF_BIRTH;
    /** @Column(type="string") **/
    protected $CONTACT_NUMBER;
    /** @Column(type="string") **/
    protected $ID_PASSPORT_NUMBER;
    /** @Column(type="string") **/
    protected $ADDRESS;
    /** @Column(type="string") **/
    protected $AREA_CODE;
    /** @Column(type="string") **/
    protected $NEXT_OF_KIN_NAME;
    /** @Column(type="string") **/
    protected $NEXT_OF_KIN_SURNAME;
    /** @Column(type="string") **/
    protected $RACE;
    /** @Column(type="string") **/
    protected $GENDER;
    /** @Column(type="string") **/
    protected $MARITAL_STATUS;
    /** @Column(type="string") **/
    protected $DISABILITY;
    /** @Column(type="string") **/
    protected $FILE_PATHS;
    /** @Column(type="string") **/
    protected $BANK_ACCOUNT_HOLDER_NAME;
    /** @Column(type="string") **/
    protected $BANK_ACCOUNT_HOLDER_RELATIONSHIP;
    /** @Column(type="string") **/
    protected $BANK_ACCOUNT_NUMBER;
    /** @Column(type="string") **/
    protected $BANK_NAME;
    /** @Column(type="string") **/
    protected $BANK_BRANCH;
    /** @Column(type="string") **/
    protected $BANK_BRANCH_CODE;
    /** @Column(type="string") **/
    protected $BANK_ACCOUNT_TYPE;
    /** @Column(type="string") **/
    protected $TAX_METHOD;
    /** @Column(type="string") **/
    protected $TAX_REF_NUMBER;
    /** @Column(type="string") **/
    protected $MEDICAL_AID_NAME;
    /** @Column(type="string") **/
    protected $MEDICAL_AID_DEPENDANTS;
    /** @Column(type="boolean") **/
    protected $EMPLOYED_ELSEWHERE;

    //Constructors
    public Crew()
    {

    }

    public Booking($crew_name, $crew_surname, $date_of_birth, $contact_number, $id_passport_number, $address, $area_code, $next_of_kin_name, $next_of_kin_surname, $race, $gender, $marital_status, $disability, $file_paths, $bank_account_holder_name, $bank_account_holder_relationship, $bank_account_number, $bank_name, $bank_branch, $bank_branch_code, $bank_account_type, $tax_method, $tax_ref_number, $medical_aid_name, $medical_aid_dependants, $employed_elsewhere)
    {
      $this->CREW_NAME = $crew_name;
      $this->CREW_SURNAME = $crew_surname;
      $this->DATE_OF_BIRTH = $date_of_birth;
      $this->CONTACT_NUMBER = $contact_number;
      $this->ID_PASSPORT_NUMBER = $id_passport_number;
      $this->ADDRESS = $address;
      $this->AREA_CODE = $area_code;
      $this->NEXT_OF_KIN_NAME = $next_of_kin_name;
      $this->NEXT_OF_KIN_SURNAME = $next_of_king_surname;
      $this->RACE = $race;
      $this->GENDER = $gender;
      $this->MARITAL_STATUS = $marital_status;
      $this->DISABILITY = $disability;
      $this->FILE_PATHS = $file_paths;
      $this->BANK_ACCOUNT_HOLDER_NAME = $bank_account_holder_name;
      $this->BANK_ACCOUNT_HOLDER_RELATIONSHIP = $bank_account_holder_relationship;
      $this->BANK_ACCOUNT_NUMBER = $bank_account_number;
      $this->BANK_NAME = $bank_name;
      $this->BANK_BRANCH = $bank_branch;
      $this->BANK_BRANCH_CODE = $bank_branch_code;
      $this->BANK_ACCOUNT_TYPE = $bank_account_type;
      $this->TAX_METHOD = $tax_method;
      $this->TAX_REF_NUMBER = $tax_ref_number;
      $this->MEDICAL_AID_NAME = $medical_aid_name;
      $this->MEDICAL_AID_DEPENDANTS = $medical_aid_dependants;
      $this->EMPLOYED_ELSEWHERE = $employed_elsewhere;
    }

    //Accessors
    public function getCrewId()
    {
        return $this->CREW_ID;
    }

    public function getCrewName()
    {
        return $this->CREW_NAME;
    }

    public function getCrewSurname()
    {
        return $this->CREW_SURNAME;
    }

    public function getDateOfBirth()
    {
        return $this->DATE_OF_BIRTH;
    }

    public function getContactNumber()
    {
        return $this->CONTACT_NUMBER;
    }

    public function getIdPassportNumber()
    {
        return $this->ID_PASSPORT_NUMBER;
    }

    public function getAddress()
    {
        return $this->ADDRESS;
    }

    public function getAreaCode()
    {
        return $this->AREA_CODE;
    }

    public function getNextOfKinName()
    {
        return $this->NEXT_OF_KIN_NAME;
    }

    public function getNextOfKinSurname()
    {
        return $this->NEXT_OF_KIN_SURNAME;
    }

    public function getRace()
    {
        return $this->RACE;
    }

    public function getGender()
    {
        return $this->GENDER;
    }

    public function getMaritalStatus()
    {
        return $this->MARITAL_STATUS;
    }

    public function getDisability()
    {
        return $this->DISABILITY;
    }

    public function getCrewName()
    {
        return $this->CREW_NAME;
    }

    public function getFilePaths()
    {
        return JSON.parse($this->FILE_PATHS);
    }

    public function getBankAccountHolderName()
    {
        return $this->BANK_ACCOUNT_HOLDER_NAME;
    }

    public function getBankAccountHolderRelationship()
    {
        return $this->BANK_ACCOUNT_HOLDER_RELATIONSHIP;
    }

    public function getBankAccountNumber()
    {
        return $this->BANK_ACCOUNT_NUMBER;
    }

    public function getBankName()
    {
        return $this->BANK_NAME;
    }

    public function getBankBranch()
    {
        return $this->BANK_BRANCH;
    }

    public function getBankBranchCode()
    {
        return $this->BANK_BRANCH_CODE;
    }

    public function getBankAccountType()
    {
        return $this->BANK_ACCOUNT_TYPE;
    }

    public function getTaxMethod()
    {
        return $this->TAX_METHOD;
    }

    public function getTaxRefNumber()
    {
        return $this->TAX_REF_NUMBER;
    }

    public function getMedicalAidName()
    {
        return $this->MEDICAL_AID_NAME;
    }

    public function getMedicalAidDependants()
    {
        return $this->MEDICAL_AID_DEPENDANTS;
    }

    public function getEmployedElsewhere()
    {
        return $this->EMPLOYED_ELSEWHERE;
    }

    //Mutators
    public function setCrewName($name)
    {
        $this->CREW_NAME = $name;
    }

    public function setCrewSurname($surname)
    {
        $this->CREW_SURNAME = $surname;
    }

    public function setDateOfBirth($dob)
    {
        $this->DATE_OF_BIRTH = $dob;
    }

    public function setContactNumber($number)
    {
        $this->CONTACT_NUMBER = $number;
    }

    public function setIdPassportNumber($number)
    {
        $this->ID_PASSPORT_NUMBER = $number;
    }

    public function setAddress($address)
    {
        $this->ADDRESS = $address;
    }

    public function setAreaCode($code)
    {
        $this->AREA_CODE = $code;
    }

    public function setNextOfKinName($name)
    {
        $this->NEXT_OF_KIN_NAME = $name;
    }

    public function setNextOfKinSurname($surname)
    {
        $this->NEXT_OF_KIN_SURNAME = $surname;
    }

    public function setRace($race)
    {
        $this->RACE = $race;
    }

    public function setGender($gender)
    {
        $this->GENDER = $gender;
    }

    public function setMaritalStatus($status)
    {
        $this->MARITAL_STATUS = $status;
    }

    public function setDisability($disability)
    {
        $this->DISABILITY = $disability;
    }

    public function setFilePaths($object)
    {
        $this->FILE_PATHS = JSON.encode($object);
    }

    public function setBankAccountHolderName($name)
    {
        $this->BANK_ACCOUNT_HOLDER_NAME = $name;
    }

    public function setBankAccountHolderRelationship($relationship)
    {
        $this->BANK_ACCOUNT_HOLDER_RELATIONSHIP = $relationship;
    }

    public function setBankAccountNumber($number)
    {
        $this->BANK_ACCOUNT_NUMBER = $number;
    }

    public function setBankName($name)
    {
        $this->BANK_NAME = $name;
    }

    public function setBankBranch($branch)
    {
        $this->BANK_BRANCH = $branch;
    }

    public function setBankBranchCode($code)
    {
        $this->BANK_BRANCH_CODE = $code;
    }

    public function setBankAccountType($type)
    {
        $this->BANK_ACCOUNT_TYPE = $type;
    }

    public function setTaxMethod($method)
    {
        $this->TAX_METHOD = $method;
    }

    public function setTaxRefNumber($number)
    {
        $this->TAX_REF_NUMBER = $number;
    }

    public function setMedicalAidName($name)
    {
        $this->MEDICAL_AID_NAME = $name;
    }

    public function setMedicalAidDependants($dependants)
    {
        $this->MEDICAL_AID_DEPENDANTS = $dependants;
    }

    public function setEmployedElsewhere($flag)
    {
        $this->EMPLOYED_ELSEWHERE = $flag;
    }
}
