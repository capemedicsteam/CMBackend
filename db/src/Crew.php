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
    protected $EMAIL;
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
    protected $NEXT_OF_KIN_CONTACT_NUMBER;
    /** @Column(type="string") **/
    protected $RACE;
    /** @Column(type="string") **/
    protected $GENDER;
    /** @Column(type="boolean") **/
    protected $MARITAL_STATUS;
    /** @Column(type="boolean") **/
    protected $DISABLED;
    /** @Column(type="string") **/
    protected $BANK_ACCOUNT_HOLDER_NAME;
    /** @Column(type="string") **/
    protected $BANK_ACCOUNT_NUMBER;
    /** @Column(type="string") **/
    protected $BANK_NAME;
    /** @Column(type="string") **/
    protected $BANK_BRANCH;
    /** @Column(type="string") **/
    protected $BANK_BRANCH_CODE;
    /** @Column(type="string") **/
    protected $TAX_REF_NUMBER;
    /** @Column(type="boolean") **/
    protected $TYPE_FIRE;
    /** @Column(type="boolean") **/
    protected $TYPE_SAFETY;
    /** @Column(type="boolean") **/
    protected $TYPE_MEDICAL;
    /** @Column(type="string") **/
    protected $FIRE_CERTIFICATE_NUMBER;
    /** @Column(type="string") **/
    protected $HPSCA_NUMBER;
    /** @Column(type="string") **/
    protected $SAIOSH_NUMBER;
    /** @Column(type="string") **/
    protected $ID_FILEPATH;
    /** @Column(type="string") **/
    protected $DOCUMENT_FILEPATHS;
    /**
     * @OneToMany(targetEntity="CrewAssignment", mappedBy="CREW")
     * @var CrewAssignment[] An ArrayCollection of Bug objects.
     **/
    protected $CREW_ASSIGNMENTS = null;

    //Constructor
    public function __construct($crew_name = null, $crew_surname = null, $date_of_birth = null, $email = null, $contact_number = null, $id_passport_number = null, $address = null, $area_code = null, $next_of_kin_name = null, $next_of_kin_contact_number = null, $race = null, $gender = null, $marital_status = null, $disabled = null, $bank_account_holder_name = null, $bank_account_number = null, $bank_name = null, $bank_branch = null, $bank_branch_code = null, $tax_ref_number = null, $type_fire = false, $type_safety = false, $type_medical = false, $fire_certificate_number = null, $hpsca_number = null, $saiosh_number = null, $id_filepath = null, $document_filepaths = null)
    {
      $this->CREW_NAME = $crew_name;
      $this->CREW_SURNAME = $crew_surname;
      $this->DATE_OF_BIRTH = $date_of_birth;
      $this->EMAIL = $email;
      $this->CONTACT_NUMBER = $contact_number;
      $this->ID_PASSPORT_NUMBER = $id_passport_number;
      $this->ADDRESS = $address;
      $this->AREA_CODE = $area_code;
      $this->NEXT_OF_KIN_NAME = $next_of_kin_name;
      $this->NEXT_OF_KIN_CONTACT_NUMBER = $next_of_kin_contact_number;
      $this->RACE = $race;
      $this->GENDER = $gender;
      $this->MARITAL_STATUS = $marital_status;
      $this->DISABLED = $disabled;
      $this->BANK_ACCOUNT_HOLDER_NAME = $bank_account_holder_name;
      $this->BANK_ACCOUNT_NUMBER = $bank_account_number;
      $this->BANK_NAME = $bank_name;
      $this->BANK_BRANCH = $bank_branch;
      $this->BANK_BRANCH_CODE = $bank_branch_code;
      $this->TAX_REF_NUMBER = $tax_ref_number;
      $this->TYPE_FIRE = $type_fire;
      $this->TYPE_SAFETY = $type_safety;
      $this->TYPE_MEDICAL = $type_medical;
      $this->FIRE_CERTIFICATE_NUMBER = $fire_certificate_number;
      $this->HPSCA_NUMBER = $hpsca_number;
      $this->SAIOSH_NUMBER = $saiosh_number;
      $this->ID_FILEPATH = $id_filepath;
      $this->DOCUMENT_FILEPATHS = $document_filepaths;
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

    public function getEmail()
    {
        return $this->EMAIL;
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

    public function getNextOfKinContactNumber()
    {
        return $this->NEXT_OF_KIN_CONTACT_NUMBER;
    }

    public function getRace()
    {
        return $this->RACE;
    }

    public function getGender()
    {
        return $this->GENDER;
    }

    public function isMarried()
    {
        return $this->MARITAL_STATUS;
    }

    public function isDisabled()
    {
        return $this->DISABLED;
    }

    public function getBankAccountHolderName()
    {
        return $this->BANK_ACCOUNT_HOLDER_NAME;
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

    public function getTaxRefNumber()
    {
        return $this->TAX_REF_NUMBER;
    }

    public function isFire()
    {
        return $this->TYPE_FIRE;
    }

    public function isSafety()
    {
        return $this->TYPE_SAFETY;
    }

    public function isMedical()
    {
        return $this->TYPE_MEDICAL;
    }

    public function getFireCertificateNumber()
    {
        return $this->FIRE_CERTIFICATE_NUMBER;
    }

    public function getHPSCANumber()
    {
        return $this->HPSCA_NUMBER;
    }

    public function getSAIOSHNumber()
    {
        return $this->SAIOSH_NUMBER;
    }

    public function getIdFilePath()
    {
        return $this->ID_FILEPATH;
    }

    public function getDocumentFilePaths()
    {
        return $this->DOCUMENT_FILEPATHS;
    }

    public function getJobs()
    {
      $jobs;
      for($i = 0 ; $i < count(CREW_ASSIGNMENTS) ; $i++)
      {
        $jobs[] = CREW_ASSIGNMENTS[$i]->getJob();
      }
      return $jobs;
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

    public function setNextOfKinContactNumber($number)
    {
        $this->NEXT_OF_KIN_CONTACT_NUMBER = $number;
    }

    public function setRace($race)
    {
        $this->RACE = $race;
    }

    public function setGender($gender)
    {
        $this->GENDER = $gender;
    }

    public function setMarried($status)
    {
        $this->MARITAL_STATUS = $status;
    }

    public function setDisabled($disability)
    {
        $this->DISABLED = $disability;
    }

    public function setBankAccountHolderName($name)
    {
        $this->BANK_ACCOUNT_HOLDER_NAME = $name;
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

    public function setTaxRefNumber($number)
    {
        $this->TAX_REF_NUMBER = $number;
    }

    public function setCertificationType($type)
    {
        $this->CERTIFICATION_TYPE = $type;
    }

    public function setCertificationNumber($number)
    {
        $this->CERTIFICATION_NUMBER = $number;
    }

    public function setIdFilepath($path)
    {
        $this->ID_FILEPATH = $path;
    }

    public function setDocumentFilepaths($filepaths)
    {
        $this->DOCUMENT_FILEPATHS = $filepaths;
    }
}
?>
