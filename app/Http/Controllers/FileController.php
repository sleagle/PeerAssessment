<?php


namespace App\Http\Controllers;


use App\DTO\Request\AddStudentsToUnitRequest;
use App\DTO\Request\AddTopicToAssignmentRequest;
use App\DTO\Request\SubmitAssignmentRequest;
use App\DTO\Response\TopicsFromCSVResponse;
use App\Service\AssignmentService;
use App\Exceptions\PeerAssessmentException;
use App\Service\StudentService;
use App\Service\UserService;
use App\Utility\CSVToArray;
use App\Utility\Encryption;
use App\Utility\LoginToken;
use App\Utility\Utility;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use JsonMapper_Exception;
use Psr\Http\Message\UploadedFileInterface;
use SodiumException;

class FileController
{

    private $filesUploadDir = __DIR__ . 'uploads/';
    private $submissionUploadDir = __DIR__ . '../../uploads/submissions';

    /**
     * @param Request $request
     * @param UserService $userService
     * @return mixed
     * @throws JsonMapper_Exception | SodiumException
     */
    public function addStudentsListsFromCSV(Request $request, UserService $userService)
    {
        $token = Utility::GetTokenFromRequest($request);
        if (Encryption::ValidateLoginToken($token, Utility::LECTURER_USER_TYPE))
        {
            $uploadedFile = $request->file('studentList');
            $data = $request->get('unitCode');

            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {

                $addStudentToUnitRequest = new AddStudentsToUnitRequest();
                $addStudentToUnitRequest->setUnitCode($data);
                $addStudentToUnitRequest->setFileLocation($_FILES['studentList']['tmp_name']);

                return response()->json($userService->addStudentsToUnit($addStudentToUnitRequest),200);

            }

            return response()->json($this->getFileUploadErrorMsg(),400);
        }
        else
        {
            return Utility::NotAuthorisedError();
        }
    }

    /**
     * @param Request $request
     * @param AssignmentService $assignmentService
     * @return JsonResponse
     * @throws JsonMapper_Exception | SodiumException
     */
    public function addAssignmentTopicsFromCSV(Request $request, AssignmentService $assignmentService)
    {
        $token = Utility::GetTokenFromRequest($request);
        if (Encryption::ValidateLoginToken($token, Utility::LECTURER_USER_TYPE))
        {
            $uploadedFile = $request->file('topicList');
            $data = $request->get('assignmentId');

            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                $topicsArray = array();

                $topics = CSVToArray::readCSVToArray($_FILES['topicList']['tmp_name']);
                $count = 1;
                foreach ($topics as $topic)
                {
                    array_push($topicsArray, new TopicsFromCSVResponse($topic, $count++));
                }

                $topicsToAssignmentRequest = new AddTopicToAssignmentRequest();
                $topicsToAssignmentRequest->setAssignmentId($data);
                $topicsToAssignmentRequest->setTopicSpecification($topicsArray);
                return response()->json($assignmentService->createTopicsForAssignment($topicsToAssignmentRequest),200);
        }

            return response()->json($this->getFileUploadErrorMsg(),400);
        }
        else
        {
            return Utility::NotAuthorisedError();
        }
    }

    public function uploadAssignment(Request $request, StudentService $studentService)
    {
        $randomFileName = Str::random(20)."_".date("Ymd-his").".pdf";
        $assignmentPath = "public/assignment/".$request->assignmentId;

        $uploadedFile = $request->file('uploadedFile')->storeAs($assignmentPath,$randomFileName);
        $token = Utility::GetTokenFromRequest($request);
        $submitAssignmentRequest = new SubmitAssignmentRequest($request->assignmentId, $uploadedFile);

        return response()->json($studentService->submitAssignment($submitAssignmentRequest, Encryption::GetUserID($token)),200);
    }

    /**
     * @param string $directory
     * @param UploadedFileInterface $uploadedFile
     * @return string
     * @throws Exception
     */
    function moveUploadedFile(string $directory, UploadedFileInterface $uploadedFile)
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);

        // see http://php.net/manual/en/function.random-bytes.php
        $basename = bin2hex(random_bytes(8));
        $filename = sprintf('%s.%0.8s', $basename, $extension);

        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }

    /**
     * @return PeerAssessmentException
     */
    private function getFileUploadErrorMsg(): PeerAssessmentException
    {
        $passException = new PeerAssessmentException();
        $passException->setCode("ERR005");
        $passException->setMessage("File Upload Error");

        return $passException;
    }
}
