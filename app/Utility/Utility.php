<?php


namespace App\Utility;


use App\Exceptions\PeerAssessmentException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Utility
{

    public const ADMIN_USER_TYPE = 1;
    public const LECTURER_USER_TYPE = 2;
    public const STUDENT_USER_TYPE = 3;

    public static function GetTokenFromRequest(Request $request)
    {
        return json_encode($request->header("token"));
    }

    /**
     * @return JsonResponse
     */
    public static function NotAuthorisedError(): JsonResponse
    {
        $passException = new PeerAssessmentException();
        $passException->setCode("ERR002");
        $passException->setMessage("You are not authorised to carry out this activity");

        return \response()->json($passException,401);
    }

    public static function getSemester()
    {
        $month = intval(date("m"));

        if ($month >= 2 && $month <= 5){
            return 1;
        }

        else if ($month >= 7 && $month <= 10)
        {
            return 2;
        }

        return 0;
    }

    public static function getYear()
    {
        return intval(date("Y"));
    }
}
