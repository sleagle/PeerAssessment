<?php


namespace App\DTO\Response;


class StudentEnrollmentResponse
{

    /** @var int **/
    public $rowNum;

    /** @var int **/
    public $studentId;

    /** @var string **/
    public $username;

    /** @var string **/
    public $firstName;

    /** @var string **/
    public $lastName;

    /** @var boolean **/
    public $isEnabled;

    /**
     * StudentEnrollmentResponse constructor.
     * @param $count
     * @param $data
     */
    public function __construct($count, $data)
    {
        $this->rowNum = $count;
        $this->studentId = $data['STUDENT_ID'];
        $this->username = $data['USERNAME'];;
        $this->firstName = $data['FIRST_NAME'];;
        $this->lastName = $data['LAST_NAME'];;
        $this->isEnabled = $data['IS_ENABLED'];;
    }


}
