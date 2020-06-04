<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Response;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request)
    {
        try {
            $this->validateLogin($request);

            if (method_exists($this, 'hasTooManyLoginAttempts') &&
                $this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            if ($token = $this->guard()->attempt($this->credentials($request))) {
                return $this->sendLoginResponse($request, $token);
            }

            $this->incrementLoginAttempts($request);
            
            return $this->sendFailedLoginResponse($request);
        } catch(Exception $e) {
            throw new \App\Exceptions\CustomException($e->getMessage());
        }
    }
    
    public function refresh()
    {
        try {
            if ($token = $this->guard()->refresh()) 
                return $this->sendResponse('Session token refreshed successfully.')->header('Authorization', $token);

            return $this->sendError('Error refreshing the token.');
        } catch(Exception $e) {
            throw new \App\Exceptions\CustomException($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        return response()->json([ "data" => "success" ], 200);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request, $token)
    {
        $this->clearLoginAttempts($request);

        return response()->json([ "data" => \Auth::user()->toArray() ], 201)->header('Authorization', $token);
        return $this->sendResponse('Users retrieved successfully')->header('Authorization', $token);
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json([ "errors" => trans('auth.failed') ], 422);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }
}
