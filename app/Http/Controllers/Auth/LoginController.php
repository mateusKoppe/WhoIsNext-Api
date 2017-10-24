<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function login(Request $request)
    {
        $validator = $this->validator($request->all());
        if($validator->fails())
            return $validator->errors();
        $credentials = $this->credentials($request->all());
        $this->guard()->attempt($credentials);
        if($this->guard()->check())
            return $this->guard()->user();
        return response(null, 403);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
    }

    protected function credentials(array $data)
    {
        return $credentials = [
            'password' => $data['password'],
            'email' => $data['email'],
        ];
    }
}
