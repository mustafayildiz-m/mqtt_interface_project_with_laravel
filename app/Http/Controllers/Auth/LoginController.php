<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

//    protected function authenticated(Request $request, $user)
//    {
//        Alert::success('Giriş Başarılı.');
//
//        return redirect()->intended($this->redirectPath());
//    }

    protected function authenticated(Request $request, $user)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            // Authentication was successful
            Alert::success('Giriş Başarılı.');
            return redirect()->intended($this->redirectPath());
        }

    }

    protected function sendFailedLoginResponse(Request $request)
    {
        Alert::error('Giriş Bilgilerinizi kontrol ediniz.');
        return redirect()->back();

    }


}
