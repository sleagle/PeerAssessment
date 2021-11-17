<?php


namespace App\Http\Middleware;


use App\Utility\Encryption;
use App\Utility\Utility;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonMapper_Exception;
use SodiumException;

class AdminAuth extends Middleware
{
    /**
     * @param Request $request
     * @param \Closure $next
     * @param mixed ...$guards
     * @return JsonResponse|mixed
     * @throws JsonMapper_Exception
     * @throws SodiumException
     */
    public function handle($request, \Closure $next, ...$guards): JsonResponse
    {
        $token = Utility::GetTokenFromRequest($request);

        if (Encryption::ValidateLoginToken($token, Utility::ADMIN_USER_TYPE)) {
            return $next($request);
        }
        return Utility::NotAuthorisedError();
    }
}
