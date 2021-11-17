<?php


namespace App\Service;

use App\DTO\Request\LoginRequest;
use App\DTO\Response\LoginResponse;
use App\Exceptions\PeerAssessmentException;
use App\Repository\AdminRepository;
use App\Repository\LecturerRepository;
use App\Repository\StudentRepository;
use App\Repository\UserRepository;
use App\Utility\Encryption;

class LoginService
{

    /** @var UserRepository */
    private $userRepository;

    /** @var AdminRepository */
    private $adminRepository;

    /** @var LecturerRepository */
    private $lecturerRepository;

    /** @var StudentRepository */
    private $studentRepository;

    public function __construct(UserRepository $userRepository, AdminRepository $adminRepository,
                                LecturerRepository $lecturerRepository, StudentRepository $studentRepository)
    {
        $this->userRepository = $userRepository;
        $this->adminRepository = $adminRepository;
        $this->lecturerRepository = $lecturerRepository;
        $this->studentRepository = $studentRepository;
    }


    /**
     * @param LoginRequest $request
     * @return LoginResponse
     * @throws PeerAssessmentException
     */
    public function validateUser(LoginRequest $request): LoginResponse
    {
        $user = $this->userRepository->getUserByUsername($request->username);

        if (base64_decode($request->password) != Encryption::DecryptUserPassword($user->PASSWORD)){
            $passException = new PeerAssessmentException();
            $passException->setCode("ERR001");
            $passException->setMessage("Invalid login details");

            throw $passException;
        }

        $userId = 0;
        $userType = "";
        $userName = "";

        switch ($user->USER_TYPE_ID)
        {
            case 1:
                $userType = "Admin";
                $admin = $this->adminRepository->getAdminByUserId($user->USER_ID);
                $userId = $admin->ADMIN_ID;
                $userName = $admin->FIRST_NAME . " " . $admin->LAST_NAME;
                break;

            case 2:
                $userType = "Lecturer";
                $lecturer = $this->lecturerRepository->getLecturerByUserId($user->USER_ID);
                $userId = $lecturer->LECTURER_ID;
                $userName = $lecturer->FIRST_NAME . " " . $lecturer->LAST_NAME;
                break;

            case 3:
                $userType = "Student";
                $student = $this->studentRepository->getStudentByUserId($user->USER_ID);
                $userId = $student->STUDENT_ID;
                $userName = $student->FIRST_NAME . " " . $student->LAST_NAME;
                break;
        }

        $token = Encryption::CreateAndEncryptLoginToken($userId, $userType);

        return new LoginResponse($userName, $userType, $token);
    }
}
